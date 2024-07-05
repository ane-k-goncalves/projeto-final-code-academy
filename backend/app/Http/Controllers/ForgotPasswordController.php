<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => 'Email enviado com link para redefinição de senha!'])
                    : response()->json(['message' => 'Falha ao enviar email de redefinição!'], 500);
    }

  
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'token', 'password', 'password_confirmation'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? response()->json(['message' => 'Senha redefinida com sucesso!'])
                    : response()->json(['message' => 'Falha ao redefinir a senha!'], 500);
    }


}
