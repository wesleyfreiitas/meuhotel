<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comanda;
use App\Hospede;
use App\Quarto;

class ControleComanda extends Controller
{
    //A ideia é usar esse controlador para logar como admin
    public function __construct()
    {
        //esse admin após o auth eu estou informando que a autenticação é via o guard admin criado no config > auth
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {

        return view('reservas');
    }

    public function index()
    {
        $comanda = Comanda::with(['hospede','quarto'])->get();
        return $comanda->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comanda = new Comanda();
        $comanda->status = $request->input('status');
        $comanda->chegada = $request->input('chegada');
        $comanda->saida = $request->input('saida');
        $comanda->obs = $request->input('obs');
        $comanda->quarto_id = $request->input('quarto_id');
        $comanda->hospede_id = $request->input('hospede_id');
        //$comanda->crianca = $request->input('crianca');
        //$comanda->adulto = $request->input('adulto');
        $comanda->desconto = $request->input('desconto');
        $comanda->desconto = $request->input('acrescimo');
        $comanda->total_pagar = $request->input('total_pagar');
        $comanda->total_pago = $request->input('total_pago');
        $comanda->troco = $request->input('troco');
        $comanda->tipo_pg = $request->input('tipo_pg');
        $comanda->qtd_diaria = $request->input('qtd_diaria');
        $comanda->save();
        return json_encode($comanda);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comanda = Comanda::find($id);
        if (isset($comanda)){
            return json_encode($comanda);
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
        $comanda = Comanda::find($id);
        if (isset($comanda)) {
            $comanda->status = $request->input('status');
            $comanda->chegada = $request->input('chegada');
            $comanda->saida = $request->input('saida');
            $comanda->obs = $request->input('obs');
            $comanda->quarto_id = $request->input('quarto_id');
            $comanda->hospede_id = $request->input('hospede_id');
            $comanda->crianca = $request->input('crianca');
            $comanda->adulto = $request->input('adulto');
            $comanda->save();
            return json_encode($comanda);
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
        $comanda = Comanda::find($id);
        if(isset($comanda)){
            $comanda->delete();
            return response('OK', 200);
        }
        return view('404');
    }

}
