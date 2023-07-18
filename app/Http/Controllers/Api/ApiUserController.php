<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\JobSendSignupEmailForUserAndAdmin;
use App\Models\User;
use App\Models\Session;
use App\Models\UserInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Models\PackagesMember;
use App\Models\UserVerify;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

///
class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ////////////////////////////list all users    
    public function index()
    {
        try {

            $users = User::orderBy('created_at', 'desc')->where('role_id', "!=", 3)->paginate(10);

            if ($users != null)
                return response()->json(['success' => true, 'data' => $users]);
            else
                return response()->json(['success' => false, 'message' => 'Users not found!']);
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@index', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id], 500);
        }
    }

    //////////////////////////////////////register
    public function register(Request $request)
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
            return response()->json(['error' => $errorslist], 401);
        }
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

                $user->save();

                $success['token'] = $user->createToken('myApp')->accessToken;
                $success['name'] = $user->fname;

                return response()->json(['success' => $success], 200);
            } else {
                return response()->json(['message' => 'User already found'], 400);
            }
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@store', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id], 500);
        }
    }


    ////////////////////////login method
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'email' => 'required|email',

            'password' => 'required|min:5'

        ]);

        if ($validator->fails()) {
            $errorslist = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value) {
                $errorslist .= $value[0];
            }
            return response()->json(['error' => $errorslist], 401);
        }

        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $success['name'] =  $user->fname;

                return response()->json(['success' => $success], 200);
            } else {
                return response()->json(['success' => false], 401);
            }
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@login', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id], 500);
        }
    }

    ///////////////////////show user
    public function show($id)
    {
        try {
            $user = User::find($id);
            if ($user != null)
                return response()->json(['success' => true, 'data' => $user]);
            else
                return response()->json(['success' => false, 'message' => 'User not found!']);
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@login', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id], 500);
        }
    }
    /////////////////////////////////////edit user
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
            return response()->json(['error' => $errorslist]);
        }

        try {
            $user = User::find($id);
            if ($user == null) {
                return response()->json(['error' => 'user not found']);
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

            return response()->json(['success' => true, 'message' => 'The modification has been completed successfully']);
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@update', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id]);
        }
    }
    ///////////////////////////////////delete user
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if ($user == null)
                return response()->json([
                    'success' => false, 'message' => 'User not found!'
                ]);
            $user->delete();
            return response()->json([
                'success' => true, 'message' => 'User delete'
            ]);
        } catch (\Throwable $th) {
            $this->errorLog('ApiUserController@destroy', $th->getMessage());
        }
    }
    ///////////////////////////////add coach
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
            return response()->json(['error' => $errorslist]);
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

                return response()->json(['success' => true, 'message' => 'New coach created successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Coach already found']);
            }
        } catch (\Throwable $th) {
            $this->errorLog('UserController@store', $th->getMessage());
        }
    }
    //////////////////////update coache
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
            return response()->json(['errors' => $errorslist]);
        }
        $user = User::find($id);
        if ($user == null)
            return response()->json(['success' => true, 'message' => 'Coach not found']);

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
            //
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
            $request->image != null ? $user->image = 'images/coaches/' . $fileName : null;
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
            $request->password != null ? $user->password = Hash::make($request->password) : null;

            $user->save();
            return response()->json(['success' => true, 'message' => 'Coach update']);
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@updatecoach', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id]);
        }
    }

    //////////////////////////show coach
    public function showcoach($id)
    {
        try {
            $user = User::find($id);
            if ($user == null) {
                return response()->json(['success' => false, 'message' => 'coach not found']);
            }
            return response()->json(['success' => true, 'data' => $user]);
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@showcoach', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id]);
        }
    }
    ///////////////////////////////delete coach
    public function deletecoach($id)
    {
        try {
            $user = User::find($id);
            if ($user == null) {
                return response()->json(['success' => false, 'message' => 'coach not found']);
            }
            if ($user->image != null) {
                unlink($user->image);
            }
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Coach was deleted successfully']);
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@deletecoach', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id]);
        }
    }
    /////////////////////////////list coaches
    public function listcoaches()
    {

        try {
            $coaches = User::where('role_id', 3)->paginate(10);
            if ($coaches == null) {
                return response()->json(['succes' => false, 'message' => 'coaches not found']);
            } else {
                return response()->json(['success' => true, 'coaches' => $coaches]);
            }
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@deletecoach', $th->getMessage());
            return response()->json(['error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id]);
        }
    }

    ///////////////////
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
    ///////////////////////
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
            return response()->json(['success' => false, 'erroe' => $errorslist], 400);
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


            return response()->json(['success' => true, 'message' => 'User successfully added']);
        } catch (\Throwable $th) {
            $reference_error_id = $this->errorLog('ApiUserController@store', $th->getMessage());
            session()->flash('error', 'Error happen pleas contatct administrator, error reference_' . $reference_error_id);
            return redirect()->back();
        }
    }



    ///////////////////////////////


    ///////////////////////////////
    public function smallcreate(Request $request)
    {
        try {
            $dob = Carbon::create($request->year, $request->month, $request->day);
            $validator = Validator::make($request->all(), ['name' => 'email']);
            if ($validator->fails()) {
                $validator1 = Validator::make($request->all(), ['name' => 'regex:/^\+(?:[0-9] ?){8,14}[0-9]$/', 'password' => 'required'], ['name.regex' => 'invalid phone number format']);
                if ($validator1->fails()) {
                    return response()->json(['success' => false, 'message' => $validator1->getMessageBag()], 401);
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
                    $user->save();
                    $success['token'] = $user->createToken('myApp')->accessToken;
                    if (!$user->wasRecentlyCreated) {
                        return response()->json(['success' => false, 'message' => 'Phone number already found '], 401);
                    } else {
                        return response()->json(['success' => true, 'token' => $success]);
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
                    $user->save();
                    $success['token'] = $user->createToken('myApp')->accessToken;
                    if (!$user->wasRecentlyCreated) {
                        return response()->json(['success' => false, 'message' => 'Email address already found'], 401);
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
                        return response()->json(['success' => true, 'message' => 'Your registration is submitted, please review your email!', 'token' => $success]);
                    }
                }
            }
        } catch (\Throwable $th) {
            $id = $this->errorLog('ApiUserController@smallcreate', $th->getMessage());
            return response()->json(['success' => false, 'message' => 'Error call supporting team @' . $id]);
        }
    }
}
