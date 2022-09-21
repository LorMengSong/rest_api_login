<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required",
            "c_password"=>"required|same:password"
        ]);
        if($validator->fails()){
            return response()->json([
                "Message"=>"Validation is fails",
                "error"=>$validator->errors()
            ],422);
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return response()->json([
            "Message"=>"Register Success...!",
            "Data"=>$user
        ],200);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            "email"=>"required|email",
            "password"=>"required"
        ]);
        if($validator->fails()){
            return  response()->json([
                "Message"=>"Validation is fails",
                "errors"=>$validator->errors()
            ],422);
        }
        $creditials = request(['email','password']);
        if(!Auth::attempt($creditials)){
            return  response()->json([
                "Message"=>"Unathorized",
            ],500);
        }
        $user = User::where("email",$request->email)->first();
        if($user){
                $token = $user->createToken('API Token')->accessToken;
                return  response()->json([
                    "Message"=>"Login Successfully",
                    "data"=>$user,
                    "access_token"=>"Bearer ".$token,
                    "refresh_token"=>$token,
                ],422);
        }else{
            return  response()->json([
                "Message"=>"Invalid Username Or Password",
            ],422);
        }
    }
    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            "status"=>"Logout Success...!"
        ],200);
    }
}
