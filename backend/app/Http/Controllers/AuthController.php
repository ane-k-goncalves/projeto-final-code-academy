<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAv
        // YXBpL2xvZ2luIiwiaWF0IjoxNzIwMDI5MjU4LCJleHAiOjE3MjAwMzI4NTgsIm5iZiI6MTcyMDAyOTI1OCwianRp
        // IjoidXM1NTFyanBKVENzY1RtTyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4Nz
        // JkYjdhNTk3NmY3In0.bolTtl_5YyqdvgSNwRznT_HuPEuGR8TtumNsYnjoD9E"
    }

    public function logout(){
       auth('api')->logout();
       return response()->json(['msg' =>'Logout foi realizado com sucesso!']); 
    }

    public function refresh(){
        $token = auth('api')->refresh();
        return response()->json(['token' =>$token]);
    }

    public function me(){
        return response()->json((auth()->user()));
    }
}
