<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


/**
 * @group  User Authentication
 *
 * APIs for managing basic auth functionality
 */

class AuthController extends Controller
{
    

     /**
     * @header Authorization not required 
     * @bodyParam  name string required The Name of User Example: Test User.
     * @bodyParam  email string The Email of User Example: test@gmail.com.
     * @bodyParam  password string The Password of User Example: 123456.
   
    @response {
    "status": true,
    "message": "User successfully registered."
    "data": {
        "name": "test user",
        "email": "test@gmail.com",
        "updated_at": "2021-08-14T17:47:40.000000Z",
        "created_at": "2021-08-14T17:47:40.000000Z",
        "id": 2
    }
  }
     */

    public function register(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                "email"  =>  "required|email|unique:users",
                'password' => 'required|min:6',
            ]);
    
            if ($validator->fails()) {
                return response() -> json(["status"=>false,"message"=>$validator->errors()->first(),"data"=>'',],550);
            }

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            
            return response() -> json(["status"=>true,"message"=>'User successfully registered.',"data"=>$user,]);


        } catch(\Exception $e) {
            Log::error ( " :: EXCEPTION :: ".$e->getMessage()."\n".$e->getTraceAsString() );
            return Response()->Json(["status"=>false,"message"=> $e->getMessage(),],500);
        }
    }



     /**
     * @header Authorization not required 
     * @bodyParam  email string The Email of User Example: test@gmail.com.
     * @bodyParam  password string The Password of User Example: 123456.
   
    @response {
    "status": true,
    "message": "User successfully login.",
    "token": "1|bRoiqbdHHyTVEF60UbYoYVOSgfI3uOGKucEaOVhu",
    "data": {
        "id": 2,
        "name": "test user",
        "email": "test@gmail.com",
        "username": null,
        "email_verified_at": null,
        "role": 2,
        "status": 1,
        "device_token": null,
        "created_at": "2021-08-14T17:47:40.000000Z",
        "updated_at": "2021-08-14T17:47:40.000000Z",
        "deleted_at": null
    }
}
     */

    public function login(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [
                "email"  =>  "required|email",
                'password' => 'required|min:6',
            ]);
    
            if ($validator->fails()) {
                return response() -> json(["status"=>false,"message"=>$validator->errors()->first(),"data"=>'',],550);
            }


            // $user_info = array('email' =>$request->email, 'password'=>$request->password);
            // if ( auth()->attempt($user_info) ) {
            //     auth()->guard("siteUser")->attempt($user_info);
            //     $user = auth()->guard("siteUser")->user();
            //     $token =   $user->createToken('authApiToken')->plainTextToken;

            // }

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            $token =   $user->createToken('authApiToken')->plainTextToken;
            return response() -> json(["status"=>true,"message"=>'User successfully login.','token'=>$token,"data"=>$user,]);


        } catch(\Exception $e) {
            Log::error ( " :: EXCEPTION :: ".$e->getMessage()."\n".$e->getTraceAsString() );
            return Response()->Json(["status"=>false,"message"=> $e->getMessage(),],500);
        }
    }


     /**
      * @authenticated
    @response {
    "status": true,
    "message": "",
    "data": {
        "id": 2,
        "name": "test user",
        "email": "test@gmail.com",
        "username": null,
        "email_verified_at": null,
        "role": 2,
        "status": 1,
        "device_token": null,
        "created_at": "2021-08-14T17:47:40.000000Z",
        "updated_at": "2021-08-14T17:47:40.000000Z",
        "deleted_at": null
    }
}
* @response  401 {
     *   "message": "Unauthenticated."
     *}
     */

    public function profile(Request $request)
    {
        try{
            $user = Auth::user();
            return response() -> json(["status"=>true,"message"=>'',"data"=>$user,]);

        } catch(\Exception $e) {
            Log::error ( " :: EXCEPTION :: ".$e->getMessage()."\n".$e->getTraceAsString() );
            return Response()->Json(["status"=>false,"message"=> $e->getMessage(),],500);
        }
    }



    /**
    *@authenticated
    @response {
    "status": true,
    "message": "Logout successfully"
    "data": "",
    }
   * @response  401 {
     *   "message": "Unauthenticated."
     *}
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
        } catch(\Exception $e) {
            Log::error ( " :: EXCEPTION :: ".$e->getMessage()."\n".$e->getTraceAsString() );
            return Response()->Json(["status"=>false,"message"=> $e->getMessage(),],500);
        }
        return response() -> json(["status"=>true,"message"=>'Logout successfully',"data"=>""]);
    }



      /**
    @response 401{
    "success": false,
    "message": "Unauthenticated"
   }
     */
    public function unauthorised()
    {
      return response(['success'=> false, 'message'=>'Unauthenticated'], 401);
    }



}
