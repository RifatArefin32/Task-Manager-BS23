<?php

namespace App\Http\Controllers; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request; 

class UserController extends Controller
{

    public function me(){ 
        return auth()->user();
    }
    
    public function register(Request $request){
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);


        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isAdmin' => $request->isAdmin ? $request->isAdmin : false,
        ]);

       
        
        $token = Str::random(60);
        $user->remember_token = $token;
        $user->save();

        return response([
            "user"=>$user,
            "message"=>"User Created",
            "success"=>true,
        ],201);
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required',
        ]);

        $user = User::where("username", $request->username)->first();
        if(!$user){
            return response([
                "message"=>"You must Register",
            ],404);
        }


        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                "message"=>"The provided credentials are incorrect"
            ],401);
        }

        $token = $user->createToken($request->username)->plainTextToken;

        return response([
            "user"=>$user,
            "message"=>"Login successful",
            "success"=>true,
            "token"=>$token
        ],200);
    }


    public function logout(){
        auth()->user()->tokens()->delete();
        return response([
            "message"=>"Successfully logged out"
        ],200);
    }

}
