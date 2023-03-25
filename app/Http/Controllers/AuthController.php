<?php

namespace App\Http\Controllers;

use App\Models\User ;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            "name" => "required|string" ,
            "email" => "required|string|unique:users,email", 
            "password" => "required|string|confirmed"
        ]) ;

        $user = User::create([
            "name" => $data["name"], 
            "email" => $data["email"], 
            "password" => bcrypt($data["name"]) , 
        ]) ;

        $token = $user->createToken("myToken")->plainTextToken ;

        $response = [
            "user" => $user , 
            "token" => $token
        ] ;

        return response($response, 201) ;
    }



    public function logIn(Request $req){
        $req->validate([
            "email" => "required|string|email", 
            "password" => "required|string"
        ]) ;
        $data = $req->only("email", "password") ;


        //check if user exist ;
        $user = User::where("email", $data["email"])->first() ;
        
        // return $user ;  && !Hash::check($data["password"], $user->password)
        if(!$user){
            return response([
                "message" => "bad creds"
            ], 401 ) ;
        }

        $token = $user->createToken("myToken")->plainTextToken ;

        $response = [
            "user" => $user , 
            "token" => $token
        ] ;

        return response()->json($response, 201);
    }



    public function logOut(Request $user){
        auth()->user()->tokens()->delete() ;

        return [
            "message" => "loged out" 
        ] ;  
    }

}
