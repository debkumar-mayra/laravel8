<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Mail\Registration;
use App\Models\OtpVerification;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\UserProfile;
use App\Notifications\UserNotification;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use Validator;

class UserController extends Controller
{
    function dashboard()
    {
    	 return view('user.index');
    }


    function login(Request $request)
    {
        if( Auth::guard('siteUser')->user() ) {
        return redirect("dashboard");
        }
        if ( $request->all() ) {
        $validator = $request->validate(
        [
        "email"=>"required|email",
        "password"=>"required|min:6",
        ],[
        "email.email" => "Enter valid email addess.",
        "password.min" => "Minimum value is 6 chareacter."
        ]
        );
        // if(!$validator->fails()){
        $user_info = array(
        "email"=>$request->email,
        "password"=>$request->password,
        );

        if (Auth::guard("siteUser")->attempt($user_info) && Auth::attempt($user_info) ) {
        $user_details = Auth::guard("siteUser")->user();
        return redirect("dashboard");
        } else {
        Session::flash('Error-toastr', 'envalid credentials.');
        return redirect()->route('login');
        }
        }
        return view('frontend.login');
    }



    function registration(Request $request)
    {
      return view('frontend.registration');
    }



    function createUser(Request $request)
    {

       $validator = $request->validate(
           [
              "name"=>"required",
              "email"=>"required|email|unique:users,email",
              "password"=>"required|min:6",
              "con_password"=>"required|same:password",
            ]
      );

        DB::beginTransaction();
    try {
  
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->save();
    
    		$role = Role::where('role','user')->first();
         $user->role = $role->id;
         $user->save();

         $notifyDetails['title'] = 'New user Registration';
         $notifyDetails['user_id'] = $user->id;
         $notifyDetails['type'] = 'registration';
         $notifyDetails['body'] = ucfirst($request->name).' Registration in your site';
         $admin = User::whereRole(1)->first();
         $admin->notify(new UserNotification($notifyDetails));

        Mail::to($request->email)->send(new Registration($user->id));
        DB::commit();
    	if(!empty($user->id)){
            Session::flash('Success-sweet', 'Thank you for Registration.');
          } else {
            Session::flash('Error-toastr', 'Something want wrong. Please try again.');
          }

        return redirect()->route('registration');
        } catch (\Exception $e) {
          print_r($e->getMessage()); exit;
            Session::flash('Error-toastr', $e->getMessage());
            DB::rollback();
            return redirect()->back();
        }
    }

   

    public function emailVerification($id)
    {
          $user_id = Crypt::decrypt($id);
          $user = User::find($user_id);
          if($user->email_verified_at != null){
          return redirect()->route('login')->with('Info-sweet','Your email already verifyed.');
          }
          $user->email_verified_at = date('Y-m-d H:i:s');
        if ($user->save()) {
          return redirect()->route('login')->with('Success-sweet','Your email successfully verifyed.');
        } else {
          return redirect()->route('login')->with('Error-sweet','Something went wrong.');
        }
    }

    public function profile(Request $request)
    {
      if($request->isMethod('post')){
         $data = $request->validate([
      "name"=>"sometimes|required|min:3|max:100",
      "mobile"=>"sometimes|nullable|digits:10",
      "dob"=>"sometimes|nullable|date|before_or_equal:".now()->subYears(13)->format('Y-m-d'),
      "profile_photo"=>"sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048",
      "old_password"=>"sometimes|nullable|required",
      "new_password"=>"sometimes|nullable|required|min:6",
      "confirm_password"=>"sometimes|nullable|required|same:new_password",
      ], ['dob.before_or_equal'=>'You must be 13 years old or above.']);


    try {
     $user = Auth::guard('siteUser')->user();
      if(!empty($request->email) && ($user->email != $request->email)){
          $request->validate([
          'email' => 'sometimes|nullable|required|unique:users,email',
        ]);
         }
     if(!empty($request->name) ) $user->name = $request->name;
     if(!empty($request->email) && ($user->email != $request->email)) $user->email = $request->email;
      if (isset($request->old_password) && !empty($request->old_password)) {
        if (!(Hash::check($request->old_password, Auth::guard('siteUser')->user()->password))) {
            Session::flash('Error-toastr', 'Your old password does not matches');
           return redirect()->back();
        } elseif (!empty($request->new_password)){
        $user->password = Hash::make($request->new_password);
        }
      }
     
     $user->save();
     $profile = UserProfile::where('user_id',$user->id)->first();
     $profile = $profile ?? new UserProfile;
     $profile->user_id = $user->id;

     if(!empty($request->dob) ) $profile->dob = $request->dob;
     if(!empty($request->mobile) ) $profile->mobile = $request->mobile;
     if(!empty($request->gender) ) $profile->gender = $request->gender;
     if(!empty($request->address) ) $profile->address = $request->address;
     if(!empty($request->about) ) $profile->about = $request->about;
 
      if ($request->hasFile('profile_photo')) {
            $rand_val           = date('YMDHIS').rand(11111,99999);
            $image_file_name    = md5($rand_val);
            $file               = $request->file('profile_photo');
            $extension          = $request->file('profile_photo')->extension();
            $fileName           = $image_file_name.'.'.$extension;
            $destinationPath    = public_path().'/uploads/users/';
            $file->move($destinationPath,$fileName);
            $profile->profile_photo = $fileName;
          }
          $profile->save();
          Session::flash('Success-toastr','Profile Successfully updated');
       } catch (\Exception $e) {
            Session::flash('Error-toastr', $e->getMessage());
        }
            return redirect()->back();
      }
      $user = Auth::user();
      return view('user.profile', compact('user'));
    }

     function logout()
     {
     	Session::flush();
     	Auth::guard("siteUser")->logout();
     	return redirect()->route('login');
     }


}
