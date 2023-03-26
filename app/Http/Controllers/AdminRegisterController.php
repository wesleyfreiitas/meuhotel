<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function __construct()
    {
        //O guest valida se o usuário tá ou n tá logado, sé for confidado ele é redirecionado par atela de login
        $this->middleware('guest:admin');
    }
    public function registro(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string|confirmed'
        ]);
        
        $admin = new Admin([
            'name'=> $request->name,
            'email' => $request->email,
            //Armazenei a senha no bcrypt que devolverá uma string
            'password' => bcrypt($request->password),
            //gerando o token que será usado na comunicação por email
            'token' => str_random(60)
        ]);
        $admin->save();
        
        //event(new EventNovoRegistro($admin));

        return view('auth.admin-login');
    }

    public function index(){
        return view('auth.admin-register');
    }
    
}
