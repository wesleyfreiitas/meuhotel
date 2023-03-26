<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Events\EventNovoRegistro;

class AutenticadorControlador extends Controller
{
    public function registro(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        
        $user = new User([
            'name'=> $request->name,
            'email' => $request->email,
            //Armazenei a senha no bcrypt que devolverá uma string
            'password' => bcrypt($request->password),
            //gerando o token que será usado na comunicação por email
            'token' => str_random(60)
        ]);
        $user->save();
        
        event(new EventNovoRegistro($user));

        return response()->json([
            'res'=>'Usuario criado com sucesso'
        ], 201);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credenciais = [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
        ];
        //A função attempt retorna um boolean true ou false
        if (!Auth::attempt($credenciais))
            return response()->json([
                //Mensagem enviada em caso de retorno falso da função attempt
                'res' => 'Acesso negado'
            ], 401);
        //Peguei o usuário de dentro do request
        $user = $request->user();
        //Criado token com a função create token e pra pegar a string do token foi usado a função
        //accessToken
        $token = $user->createToken('Token de acesso')->accessToken;
        //Retornando o token em um json
        return response()->json([
            'token' => $token
        ], 200);
    }
    public function logout(Request $request){
        //Peguei o usuário no request acessei o objeto token e revoguei
        $request->user()->token()->revoke();
        //Response em Json de usuário deslogado.
        return response()->json([
            'res' => 'Deslogado com sucesso'
        ]);
    }
    public function ativarregistro($id, $token) {
        $user = User::find($id);
        if ($user) {
            if ($user->token == $token) {
                $user->active = true;
                $user->token = '';
                $user->save();
                return view('registroativo');
            }
        }
        return view('registroerro');
    }
}
