<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\JobSendSignupEmailForUserAndAdmin;
use App\Models\Book;
use App\Models\ErrorLog;
use App\Models\Order;
use App\Models\PackagesMember;
use App\Models\ServiceRating;
use App\Models\Session;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
//

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->where('role_id', "!=", 3)->get();
        return view('dashboard.users.index', compact('users'));
    }

    // public function indexusers()
    // {
    //     $users = User::orderBy('created_at', 'desc')->get();
    //     return view('dashboard.users.index', compact('users'));
    // }

    // public function indexusers()
    // {
    //     $users = User::orderBy('created_at', 'desc')->get();
    //     $bookuser = Book::query();
    //     $packages = PackagesMember::join("packages", "packages.id", "=", "packages_members.package_id");
    //     foreach ($users as $key => $user) {
    //         $user->totalIncommingSesssions = $bookuser->where('books.member_id', $user->id)->where('status', 'Pending')->count();
    //         $user->totalAttendedSesssions = $bookuser->where('books.member_id', $user->id)->where('status', 'Finished')->where("attended", true)->count();
    //         $user->totalNotAttendedSesssions = $bookuser->where('books.member_id', $user->id)->where('status', 'Finished')->where("attended", false)->count();
    //         $user->packageExpirationDate = $packages->where("member_id", $user->id)->where("purchase_status", "valid")->pluck("packages_members.valid_till", "packages.name");
    //     }
    //     return DataTables::of($user)
    //     ->addIndexColumn()
    //     ->make(true);
    //     return view('dashboard.users.indexreport', compact('users'));
    // }
    //

    public function viewusersdatatable()
    {
        $packages = PackagesMember::join("packages", "packages.id", "=", "packages_members.package_id")->where("purchase_status", "valid")->get();
        $validtilllist = [];
        foreach ($packages as $key => $package) {
            $data = Carbon::parse($package->valid_till)->format("Y-m-d");
            if (!in_array($data, $validtilllist))
                array_push($validtilllist, $data);
        }
        return view('dashboard.users.indexreport', ['validtilllist' => $validtilllist]);
    }

    public function usersdatatable(Request $request)
    {
        $users = User::query()->where('role_id', 4);
        $bookuser = Book::get();
        $packages = PackagesMember::join("packages", "packages.id", "=", "packages_members.package_id")->where("purchase_status", "valid")->get();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('name', function ($item) {
                return $item->username();
            })
            ->addColumn('action', function ($item) {
                $actionBtn = "<a href=" . route('users.show', $item->id) . "><i class='fas fa-eye'></i></a>&nbsp;&nbsp;";
                $actionBtn .= "<a href=" . route('users.edit', $item->id) . "><i class='fas fa-pen'></i></a>&nbsp;&nbsp;";
                return $actionBtn;
            })
            ->addcolumn('totalIncommingSesssions', function ($user) use ($bookuser) {
                return $user->totalIncommingSesssions = $bookuser->where('member_id', $user->id)->where('status', 'Pending')->count();
            })
            ->addcolumn('totalAttendedSesssions', function ($user) use ($bookuser) {
                return $user->totalAttendedSesssions = $bookuser->where('member_id', $user->id)->where('status', 'Finished')->where("attended", true)->count();
            })
            ->addcolumn('totalNotAttendedSesssions', function ($user) use ($bookuser) {
                return $user->totalNotAttendedSesssions = $bookuser->where('member_id', $user->id)->where('status', 'Finished')->where("attended", false)->count();
            })
            ->addColumn('packageExpirationDate', function ($user) use ($packages, $request) {
                if (!empty($request->get('validtilldate'))) {
                    $data = $packages->where("member_id", $user->id);
                    $result = null;
                    foreach ($data as $key => $item) {
                        $packagedatadiff = Carbon::parse($item->valid_till)->diffInDays($request->get('validtilldate'));
                        if ($packagedatadiff == 0) {
                            $result .= "<b>" . $item->name . "</b> <small>" . $item->valid_till->toDateString() . "</small></br>";
                        }
                    }
                    return $result;
                } else {
                    $data = $packages->where("member_id", $user->id);
                    $result = null;
                    foreach ($data as $key => $item) {
                        if ($item != null) {
                            $result .= "<b>" . $item->name . "</b> <small>" . $item->valid_till->toDateString() . "</small></br>";
                        }
                    }
                    return $result;
                }
            })
            ->rawColumns(['action', 'packageExpirationDate'])
            ->filter(function ($instance) use ($request, $packages, $bookuser) {
                if (!empty($request->get('gender'))) {
                    $instance->where('gender', $request->get('gender'));
                }
                if (!empty($request->get('startDate')) && !empty($request->get('endDate'))) {
                    $startDate = Carbon::parse($request->get('startDate'));
                    $endDate = Carbon::parse($request->get('endDate'));
                    $instance->whereBetween('dob', [$startDate, $endDate]);
                }
                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        // list of table columns
                        $w->orWhere('fname', 'LIKE', "%$search%")
                            ->orWhere('lname', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%")
                            ->orWhere('gender', 'LIKE', "%$search%")
                            ->orWhere('dob', 'LIKE', "%$search%");
                    });
                }
                if (!empty($request->get('validtilldate'))) {
                    if ($instance->count() > 0) {
                        foreach ($instance->get() as $key => $user) {
                            $userpackages = $packages->where('member_id', $user->id);
                            $counter = 0;
                            foreach ($userpackages as $key => $userpackage) {
                                // dd( $userpackage);
                                $packagedatadiff = Carbon::parse($userpackage->valid_till)->diffInDays($request->get('validtilldate'));
                                if ($packagedatadiff == 0)
                                    $counter++;
                            }
                            if ($counter == 0) {
                                $instance->where('id', "!=", $user->id);
                            }
                        }
                    }
                }
                if (!empty($request->get('leastattednded'))) {
                    if ($instance->count() > 0) {
                        $arr = [];
                        foreach ($instance->get() as $key => $user) {
                            $totalAttendedSesssions = $bookuser->where('member_id', $user->id)->where('status', 'Finished')->where("attended", true)->count();
                            $arr[] = ['id' => $user->id, 'count' => $totalAttendedSesssions];
                        }
                        uasort($arr, function ($a, $b) {
                            $a = $a['count'];
                            $b = $b['count'];

                            if ($a > $b)
                                return 1;
                            else if ($a < $b)
                                return -1;
                            else
                                return 0;
                        });

                        $finalarr = array_slice($arr, 0, $request->get('leastattednded'), true);
                        $finalarr = array_column($finalarr, 'id');
                        $ids_ordered = implode(',', $finalarr);
                        $instance->whereIn('id', $finalarr)->orderByRaw("FIELD(id, $ids_ordered)");
                    }
                }
                if (!empty($request->get('mostattednded'))) {
                    if ($instance->count() > 0) {
                        $arr = [];
                        foreach ($instance->get() as $key => $user) {
                            $totalAttendedSesssions = $bookuser->where('member_id', $user->id)->where('status', 'Finished')->where("attended", true)->count();
                            $arr[] = ['id' => $user->id, 'count' => $totalAttendedSesssions];
                        }
                        uasort($arr, function ($a, $b) {
                            $a = $a['count'];
                            $b = $b['count'];

                            if ($a < $b)
                                return 1;
                            else if ($a > $b)
                                return -1;
                            else
                                return 0;
                        });

                        $finalarr = array_slice($arr, 0, $request->get('mostattednded'), true);
                        $finalarr = array_column($finalarr, 'id');
                        $ids_ordered = implode(',', $finalarr);
                        $instance->whereIn('id', $finalarr)->orderByRaw("FIELD(id, $ids_ordered)");
                    }
                }
            })
            ->make(true);
    }


    // coaches report
    public function viewcoachesdatatable()
    {
        // $packages = PackagesMember::join("packages", "packages.id", "=", "packages_members.package_id")->where("purchase_status", "valid")->get();
        // $validtilllist = [];
        // foreach ($packages as $key => $package) {
        //     $data = Carbon::parse($package->valid_till)->format("Y-m-d");
        //     if (!in_array($data, $validtilllist))
        //         array_push($validtilllist, $data);
        // }

        return view('dashboard.users.coachindexreport');
    }

    public function coachesdatatable(Request $request)
    {
        $coachessessions = Book::join('sessions', 'sessions.id', '=', 'books.session_id')
            ->join('users', 'users.id', '=', 'books.member_id')
            ->where('users.role_id', '4')
            ->select(DB::raw('count(*) as totalusers'), 'sessions.id', 'books.bookdate', 'sessions.capacity', 'sessions.coach_id', 'books.status')
            ->groupBy(['books.bookdate', 'sessions.coach_id', 'sessions.id'])
            ->get();

        $coachids = collect($coachessessions->pluck('coach_id'))->unique();

        $totallastsessions = $coachessessions->where('status', 'Finished');
        $lastcompletedsessions = $coachessessions->where('status', 'Finished')->map(function ($item) {
            if ($item->totalusers == $item->capacity)
                return $item;
        });

        $lastuncompletedsessions = $coachessessions->where('status', 'Finished')->map(function ($item) {
            if ($item->totalusers < $item->capacity)
                return $item;
        });

        $totalwaitingsessions = $coachessessions->where('status', 'Pending');
        $completedwaitingsessions = $coachessessions->where('status', 'Pending')->map(function ($item) {
            if ($item->totalusers == $item->capacity)
                return $item;
        });
        $uncompletedwaitingsessions = $coachessessions->where('status', 'Pending')->map(function ($item) {
            if ($item->totalusers < $item->capacity)
                return $item;
        });

        $coaches = User::whereIn('id', $coachids)->get();

        $data = [];
        foreach ($coachids as $key => $coachid) {
            $cocah = $coaches->where('id', $coachid)->first();
            $data[] = [
                'id' => $coachid,
                'coach_name' => $cocah->username(),
                'coach_email' => $cocah->email,
                'coach_gender' => $cocah->gender == 1 ? 'Male' : 'Female',
                'coach_dob' => $cocah->dob->toDateString(),
                'completed_sessions' => $lastcompletedsessions->where('coach_id', $coachid)->count(),
                'uncompleted_sessions' => $lastuncompletedsessions->where('coach_id', $coachid)->count(),
                'total_sessions' => $totallastsessions->where('coach_id', $coachid)->count(),
                'total_waiting_sessions' => $totalwaitingsessions->where('coach_id', $coachid)->count(),
                'completed_waiting_sessions' => $completedwaitingsessions->where('coach_id', $coachid)->count(),
                'uncompleted_waiting_sessions' => $uncompletedwaitingsessions->where('coach_id', $coachid)->count(),
            ];
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $actionBtn = "<a href=" . route('users.show', $item['id']) . "><i class='fas fa-eye'></i></a>&nbsp;&nbsp;";
                $actionBtn .= "<a href=" . route('users.edit', $item['id']) . "><i class='fas fa-pen'></i></a>&nbsp;&nbsp;";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->filter(function ($instance) use ($request) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (!empty($request->get('gender'))) {
                        return $row['coach_gender'] == $request->get('gender') ? true : false;
                    }
                    return true;
                });

                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (!empty($request->get('startDate')) && !empty($request->get('endDate'))) {
                        $startDate = Carbon::parse($request->get('startDate'));
                        $endDate = Carbon::parse($request->get('endDate'));
                        return Carbon::parse($row['coach_dob'])->between($startDate, $endDate) ? true : false;
                    }
                    return true;
                });

                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    if (!empty($request->get('search')['value'])) {
                        if (Str::contains(Str::lower($row['coach_name']), $request->get('search')['value']))
                            return true;
                        else if (Str::contains(Str::lower($row['coach_email']), $request->get('search')['value']))
                            return true;
                        else if (Str::contains(Str::lower($row['coach_gender']), $request->get('search')['value']))
                            return true;
                        else if (Str::contains(Str::lower($row['coach_dob']), $request->get('search')['value']))
                            return true;
                        else
                            return false;
                    }
                    return true;
                });

                if (!empty($request->get('mostsessions'))) {
                    $instance->collection = $instance->collection->sortByDesc("total_sessions")->slice(0, $request->get('mostsessions'));
                }

                if (!empty($request->get('leastsessions'))) {
                    $instance->collection = $instance->collection->sortBy("total_sessions")->slice(0, $request->get('leastsessions'));
                }
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    public function createcoachview()
    {
        return view('dashboard.coach.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'whats_app_phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'emergency_contact_number' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'email' => 'required|email|unique:users,id',
            'password' => 'required|min:5|required_with:password_confirmation|same:password_confirmation'
        ]);
        if ($validator->fails()) {
            $errorslist = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                $errorslist .= $value[0];
            }
            return redirect()->route('users.index')->with(['error' => $errorslist]);
        }

        // 3- coach
        // 4- member

        try {

            $age = null;
            if ($request->dob != null) {
                $age = Carbon::parse($request->dob)->diff(now())->y;
            }

            if ($request->role_id == null)
                $request->role_id = 4;

            if ($request->name != null) {
                $name = explode(' ', $request->name);
                $fname = isset($name[0]) ? $name[0] : null;
                $lname = isset($name[1]) ? $name[1] : null;
            } else {
                $fname  = $request->fname;
                $lname  = $request->lname;
            }

            $user = User::firstOrCreate([
                'email' => $request->email
            ], [
                'email' => $request->email,
                'fname' => $fname,
                'lname' => $lname,
                'gender' => $request->gender,
                'screen_name' => $request->screen_name,
                'dob' => $request->dob,
                'age' => $age,
                'height' => $request->height,
                'weight' => $request->weight,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'phone' => $request->phone,
                'whats_app_phone' => $request->whats_app_phone,
                'referred_by' => $request->referred_by,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_number' => $request->emergency_contact_number,
                'emergency_contact_relation' => $request->emergency_contact_relation,
                'tc_agree' => true,
                'role_id' => $request->role_id,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password)
            ]);

            if ($user->wasRecentlyCreated) {
                UserInformation::create([
                    'member_id' => $user->id,
                    'how_did_you_hear_about_junk' => $request->how_did_you_hear_about_junk,
                    'member_referral' => $request->member_referral,
                    'influencer_referral' => $request->influencer_referral,
                    'employee_referral' => $request->employee_referral,
                    'heart_condition' => $request->heart_condition,
                    'seizure_disorder' => $request->seizure_disorder,
                    'dizziness_or_fainting' => $request->dizziness_or_fainting,
                    'hypertension' => $request->hypertension,
                    'asthma' => $request->asthma,
                    'h_a_h_p_e_t_y_t_y_s_n_p_a' => $request->h_a_h_p_e_t_y_t_y_s_n_p_a,
                    'd_y_h_l_t_c_p_y_f_p_a' => $request->d_y_h_l_t_c_p_y_f_p_a,
                    'd_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a' => $request->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a,
                    'h_y_e_s_f_r_d' => $request->h_y_e_s_f_r_d,
                    'h_y_e_s_f_f_m_o_l_o_b' => $request->h_y_e_s_f_f_m_o_l_o_b,
                    'd_y_e_f_a' => $request->d_y_e_f_a,
                    'description' => $request->description,
                    'a_y_c_t_a_m' => $request->a_y_c_t_a_m,
                    'a_y_c_p' => $request->a_y_c_p,
                    'confirm_data' => $request->confirm_data,
                    'h_d_y_h_a_u' => $request->h_d_y_h_a_u,
                    'referral_name' => $request->referral_name,
                    'w_i_y_m_g_p' => $request->w_i_y_m_g_p,
                    'w_i_y_p_f_g' => $request->w_i_y_p_f_g,
                    'w_c_i_y_t_m_a_j' => $request->w_c_i_y_t_m_a_j,
                    'w_c_w_y_l_t_s_j_o' => $request->w_c_w_y_l_t_s_j_o,
                    'd_y_c_e' => $request->d_y_c_e,
                    'w_a_y_c_d_f_e' => $request->w_a_y_c_d_f_e,
                    'h_o_d_y_w_o_e_w' => $request->h_o_d_y_w_o_e_w,
                    'w_t_o_d_i_b_f_y_t_e_a_j_c' => $request->w_t_o_d_i_b_f_y_t_e_a_j_c,
                    'w_d_a_b_f_y_t_b_y_j_c' => $request->w_d_a_b_f_y_t_b_y_j_c,
                    'w_a_y_p_f_g' => $request->w_a_y_p_f_g,
                    'w_c_h_y_e_r_y_f_g' => $request->w_c_h_y_e_r_y_f_g,
                    'h_y_e_u_p_g_t_i_t_p' => $request->h_y_e_u_p_g_t_i_t_p,
                    'h_w_y_e' => $request->confirm_data,
                    'staff_name' => $request->confirm_data,
                ]);

                session()->flash('success', 'User successfully added');
                return redirect()->route('users.index');
            } else {
                session()->flash('error', 'User already found!');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('UserController@store', $th->getMessage());
            session()->flash('error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    public function showcoach(User $user)
    {
        return view('dashboard.coach.show', compact('user'));
    }

    public function getsessionusers($sessionid)
    {
        $session = Session::find($sessionid);
        $users = $session->users->where('role_id', 4);
        return view('dashboard.users.index', compact('users'));
    }

    public function getsessionusersindate($sessionid, $date)
    {
        $session = Session::find($sessionid);
        $usersids = Book::where('session_id', $session->id)->where('bookdate', $date)->where('status', 'Pending')->pluck('member_id');
        $users = User::whereIn('id', $usersids)->where('role_id', 4)->get();
        return view('dashboard.users.index', compact('users'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function editcoach(User $user)
    {
        return view('dashboard.coach.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'whats_app_phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'emergency_contact_number' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'role_id' => 'in:' . implode(',', [1, 2, 3, 4])
        ]);
        if ($validator->fails()) {
            $errorslist = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                $errorslist .= $value[0];
            }
            session()->flash('error', $errorslist);
            return redirect()->back();
        }

        try {
            $user = User::find($id);
            if ($user == null) {
                return redirect()->back()->with(['error', 'User not found!']);
            }

            $age = null;
            if ($request->dob != null) {
                $age = Carbon::parse($request->dob)->diff(now())->y;
            }


            if ($request->name != null) {
                $name = explode(' ', $request->name);
                $fname = isset($name[0]) ? $name[0] : null;
                $lname = isset($name[1]) ? $name[1] : null;
            } else {
                $fname  = $request->fname;
                $lname  = $request->lname;
            }

            $user->fname = $fname;
            $user->lname = $lname;
            $request->gender != null ? $user->gender = $request->gender : null;
            $request->screen_name != null ? $user->screen_name = $request->screen_name : null;
            $request->dob != null ? $user->dob = $request->dob : null;
            $request->dob != null ? $user->age = $age : null;
            $request->height != null ? $user->height = $request->height : null;
            $request->weight != null ? $user->weight = $request->weight : null;
            $request->address1 != null ? $user->address1 = $request->address1 : null;
            $request->address2 != null ? $user->address2 = $request->address2 : null;
            $request->city != null ? $user->city = $request->city : null;
            $request->state != null ? $user->state = $request->state : null;
            $request->zip_code != null ? $user->zip_code = $request->zip_code : null;
            $request->country != null ? $user->country = $request->country : null;
            $request->phone != null ? $user->phone = $request->phone : null;
            $request->whats_app_phone != null ? $user->whats_app_phone = $request->whats_app_phone : null;
            $request->referred_by != null ? $user->referred_by = $request->referred_by : null;
            $request->emergency_contact_name != null ? $user->emergency_contact_name = $request->emergency_contact_name : null;
            $request->emergency_contact_number != null ? $user->emergency_contact_number = $request->emergency_contact_number : null;
            $request->emergency_contact_relation != null ? $user->emergency_contact_relation = $request->emergency_contact_relation : null;
            $request->tc_agree != null ? $user->tc_agree = $request->tc_agree : null;
            $request->role_id != null ? $user->role_id = $request->role_id : null;
            $request->password != null ? $user->password = Hash::make($request->password) : null;
            $user->save();

            // update user information
            $userinfo = UserInformation::where('member_id', $id)->first();
            if ($userinfo != null) {
                $request->how_did_you_hear_about_junk != null ? $userinfo->how_did_you_hear_about_junk = $request->how_did_you_hear_about_junk : null;
                $request->member_referral != null ? $userinfo->member_referral = $request->member_referral : null;
                $request->influencer_referral != null ? $userinfo->influencer_referral = $request->influencer_referral : null;
                $request->employee_referral != null ? $userinfo->employee_referral = $request->employee_referral : null;
                $request->heart_condition != null ? $userinfo->heart_condition = $request->heart_condition : null;
                $request->seizure_disorder != null ? $userinfo->seizure_disorder = $request->seizure_disorder : null;
                $request->dizziness_or_fainting != null ? $userinfo->dizziness_or_fainting = $request->dizziness_or_fainting : null;
                $request->hypertension != null ? $userinfo->hypertension = $request->hypertension : null;
                $request->asthma != null ? $userinfo->asthma = $request->asthma : null;
                $request->h_a_h_p_e_t_y_t_y_s_n_p_a != null ? $userinfo->h_a_h_p_e_t_y_t_y_s_n_p_a = $request->h_a_h_p_e_t_y_t_y_s_n_p_a : null;
                $request->d_y_h_l_t_c_p_y_f_p_a != null ? $userinfo->d_y_h_l_t_c_p_y_f_p_a = $request->d_y_h_l_t_c_p_y_f_p_a : null;
                $request->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a != null ? $userinfo->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a = $request->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a : null;
                $request->h_y_e_s_f_r_d != null ? $userinfo->h_y_e_s_f_r_d = $request->h_y_e_s_f_r_d : null;
                $request->h_y_e_s_f_f_m_o_l_o_b != null ? $userinfo->h_y_e_s_f_f_m_o_l_o_b = $request->h_y_e_s_f_f_m_o_l_o_b : null;
                $request->d_y_e_f_a != null ? $userinfo->d_y_e_f_a = $request->d_y_e_f_a : null;
                $request->description != null ? $userinfo->description = $request->description : null;
                $request->a_y_c_t_a_m != null ? $userinfo->a_y_c_t_a_m = $request->a_y_c_t_a_m : null;
                $request->a_y_c_p != null ? $userinfo->a_y_c_p = $request->a_y_c_p : null;
                $request->confirm_data != null ? $userinfo->confirm_data = $request->confirm_data : null;
                $request->h_d_y_h_a_u != null ? $userinfo->h_d_y_h_a_u = $request->h_d_y_h_a_u : null;
                $request->referral_name != null ? $userinfo->referral_name = $request->referral_name : null;
                $request->w_i_y_m_g_p != null ? $userinfo->w_i_y_m_g_p = $request->w_i_y_m_g_p : null;
                $request->w_i_y_p_f_g != null ? $userinfo->w_i_y_p_f_g = $request->w_i_y_p_f_g : null;
                $request->w_c_i_y_t_m_a_j != null ? $userinfo->w_c_i_y_t_m_a_j = $request->w_c_i_y_t_m_a_j : null;
                $request->w_c_w_y_l_t_s_j_o != null ? $userinfo->w_c_w_y_l_t_s_j_o = $request->w_c_w_y_l_t_s_j_o : null;
                $request->d_y_c_e != null ? $userinfo->d_y_c_e = $request->d_y_c_e : null;
                $request->w_a_y_c_d_f_e != null ? $userinfo->w_a_y_c_d_f_e = $request->w_a_y_c_d_f_e : null;
                $request->h_o_d_y_w_o_e_w != null ? $userinfo->h_o_d_y_w_o_e_w = $request->h_o_d_y_w_o_e_w : null;
                $request->w_t_o_d_i_b_f_y_t_e_a_j_c != null ? $userinfo->w_t_o_d_i_b_f_y_t_e_a_j_c = $request->w_t_o_d_i_b_f_y_t_e_a_j_c : null;
                $request->w_d_a_b_f_y_t_b_y_j_c != null ? $userinfo->w_d_a_b_f_y_t_b_y_j_c = $request->w_d_a_b_f_y_t_b_y_j_c : null;
                $request->w_a_y_p_f_g != null ? $userinfo->w_a_y_p_f_g = $request->w_a_y_p_f_g : null;
                $request->w_c_h_y_e_r_y_f_g != null ? $userinfo->w_c_h_y_e_r_y_f_g = $request->w_c_h_y_e_r_y_f_g : null;
                $request->h_y_e_u_p_g_t_i_t_p != null ? $userinfo->h_y_e_u_p_g_t_i_t_p = $request->h_y_e_u_p_g_t_i_t_p : null;
                $request->h_w_y_e != null ? $userinfo->h_w_y_e = $request->h_w_y_e : null;
                $request->staff_name != null ? $userinfo->staff_name = $request->staff_name : null;

                $userinfo->save();
            }

            session()->flash('success', 'User updated');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('UserController@update', $th->getMessage());
            session()->flash('error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id);
            return redirect()->back();
        }
    }
    public function updatecoach(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'whats_app_phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'emergency_contact_number' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'role_id' => 'in:' . implode(',', [1, 2, 3, 4])
        ]);
        if ($validator->fails()) {
            $errorslist = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                $errorslist .= $value[0];
            }
            return redirect()->route('users.index')->with(['error' => $errorslist]);
        }
        $user = User::find($id);
        if ($user == null)
            return redirect()->route('users.index')->with(['error' => 'Coach not found!']);

        try {

            $age = null;
            if ($request->dob != null) {
                $age = Carbon::parse($request->dob)->diff(now())->y;
            }

            if ($request->name != null) {
                $name = explode(' ', $request->name);
                $fname = isset($name[0]) ? $name[0] : null;
                $lname = isset($name[1]) ? $name[1] : null;
            } else {
                $fname  = $request->fname;
                $lname  = $request->lname;
            }

            // coach image
            $fileName = null;
            if ($request->image != null && $request->image != "undefined") {
                $fileName = rand(0, 10000) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/coaches/'), $fileName);
                if ($user->image != null) {
                    unlink($user->image);
                }
            }

            $user->fname = $fname;
            $user->lname = $lname;
            $request->gender != null ? $user->gender = $request->gender : null;
            $request->screen_name != null ? $user->screen_name = $request->screen_name : null;
            $request->dob != null ? $user->dob = $request->dob : null;
            $request->image != null ? $user->image = 'images/coaches/' . $fileName : null;
            $request->dob != null ? $user->age = $age : null;
            $request->height != null ? $user->height = $request->height : null;
            $request->weight != null ? $user->weight = $request->weight : null;
            $request->address1 != null ? $user->address1 = $request->address1 : null;
            $request->address2 != null ? $user->address2 = $request->address2 : null;
            $request->city != null ? $user->city = $request->city : null;
            $request->state != null ? $user->state = $request->state : null;
            $request->zip_code != null ? $user->zip_code = $request->zip_code : null;
            $request->country != null ? $user->country = $request->country : null;
            $request->phone != null ? $user->phone = $request->phone : null;
            $request->whats_app_phone != null ? $user->whats_app_phone = $request->whats_app_phone : null;
            $request->referred_by != null ? $user->referred_by = $request->referred_by : null;
            $request->emergency_contact_name != null ? $user->emergency_contact_name = $request->emergency_contact_name : null;
            $request->emergency_contact_number != null ? $user->emergency_contact_number = $request->emergency_contact_number : null;
            $request->emergency_contact_relation != null ? $user->emergency_contact_relation = $request->emergency_contact_relation : null;
            $request->tc_agree != null ? $user->tc_agree = $request->tc_agree : null;
            $request->password != null ? $user->password = Hash::make($request->password) : null;

            $user->save();
            session()->flash('success', 'Coach updated');
            return redirect()->route('web_index_coaches');
        } catch (\Throwable $th) {
            $this->errorLog('UserController@update', $th->getMessage());
        }
    }

    ///////////////////////destroy user
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user == null)
                return response()->json([
                    'success' => false, 'message' => 'User not found!'
                ]);

            if ($user->id == 1) {
                session()->flash('error', "You cann't delete primary admin");
                return redirect()->back();
            }

            $hasorder = Order::where('member_id', $user->id)->count();
            if ($hasorder > 0) {
                session()->flash('error', "User has orders, you should delete it before continue");
                return redirect()->back();
            }

            $hasbooks = Book::where('member_id', $id)->count();
            if ($hasbooks != 0) {
                session()->flash('error', 'User has books, you should delete it before continue');
                return redirect()->back();
            }

            UserInformation::where('member_id', $user->id)->delete();
            $user->delete();
            session()->flash('success', 'User deleted');
            return redirect()->back();
        } catch (\Throwable $th) {
            $this->errorLog('UserController@destroy', $th->getMessage());
        }
    }

    public function destroycoach($id)
    {
        try {
            $user = User::find($id);
            if ($user == null)
                return response()->json([
                    'success' => false, 'message' => 'User not found!'
                ]);

            // check if coach has sessions
            $iscoach = Session::where('coach_id', $id)->count();
            if ($iscoach != 0) {
                session()->flash('error', 'Coach has sessions, unassign coach sessions first after that you can delete him');
                return redirect()->back();
            }
            if ($user->image != null) {
                unlink($user->image);
            }
            $user->delete();
            session()->flash('success', 'Coach deleted');
            return redirect()->back();
        } catch (\Throwable $th) {
            $this->errorLog('UserController@destroy', $th->getMessage());
        }
    }

    // public function adduserinfo(Request $request, $id)
    // {
    //     $user = User::find($id);
    //     if ($user == null)
    //         throw ValidationException::withMessages(['id' => 'User not found!']);

    //     if ($user->role_id != 4)
    //         throw ValidationException::withMessages(['id' => 'This is not a member user!']);

    //     try {
    //         $userinfo = UserInformation::firstOrCreate([
    //             'member_id' => $id
    //         ], [
    //             'member_id' => $id,
    //             'how_did_you_hear_about_junk' => $request->how_did_you_hear_about_junk,
    //             'member_referral' => $request->member_referral,
    //             'influencer_referral' => $request->influencer_referral,
    //             'employee_referral' => $request->employee_referral,
    //             'heart_condition' => $request->heart_condition,
    //             'seizure_disorder' => $request->seizure_disorder,
    //             'dizziness_or_fainting' => $request->dizziness_or_fainting,
    //             'hypertension' => $request->hypertension,
    //             'asthma' => $request->asthma,
    //             'h_a_h_p_e_t_y_t_y_s_n_p_a' => $request->h_a_h_p_e_t_y_t_y_s_n_p_a,
    //             'd_y_h_l_t_c_p_y_f_p_a' => $request->d_y_h_l_t_c_p_y_f_p_a,
    //             'd_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a' => $request->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a,
    //             'h_y_e_s_f_r_d' => $request->h_y_e_s_f_r_d,
    //             'h_y_e_s_f_f_m_o_l_o_b' => $request->h_y_e_s_f_f_m_o_l_o_b,
    //             'd_y_e_f_a' => $request->d_y_e_f_a,
    //             'description' => $request->description,
    //             'a_y_c_t_a_m' => $request->a_y_c_t_a_m,
    //             'a_y_c_p' => $request->a_y_c_p,
    //             'confirm_data' => $request->confirm_data,
    //             'h_d_y_h_a_u' => $request->h_d_y_h_a_u,
    //             'referral_name' => $request->referral_name,
    //             'w_i_y_m_g_p' => $request->w_i_y_m_g_p,
    //             'w_i_y_p_f_g' => $request->w_i_y_p_f_g,
    //             'w_c_i_y_t_m_a_j' => $request->w_c_i_y_t_m_a_j,
    //             'w_c_w_y_l_t_s_j_o' => $request->w_c_w_y_l_t_s_j_o,
    //             'd_y_c_e' => $request->d_y_c_e,
    //             'w_a_y_c_d_f_e' => $request->w_a_y_c_d_f_e,
    //             'h_o_d_y_w_o_e_w' => $request->h_o_d_y_w_o_e_w,
    //             'w_t_o_d_i_b_f_y_t_e_a_j_c' => $request->w_t_o_d_i_b_f_y_t_e_a_j_c,
    //             'w_d_a_b_f_y_t_b_y_j_c' => $request->w_d_a_b_f_y_t_b_y_j_c,
    //             'w_a_y_p_f_g' => $request->w_a_y_p_f_g,
    //             'w_c_h_y_e_r_y_f_g' => $request->w_c_h_y_e_r_y_f_g,
    //             'h_y_e_u_p_g_t_i_t_p' => $request->h_y_e_u_p_g_t_i_t_p,
    //             'h_w_y_e' => $request->confirm_data,
    //             'staff_name' => $request->confirm_data,
    //         ]);

    //         if ($userinfo->wasRecentlyCreated) {
    //             session()->flash('success', 'User info added');
    //             return redirect()->route('users.index');
    //         } else {
    //             session()->flash('error', 'User info already found!');
    //             return redirect()->route('users.index');
    //         }
    //     } catch (\Throwable $th) {
    //         $this->errorLog('UserController@adduserinfo', $th->getMessage());
    //     }
    // }

    public function edituserinfo(Request $request, $id)
    {
        $user = User::find($id);
        if ($user == null)
            throw ValidationException::withMessages(['id' => 'User not found!']);

        if ($user->role_id != 4)
            throw ValidationException::withMessages(['id' => 'This is not a member user!']);

        $userinfo = UserInformation::where('member_id', $id)->first();
        if ($userinfo == null)
            throw ValidationException::withMessages(['You should add user info first!']);

        try {

            $request->how_did_you_hear_about_junk != null ? $userinfo->how_did_you_hear_about_junk = $request->how_did_you_hear_about_junk : null;
            $request->member_referral != null ? $userinfo->member_referral = $request->member_referral : null;
            $request->influencer_referral != null ? $userinfo->influencer_referral = $request->influencer_referral : null;
            $request->employee_referral != null ? $userinfo->employee_referral = $request->employee_referral : null;
            $request->heart_condition != null ? $userinfo->heart_condition = $request->heart_condition : null;
            $request->seizure_disorder != null ? $userinfo->seizure_disorder = $request->seizure_disorder : null;
            $request->dizziness_or_fainting != null ? $userinfo->dizziness_or_fainting = $request->dizziness_or_fainting : null;
            $request->hypertension != null ? $userinfo->hypertension = $request->hypertension : null;
            $request->asthma != null ? $userinfo->asthma = $request->asthma : null;
            $request->h_a_h_p_e_t_y_t_y_s_n_p_a != null ? $userinfo->h_a_h_p_e_t_y_t_y_s_n_p_a = $request->h_a_h_p_e_t_y_t_y_s_n_p_a : null;
            $request->d_y_h_l_t_c_p_y_f_p_a != null ? $userinfo->d_y_h_l_t_c_p_y_f_p_a = $request->d_y_h_l_t_c_p_y_f_p_a : null;
            $request->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a != null ? $userinfo->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a = $request->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a : null;
            $request->h_y_e_s_f_r_d != null ? $userinfo->h_y_e_s_f_r_d = $request->h_y_e_s_f_r_d : null;
            $request->h_y_e_s_f_f_m_o_l_o_b != null ? $userinfo->h_y_e_s_f_f_m_o_l_o_b = $request->h_y_e_s_f_f_m_o_l_o_b : null;
            $request->d_y_e_f_a != null ? $userinfo->d_y_e_f_a = $request->d_y_e_f_a : null;
            $request->description != null ? $userinfo->description = $request->description : null;
            $request->a_y_c_t_a_m != null ? $userinfo->a_y_c_t_a_m = $request->a_y_c_t_a_m : null;
            $request->a_y_c_p != null ? $userinfo->a_y_c_p = $request->a_y_c_p : null;
            $request->confirm_data != null ? $userinfo->confirm_data = $request->confirm_data : null;
            $request->h_d_y_h_a_u != null ? $userinfo->h_d_y_h_a_u = $request->h_d_y_h_a_u : null;
            $request->referral_name != null ? $userinfo->referral_name = $request->referral_name : null;
            $request->w_i_y_m_g_p != null ? $userinfo->w_i_y_m_g_p = $request->w_i_y_m_g_p : null;
            $request->w_i_y_p_f_g != null ? $userinfo->w_i_y_p_f_g = $request->w_i_y_p_f_g : null;
            $request->w_c_i_y_t_m_a_j != null ? $userinfo->w_c_i_y_t_m_a_j = $request->w_c_i_y_t_m_a_j : null;
            $request->w_c_w_y_l_t_s_j_o != null ? $userinfo->w_c_w_y_l_t_s_j_o = $request->w_c_w_y_l_t_s_j_o : null;
            $request->d_y_c_e != null ? $userinfo->d_y_c_e = $request->d_y_c_e : null;
            $request->w_a_y_c_d_f_e != null ? $userinfo->w_a_y_c_d_f_e = $request->w_a_y_c_d_f_e : null;
            $request->h_o_d_y_w_o_e_w != null ? $userinfo->h_o_d_y_w_o_e_w = $request->h_o_d_y_w_o_e_w : null;
            $request->w_t_o_d_i_b_f_y_t_e_a_j_c != null ? $userinfo->w_t_o_d_i_b_f_y_t_e_a_j_c = $request->w_t_o_d_i_b_f_y_t_e_a_j_c : null;
            $request->w_d_a_b_f_y_t_b_y_j_c != null ? $userinfo->w_d_a_b_f_y_t_b_y_j_c = $request->w_d_a_b_f_y_t_b_y_j_c : null;
            $request->w_a_y_p_f_g != null ? $userinfo->w_a_y_p_f_g = $request->w_a_y_p_f_g : null;
            $request->w_c_h_y_e_r_y_f_g != null ? $userinfo->w_c_h_y_e_r_y_f_g = $request->w_c_h_y_e_r_y_f_g : null;
            $request->h_y_e_u_p_g_t_i_t_p != null ? $userinfo->h_y_e_u_p_g_t_i_t_p = $request->h_y_e_u_p_g_t_i_t_p : null;
            $request->h_w_y_e != null ? $userinfo->h_w_y_e = $request->h_w_y_e : null;
            $request->staff_name != null ? $userinfo->staff_name = $request->staff_name : null;

            $userinfo->save();

            session()->flash('success', 'User info updated');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            $this->errorLog('UserController@edituserinfo', $th->getMessage());
        }
    }

    public function verifyemail($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = User::find($verifyUser->user_id);

            if (Carbon::parse($verifyUser->updated_at)->addHours(48)->isPast()) {
                $verifyUser->delete();
                $message = 'This password reset token is invalid.';
                return redirect()->route('login')->with('message', $message);
            }

            if (!$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }

    public function indexcoaches()
    {
        $users = User::orderBy('created_at', 'desc')->where('role_id', 3)->get();
        return view('dashboard.coach.index', compact('users'));
    }

    public function createcoach(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'whats_app_phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'emergency_contact_number' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'email' => 'required|email|unique:users,id',
            'password' => 'required|min:5|required_with:password_confirmation|same:password_confirmation'
        ]);
        if ($validator->fails()) {
            $errorslist = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                $errorslist .= $value[0];
            }
            return redirect()->route('web_index_coaches')->with(['error' => $errorslist]);
        }

        try {
            $age = null;
            if ($request->dob != null) {
                $age = Carbon::parse($request->dob)->diff(now())->y;
            }

            if ($request->name != null) {
                $name = explode(' ', $request->name);
                $fname = isset($name[0]) ? $name[0] : null;
                $lname = isset($name[1]) ? $name[1] : null;
            } else {
                $fname  = $request->fname;
                $lname  = $request->lname;
            }

            // coach image
            $fileName = null;
            if ($request->image != null && $request->image != "undefined") {
                $fileName = rand(0, 10000) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/coaches/'), $fileName);
            }

            $user = User::firstOrCreate([
                'email' => $request->email
            ], [
                'email' => $request->email,
                'fname' => $fname,
                'lname' => $lname,
                'image' => "images/coaches/" . $fileName,
                'gender' => $request->gender,
                'screen_name' => $request->screen_name,
                'dob' => $request->dob,
                'age' => $age,
                'height' => $request->height,
                'weight' => $request->weight,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'phone' => $request->phone,
                'whats_app_phone' => $request->whats_app_phone,
                'referred_by' => $request->referred_by,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_number' => $request->emergency_contact_number,
                'emergency_contact_relation' => $request->emergency_contact_relation,
                'tc_agree' => true,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
                'email_verified_at' => now()
            ]);

            if ($user->wasRecentlyCreated) {
                // // generate verification message
                // $token = Str::random(64);

                // UserVerify::create([
                //     'user_id' => $user->id,
                //     'token' => $token
                // ]);

                // $signupdata = [
                //     'memberemail' => $user->email,
                //     'membername' => $user->username(),
                //     'userlink' => route('users.show', $user->id),
                //     'link' => url('/verifyemail/' . $token)
                // ];

                // JobSendSignupEmailForUserAndAdmin::dispatch($signupdata);
                // session()->flash('success', 'New coach created successffully');
                return redirect()->route('web_index_coaches')->with(['success' => 'New coach created successffully']);
            } else {
                return redirect()->route('web_index_coaches')->with(['error' => 'User already found!']);
                // session()->flash('error', 'User already found!');
                // return redirect()->back();
            }
        } catch (\Throwable $th) {
            $this->errorLog('UserController@store', $th->getMessage());
        }
    }

    public function listservicerates()
    {
        $rates = ServiceRating::all();
        $users = User::get();
        foreach ($rates as $key => $rate) {
            $rate->member_name = $users->where('id', $rate->memeber_id)->first()->username();
            $rate->is_your_elements_accurately_found = $rate->is_your_elements_accurately_found == 1 ? 'Yes' : 'No';
            $rate->did_you_need_customers_service = $rate->did_you_need_customers_service == 1 ? 'Yes' : 'No';
        }
        return view('dashboard.rates.index', ['rates' => $rates]);
    }

    public function destroyrate($id)
    {
        ServiceRating::where('memeber_id', $id)->delete();
        session()->flash('success', 'Member rate deleted');
        return redirect()->route('web_list_service_rates');
    }
}
