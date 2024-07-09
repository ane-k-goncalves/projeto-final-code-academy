<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        // Localize o usuário pelo ID fornecido
        $user = User::findOrFail($id);

        // Verifique se o hash na URL é válido
        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            return response()->json(['message' => 'Link de verificação inválido'], 403);
        }

        // Verifique o e-mail do usuário
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        //return response()->json(['message' => 'E-mail verificado']);
        return redirect('/')->with('message', 'E-mail verificado com sucesso. Faça login para continuar.');
    }

   
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 400);
        }
    
    
        return response()->json(['message' => 'Verification link sent']);
    }
    
}
