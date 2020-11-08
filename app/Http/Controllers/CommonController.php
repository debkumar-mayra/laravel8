<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use Validator;

class CommonController extends Controller
{
     function forgotPassword(Request $request)
    {
      if ($request->isMethod('post')) {
         $validator = $request->validate(
              ["email"=>"required|email",]
         );
    
        try{
         $user = User::where('email',$request->email)->first();
         if ($user) {
         OtpVerification::where(['email'=>$request->email])->delete();
          $otp = rand(100000,999999); 
            $otp_create = OtpVerification::create([
                'user_id'=>$user->id,
                'email'=>$request->email,
                'otp'=>$otp
            ]);

          Mail::to($request->email)->send(new ForgotPassword($user->id));
           Session::flash('Success-toastr', 'Please check your email.');
           return redirect()->route('reset-password', Crypt::encrypt($user->id));
         }else{
           Session::flash('Error-toastr', 'Please enter your registraterd email addess.');
         }
          } catch (\Exception $e) {
            print_r($e->getMessage()); exit;
            return redirect()->back()->with('Error-toastr', 'Something went wrong. Please try again.');
      }
    }
    	return view('frontend.forgot-password');
    }


    function resetPassword($id)
    {
    	$user_id = Crypt::decrypt($id);
        $user = User::find($user_id);
       return view('frontend.reset-password', compact('id','user'));
    }

    public function changePassword(Request $request)
    {
       $validator = $request->validate(
              [
                "otp"=>"required",
                "password"=>"required|min:6",
                "con_password"=>"required|same:password",
              ]
         );
          $user_id = Crypt::decrypt($request->user_id);
          $user = User::find($user_id);

          if ($user) {
             $get_otp = OtpVerification::where(['email'=>$user->email, 'otp'=>$request->otp])->first();
            if(!$get_otp ){
                return redirect()->back()->with('Error-toastr','Invalid OTP.');
            }
            $create_time = $get_otp->created_at;
            $create_time = strtotime($get_otp->created_at);
            $create_time = strtotime('+ 30 minutes',$create_time);
            $create_time = date('Y-m-d H:i:s',$create_time);

            if($create_time <= date('Y-m-d H:i:s')){
                OtpVerification::where(['id'=>$get_otp->id])->delete();
                return redirect()->back()->with('Error-toastr','Invalid OTP.');
            }

            $user->password = Hash::make($request->password);
            $result  = $user->save();
            OtpVerification::where(['email'=>$user->email])->delete();

            if($user->role == 1){
              return redirect()->route('admin.login')->with('Success-sweet', 'Your password successfully changed.');
            }elseif($user->role == 2){
            	return redirect()->route('login')->with('Success-sweet', 'Your password successfully changed.');
            }
          
        } else {
           Session::flash('Error-toastr', 'Something went wrong.');
           return redirect()->route('reset-password', Crypt::encrypt($user->id));
         }
         
    }
}
