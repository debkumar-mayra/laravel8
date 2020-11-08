<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){ 
       return response()->json(['error'=>'Unauthorised'], 401); 
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    }
    
}
