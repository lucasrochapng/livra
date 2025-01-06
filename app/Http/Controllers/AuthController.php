<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsuarioModel;

class AuthController extends Controller
{
    
    // Exibir o formulário de login
    public function showLoginForm(){
        return view('auth.login');
    }

    // Processar o login
    public function login(Request $request){
        //Validar os dados
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenta autenticar o usuário
        if(Auth::attempt(['email' => $credenciais['email'], 'password' => $credenciais['password']])) {
            // Login bem-sucedido
            return redirect()->intended('/home');
        }

        // Retorna erro se falhar
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    // Processar o logout
    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success', 'Você foi desconectado!');
    }

}
