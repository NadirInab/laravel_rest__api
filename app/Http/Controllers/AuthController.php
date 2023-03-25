<?php

namespace App\Http\Controllers;

use App\Models\User ;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash ;



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

    public function logOut(Request $request){
        auth()->user()->tokens()->delete() ;

        return [
            "message" => "loged out" 
        ] ;  
    }

}
