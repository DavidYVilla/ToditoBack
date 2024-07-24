<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes= Clientes::orderBy('id', 'DESC')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required|string',
            'direccion'=>'required|string',
            'telefono'=>'required|string',
            'email'=>'required|email',
        ]);
        $clientes=new Clientes();
        $clientes->nombre=$request->nombre;
        $clientes->apellido=$request->apellido;
        $clientes->direccion=$request->direccion;
        $clientes->telefono=$request->telefono;
        $clientes->email=$request->email;
        $clientes->estado=true;
        if($clientes->save()){
            return redirect('/clientes')->with('success', 'Cliente creado exitosamente');
        }else{
            return back()->with('error', 'El registro Cliente no fue creado');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clientes=Clientes::find($id);
        return view('clientes.edit', compact('clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required|string',
            'direccion'=>'required|string',
            'telefono'=>'required|string',
            'email'=>'required|email',
        ]);
        $clientes=Clientes::find($id);
        $clientes->nombre=$request->nombre;
        $clientes->apellido=$request->apellido;
        $clientes->direccion=$request->direccion;
        $clientes->telefono=$request->telefono;
        $clientes->email=$request->email;
        if($clientes->save()){
            return redirect('/clientes')->with('success', 'Cliente modificado exitosamente');
        }else{
            return back()->with('error', 'El registro Cliente no fue modificado');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
    public function estado($id)
    {
        $cliente= Clientes::find($id);
        $cliente->estado= !$cliente->estado;
        if($cliente->save()){
            return back()->with('success', 'Estado actualizado exitosamente');
        }else{
            return back()->with('error', 'El estado no fue actualizado');
        }
    }
}
