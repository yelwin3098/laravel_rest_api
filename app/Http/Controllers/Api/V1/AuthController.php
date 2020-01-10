<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Auth;

class AuthController extends Controller
{
    public function register(Request $req){
        $user=new User();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=bcrypt($req->password);
        $user->save();

        $token = $user->createToken('Token Name')->accessToken;
        return response()->json([
        	'result'=>1,
        	'message'=>'success',
        	'token'=>$token
        ]);
    }
    public function login(Request $req){
    	$data=$req->only('email','password');

    	if(Auth::attempt($data)){
    		$user=Auth::user();
    		$token = $user->createToken('Token Name')->accessToken;
           
            return response()->json([
        	'result'=>1,
        	'message'=>'success',
        	'token'=>$token
        ]);
    	}else{
    		return response()->json([
        	'result'=>0,
        	'message'=>'fail',
        ]);
    	}  
    }

    public function profile(){
    	$user=Auth::user();
    	$data=new UserResource($user);
    	// $data=UserResource::collection($users); to array
    	 return response()->json([
        	'result'=>1,
        	'message'=>'Login success',
        	'data'=>$data
        ]);
    }
    public function logout(){
    	Auth::user()->token()->revoke();
    	return response()->json([
        	'result'=>1,
        	'message'=>'Logout success',
        ]);
    }
}
