<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use http\Cookie;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create(
            $request->only('username','email','device')
            +[
                'password'=>\Hash::make($request->input('password')),
                'is_user'=>1
            ]
        );
        return response($user,Response::HTTP_CREATED);
    }

    public function login(Request $request){
        if (!\Auth::attempt($request->only('email','password'))){
            return \response([
                'error'=>'Invalid credentials'
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user = \Auth::user();
        $jwt = $user->createToken('token')->plainTextToken;
        $user['token'] = $jwt;
        $cookie = cookie('jwt', $jwt, time()+60*60*24*30);
        //return \response('',Response::HTTP_CREATED);
        return \response([
            'name'=>$user->username,
            'email'=>$user->email,
            'message'=>'success',
            'token'=>$jwt
        ],Response::HTTP_CREATED)->withCookie($cookie);
    }

    public function logout(){
        $cookie = \Cookie::forget('jwt');

        return \response(['status'=>true,"message"=>"Logout successful"],Response::HTTP_ACCEPTED)->withCookie($cookie);
    }

    public function profile(){
        $user = \Auth::user();
        return \response($user);
    }
}
