<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $req){
        $user=new User();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=bcrypt($req->password);
        $user->save();

        $token = $user->createToken('Token Name')->accessToken;
        return $token;
    }
}
