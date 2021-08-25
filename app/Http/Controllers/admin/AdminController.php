<?php

namespace App\Http\Controllers\admin;

use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SiteSetting;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{

  use AuthenticatesUsers;


  function index()
  {
    return view('admin.index');
  }



  protected function sendFailedLoginResponse(Request $request)
  {
    throw ValidationException::withMessages([
      $this->username() => [trans('auth.failed')],
    ]);
  }



  function createAdmin(Request $request)
  {
    $result = Admin::create([
      'name' => 'debkumar mayra',
      'email' => 'debkumar@gmail.com',
      'password' => Hash::make('123456'),
    ]);

    echo $result ? 'success' : 'fail';
  }


  function profile()
  {
    $user = request()->user();
    return view('admin.profile', compact('user'));
  }

  function updateProfile(Request $request)
  {

    $data = $request->validate([
      "first_name" => "sometimes|required|min:3|max:100",
      'email' => 'sometimes|nullable|required|unique:users,email',
      "mobile" => "sometimes|nullable|digits:10",
      "dob" => "sometimes|nullable|date|before_or_equal:" . now()->subYears(13)->format('Y-m-d'),
      "profile_photo" => "sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048",
      "old_password" => "sometimes|nullable|required",
      "new_password" => "sometimes|nullable|required|min:6",
      "confirm_password" => "sometimes|nullable|required|same:new_password",
    ], ['dob.before_or_equal' => 'You must be 13 years old or above.']);
    try {
      $user = Auth::guard('siteAdmin')->user();
      if (!empty($request->first_name)) $user->first_name = $request->first_name;
      if (!empty($request->last_name)) $user->last_name = $request->last_name;
      if (!empty($request->email)) $user->email = $request->email;
      if (!empty($request->mobile)) $user->mobile = $request->mobile;
      if (isset($request->old_password) && !empty($request->old_password)) {
        if (!(Hash::check($request->old_password, Auth::guard('siteAdmin')->user()->password))) {
          Session::flash('Error-toastr', 'Your old password does not matches');
          return redirect()->back();
        } elseif (!empty($request->new_password)) {
          $user->password = Hash::make($request->new_password);
        }
      }

      $user->save();
      $profile = UserProfile::where('user_id', $user->id)->first();
      $profile = $profile ?? new UserProfile;
      $profile->user_id = $user->id;

      if (!empty($request->dob)) $profile->dob = $request->dob;
      if (!empty($request->gender)) $profile->gender = $request->gender;
      if (!empty($request->address)) $profile->address = $request->address;
      if (!empty($request->about)) $profile->about = $request->about;

      if ($request->hasFile('profile_photo')) {
        $rand_val           = date('YMDHIS') . rand(11111, 99999);
        $image_file_name    = md5($rand_val);
        $file               = $request->file('profile_photo');
        $extension          = $request->file('profile_photo')->extension();
        $fileName           = $image_file_name . '.' . $extension;
        $destinationPath    = public_path() . '/uploads/users/';
        $file->move($destinationPath, $fileName);
        $profile->profile_photo = $fileName;
      }
      $profile->save();
      Session::flash('Success-toastr', 'Profile Successfully updated');
    } catch (\Exception $e) {
      Session::flash('Error-toastr', $e->getMessage());
    }
    return redirect()->back();
  }

  function settings(Request $request)
  {
    if ($request->isMethod('post')) {

      if ($request->hasFile('logo')) {
        // $rand_val           = date('YMDHIS').rand(11111,99999);
        // $image_file_name    = md5($rand_val);
        $file               = $request->file('logo');
        $extension          = $request->file('logo')->extension();
        $fileName           = 'logo.' . $extension;
        $destinationPath    = public_path() . '/common_img/';
        $file->move($destinationPath, $fileName);
        $logo = SiteSetting::firstOrNew(['key' => 'logo']);
        $logo->key = 'logo';
        $logo->value = $fileName;
        $logo->save();
      }
      $email = SiteSetting::firstOrNew(['key' => 'email']);
      $email->key = 'email';
      $email->value = $request->email;
      $email->save();

      $date_format = SiteSetting::firstOrNew(['key' => 'date_format']);
      $date_format->key = 'date_format';
      $date_format->value = strtoupper($request->date_format);
      $date_format->save();

      $per_page = SiteSetting::firstOrNew(['key' => 'per_page']);
      $per_page->key = 'per_page';
      $per_page->value = strtoupper($request->per_page);
      $per_page->save();

      return redirect()->back()->with('Success-toastr', 'Successfully updated');
    }
    return view('admin.settings');
  }
}
