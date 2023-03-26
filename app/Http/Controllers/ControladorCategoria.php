<?php

namespace App\Http\Controllers;

use App\Categoria;

use App\Produto;

use Illuminate\Http\Request;

class ControladorCategoria extends Controller
{        //A ideia é usar esse controlador para logar como admin
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
    public function index()
    {
        $categoria = Categoria::all();
        return $categoria->toJson();
    }

    public function indexJSON()
    {
        return view('categorias');
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
        $categoria = new Categoria();
        $categoria->nome = $request->input('nome');
        $categoria->save();
        return json_encode($categoria);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        if (isset($categoria)){
            return json_encode($categoria);
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
        $categoria = Categoria::find($id);
        if (isset($categoria)){
            $categoria->nome = $request->input('nome');
            $categoria->save();
            return json_encode($categoria);
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
        $categoria = Categoria::find($id);
        if(isset($categoria)){
            $categoria->delete();
            return response('OK', 200);
        }
        return view('404');
    }
}
