<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias= Categoria::orderBy('id', 'DESC')->paginate(10);
        return view('Categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'nullable|string|max:200',
        ]);
        $categoria=new Categoria();
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->descripcion;
        if($categoria->save()){
            return redirect('/categorias')->with('success', 'Categoría creada exitosamente');
        }else{
            return back()->with('error', 'La categoría no fue creada');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria=Categoria::find($id);
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'nullable|string|max:200',
        ]);
        $categoria=Categoria::find($id);
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->descripcion;
        if($categoria->save()){
            return redirect('/categorias')->with('success', 'Categoría modificada exitosamente');
        }else{
            return back()->with('error', 'La categoría no fue modificada');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
    public function estado($id)
    {
        $categoria= Categoria::find($id);
        $categoria->estado= !$categoria->estado;
        if($categoria->save()){
            return back()->with('success', 'Estado actualizado exitosamente');
        }else{
            return back()->with('error', 'El estado no fue actualizado');
        }
    }
}
