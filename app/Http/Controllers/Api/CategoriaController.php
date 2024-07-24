<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias= categoria::orderBy('id', 'DESC')->paginate(10);
        return response()->json([
            'mensaje' => 'CATEGORIAS LISTADAS',
            'datos' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'nombre'=>'required',
            'descripcion'=>'nullable|string|max:200',
        ]);
        $categoria=new Categoria();
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->descripcion;
        if($categoria->save()){
           return response()->json([
               'mensaje' => 'CATEGORIA CREADA EXITOSAMENTE',
               'datos' => $categoria,
           ]);
        }else{
           return response()->json([
            'mensaje'=>'LA CATEGORIA NO PUDO SER CREADA',
           ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = categoria::find($id);
        return response()->json([
            'mensaje' => 'CATEGORIA ENCONTRADA',
            'datos' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
