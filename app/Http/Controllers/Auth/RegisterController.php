<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\JobSendSignupEmailForUserAndAdmin;
use App\Mail\EmailSignupToAdmin;
use App\Mail\EmailSignupToUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
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
            session()->flash('error', $errorslist);
            return redirect()->back();
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
                // generate verification message
                $token = Str::random(64);

                UserVerify::create([
                    'user_id' => $user->id,
                    'token' => $token
                ]);

                $signupdata = [
                    'memberemail' => $user->email,
                    'membername' => $user->username(),
                    'userlink' => route('users.show', $user->id),
                    'link' => url('/verifyemail/' . $token)
                ];

                JobSendSignupEmailForUserAndAdmin::dispatch($signupdata);
                session()->flash('success', 'Your registration is submitted, please review your email!');
                return redirect()->route('front-home');
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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'whats_app_phone' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
            'emergency_contact_number' => 'nullable|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/'
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
            return redirect()->route('my-profile');
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('UserController@update', $th->getMessage());
            session()->flash('error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id);
            return redirect()->back();
        }
    }

    public function smallcreate(Request $request)
    {
        try {
         
            $dob = Carbon::create($request->year, $request->month, $request->day);
            $validator = Validator::make($request->all(), ['name' => 'email']);
            if ($validator->fails()) {
                $validator1 = Validator::make($request->all(), ['name' => 'regex:/^\+(?:[0-9] ?){8,14}[0-9]$/'], ['name.regex' => 'invalid phone number format']);
                if ($validator1->fails()) {
                    return redirect()->route('login')->with(['error' => 'Invalid phone number format']);
                } else {
                    $user = User::firstOrCreate([
                        'phone' => $request->name
                    ], [
                        'phone' => $request->name,
                        'f-name' => $request->fname,
                        'l-name' => $request->lname,
                        'dob' => $dob,
                        'gender' => $request->gender,
                        'role_id' => 4,
                        'email_verified_at' => now(),
                        'password' => Hash::make($request->password)
                    ]);
                    if (!$user->wasRecentlyCreated) {
                        return redirect()->route('login')->with(['error' => 'Phone number already found!']);
                    } else {
                        return redirect()->route('front-home')->with(['success' => 'success']);
                    }
                }
            } else {
                $validator2 = Validator::make($request->all(), ['name' => 'required', 'password' => 'required']);
                if ($validator2->fails()) {
                    return response()->json(['success' => false, 'message' => $validator2->getMessageBag()], 401);
                } else {
                    $user = User::firstOrCreate([
                        'email' => $request->name
                    ], [
                        'email' => $request->name,
                        'f-name' => $request->fname,
                        'l-name' => $request->lname,
                        'dob' => $dob,
                        'gender' => $request->gender,
                        'role_id' => 4,
                        'password' => Hash::make($request->password)
                    ]);
                    if (!$user->wasRecentlyCreated) {
                        return redirect()->route('login')->with(['error' => 'Email address already found!']);
                    } else {
                        // generate verification message
                        $token = Str::random(64);

                        UserVerify::create([
                            'user_id' => $user->id,
                            'token' => $token
                        ]);

                        $signupdata = [
                            'memberemail' => $user->email,
                            'membername' => $user->username(),
                            'userlink' => route('users.show', $user->id),
                            'link' => url('/verifyemail/' . $token)
                        ];

                        JobSendSignupEmailForUserAndAdmin::dispatch($signupdata);
                        session()->flash('success', 'Your registration is submitted, please review your email!');
                        return redirect()->route('login');
                    }
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
