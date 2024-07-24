<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos= Productos::with('categoria')->orderBy('id', 'DESC')->paginate(10);
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::where('estado', true)->get();
        $productos = Productos::where('estado', true)->get();

        return view('productos.create', compact('categorias', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
        'nombre' => 'required|unique:productos',
        'imagen' => 'nullable|image|mimes:png,jpg,jpeg',
        'categoria_id'=> 'required',
        'descripcion' => 'nullable|max:200',
        'stock' => 'required|numeric|min:0',
        'precio' => 'required|numeric|min:0',
       ]);
       if ($request->file('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('producto_').'.png';
            $imagen->move(public_path().'/imagenes/productos/',$nombreImagen);
       } else{
        $nombreImagen = 'default.png';
       }
       $productos = new Productos();

       $productos->nombre = $request->nombre;
       $productos->imagen = $nombreImagen;
       $productos->descripcion = $request->descripcion;
       $productos->stock = $request->stock;
       $productos->precio = $request->precio;
       $productos->categoria_id = $request->categoria_id;
       $productos->estado = true;

       if ($productos->save()) {
            return redirect('/productos')->with('success','Registro de Producto agregado correctamente!');
       } else {
            return back()->with('error','El registro no fue realizado!');
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
        $categorias = Categoria::where('estado', true)->get();

        $producto=Productos::find($id);
        return view('productos.edit', compact('producto','categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd('update');
        $request->validate([
        'nombre' => 'required',
        'imagen' => 'nullable|image|mimes:png,jpg,jpeg',
        'categoria_id'=> 'required',
        'descripcion' => 'nullable|max:200',
        'stock' => 'required|numeric|min:0',
        'precio' => 'required|numeric|min:1',
       ]);
       $producto= Productos::find($id);
       //dd($producto);
       if($request->file('imagen')){
            // eliminar la imagen anterior
            if($producto->imagen != 'default.png'){
                if(file_exists(public_path().'/imagenes/productos/'.$producto->imagen)){
                    unlink(public_path().'/imagenes/productos/'.$producto->imagen);
                }
            }

            $imagen = $request->file('imagen');
            $nombreImagen = uniqid('producto_') . '.png';
            if(!is_dir(public_path('/imagenes/productos/'))){
                File::makeDirectory(public_path().'/imagenes/productos/',0777,true);
            }
            $subido = $imagen->move(public_path().'/imagenes/productos/', $nombreImagen);

            $producto->imagen = $nombreImagen;
        }


       $producto->nombre = $request->nombre;
       $producto->imagen = $nombreImagen;
       $producto->descripcion = $request->descripcion;
       $producto->stock = $request->stock;
       $producto->precio = $request->precio;
       $producto->categoria_id = $request->categoria_id;
       $producto->estado = true;

       if ($producto->save()) {
            return redirect('/productos')->with('success','Registro de Producto modificado correctamente!');
       } else {
            return back()->with('error','El registro no fue modificado!');
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $productos)
    {
        //
    }
    public function estado($id)
    {
        $producto= Productos::find($id);
        $producto->estado= !$producto->estado;
        if($producto->save()){
            return back()->with('success', 'Estado actualizado exitosamente');
        }else{
            return back()->with('error', 'El estado no fue actualizado');
        }
    }
}
