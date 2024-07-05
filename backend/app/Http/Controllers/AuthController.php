<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request){
        
        $credenciais = $request->all(['email','password']);

        $token = auth('api')->attempt($credenciais);

        if($token){
            return response()->json(['token'=>$token]);
        }else{
            return response()->json(['erro'=>'Usuário ou senha inváldo!'],403);
        }

    }

    public function logout(){
       auth('api')->logout();
       return response()->json(['msg' =>'Logout foi realizado com sucesso!']); 
    }

    public function refresh(){
        $token = JWTAuth::refresh(JWTAuth::getToken());
        return response()->json(['token' => $token]);
    }

    public function me(){
        return response()->json((auth()->user()));
    }
}
