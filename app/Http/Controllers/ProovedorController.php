<?php

namespace App\Http\Controllers;

use App\Models\Proovedor;
use Illuminate\Http\Request;

class ProovedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proovedor= Proovedor::orderBy('id', 'DESC')->paginate(10);
        return view('proovedor.index', compact('proovedor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proovedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required| string',
            'apellido'=>'required|string',
            'telefono'=>'required|string',
            'email'=>'required|email',
            'razon_social'=>'required|string',
            'nit'=>'required|integer'
        ]);
        $proovedor=new Proovedor();
        $proovedor->nombre=$request->nombre;
        $proovedor->apellido=$request->apellido;
        $proovedor->telefono=$request->telefono;
        $proovedor->email=$request->email;
        $proovedor->razon_social=$request->razon_social;
        $proovedor->nit=$request->nit;
        $proovedor->estado=true;
        if($proovedor->save()){
            return redirect('/proovedor')->with('success', 'Proveedor creado exitosamente');
        }else{
            return back()->with('error', 'El registro Proveedor no fue creado');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proovedor=Proovedor::find($id);
        return view('proovedor.edit', compact('proovedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'nombre'=>'required| string',
            'apellido'=>'required|string',
            'telefono'=>'required|string',
            'email'=>'required|email',
            'razon_social'=>'required|string',
            'nit'=>'required|integer'
        ]);
        $proovedor=Proovedor::find($id);
        $proovedor->nombre=$request->nombre;
        $proovedor->apellido=$request->apellido;
        $proovedor->telefono=$request->telefono;
        $proovedor->email=$request->email;
        $proovedor->razon_social=$request->razon_social;
        $proovedor->nit=$request->nit;
        if($proovedor->save()){
            return redirect('/proovedor')->with('success', 'Proveedor modificado exitosamente');
        }else{
            return back()->with('error', 'El registro Proveedor no fue modificado');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proovedor $proovedor)
    {
        //
    }
    public function estado($id)
    {
        $proovedor= Proovedor::find($id);
        $proovedor->estado= !$proovedor->estado;
        if($proovedor->save()){
            return back()->with('success', 'Estado actualizado exitosamente');
        }else{
            return back()->with('error', 'El estado no fue actualizado');
        }
    }
}
