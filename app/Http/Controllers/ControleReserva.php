<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reserva;

class ControleReserva extends Controller
{
//A ideia é usar esse controlador para logar como admin
public function __construct()
{
    //esse admin após o auth eu estou informando que a autenticação é via o guard admin criado no config > auth
    $this->middleware('auth:admin');
}
    public function indexView()
    {
        return view('reservas');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reserva = Reserva::with(['quarto','hospede'])->get();

        //$reserva = Reserva::all();
        return $reserva->toJson();
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
        $reserva = new Reserva();
        $reserva->status = $request->input('status');
        $reserva->chegada = $request->input('chegada');
        $reserva->saida = $request->input('saida');
        $reserva->obs = $request->input('obs');
        $reserva->quarto_id = $request->input('quarto_id');
        $reserva->hospede_id = $request->input('nome');
        $reserva->crianca = $request->input('crianca');
        $reserva->adulto = $request->input('adulto');
        $reserva->save();
        return json_encode($reserva);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $reserva = Reserva::find($id);
        if (isset($reserva)){
            return json_encode($reserva);
        }
        return response('reserva não encontrado', 404);


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
        $reserva = Reserva::find($id);
        if (isset($reserva)){
            $reserva->status = $request->input('status');
            $reserva->chegada = $request->input('chegada');
            $reserva->saida = $request->input('saida');
            $reserva->obs = $request->input('obs');
            $reserva->quarto_id = $request->input('quarto_id');
            $reserva->hospede_id = $request->input('hospede_id');
            $reserva->crianca = $request->input('crianca');
            $reserva->adulto = $request->input('adulto');
            $reserva->save();
            return json_encode($reserva);
        }
        return response('reserva não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reserva = Reserva::find($id);
        if(isset($reserva)){
            $reserva->delete();
            return response('OK', 200);
        }
        return response('reserva não encontrado', 404);
    }
}
