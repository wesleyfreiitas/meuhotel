<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hospede;

use App\Quarto;

use App\Comanda;

class ControleHospede extends Controller
{
            //A ideia é usar esse controlador para logar como admin
public function __construct()
{
    //esse admin após o auth eu estou informando que a autenticação é via o guard admin criado no config > auth
    $this->middleware('auth:admin');
}

    public function indexView()
    {
        return view('hospedes');
    }
    public function index()
    {
        $hosp = Hospede::all();
        return $hosp->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            //return view('novoHospede');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hosp = new Hospede();
        $hosp->nome = $request->input('nome');
        //$hosp->rg = $request->input('rg');
        $hosp->cpf = $request->input('cpf');
        $hosp->email = $request->input('email');
        //$hosp->nascimento = $request->input('nascimento');
        //$hosp->telefone = $request->input('telefone');
        $hosp->estado = $request->input('estado');
        $hosp->cidade = $request->input('cidade');
        $hosp->rua = $request->input('rua');
        $hosp->bairro = $request->input('bairro');
        $hosp->cep = $request->input('cep');
        //$hosp->complemento = $request->input('complemento');
        $hosp->save();
        return json_encode($hosp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hosp = Hospede::find($id);
        if (isset($hosp)){
            return json_encode($hosp);
        }
        return view('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hosp = Hospede::find($id);
        if (isset($hosp)){
            $hosp->nome = $request->input('nome');
            //$hosp->rg = $request->input('rg');
            $hosp->cpf = $request->input('cpf');
            $hosp->email = $request->input('email');
            //$hosp->nascimento = $request->input('nascimento');
            //$hosp->telefone = $request->input('telefone');
            $hosp->estado = $request->input('estado');
            $hosp->cidade = $request->input('cidade');
            $hosp->rua = $request->input('rua');
            $hosp->bairro = $request->input('bairro');
            $hosp->cep = $request->input('cep');
            //$hosp->complemento = $request->input('complemento');
            $hosp->save();
            return json_encode($hosp);
        }
        return view('404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hosp = Hospede::find($id);
        if(isset($hosp)){
            $hosp->delete();
            return response('OK', 200);
        }
        return view('404');
    }
}
