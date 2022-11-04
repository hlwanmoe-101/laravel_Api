<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name'=>'required|min:3',
            'email'=>'unique:users,email|required',
            'password'=>'required|min:8',
            'password_confirmation'=>"required|same:password",
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return response()->json([
           "message"=>"ya pi"
        ],200);
    }
    public function login(Request $request){
        $credentials= $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(!Auth::attempt($credentials)){
            return response()->json([
               "message"=>"Attempt fail",
               "error"=>"Invalid credentials"
            ],422);
        }
        $token=Auth::user()->createToken("user_auth");
        return response()->json([
            "message"=>"Login Successful",
            "data"=>$token
        ],200);

    }
    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json([
            'message'=>'logout successful'
        ],200);
    }
}
