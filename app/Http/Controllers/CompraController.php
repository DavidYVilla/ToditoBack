<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Productos;
use App\Models\Proovedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras=Compra::with('proovedor')
                            ->with('usuario')
                            ->orderBy('id','DESC')->paginate(10);

       // dd($compras);
        return view('compras.index',compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $proovedores=Proovedor::orderBy('id', 'desc')->paginate(10);
        // $productos=Productos::orderby('id', 'desc')->paginate(10);

        return view('compras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $compra=Compra::with('usuario','proovedor')->findOrFail($id);

        return view('compras.show',compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
