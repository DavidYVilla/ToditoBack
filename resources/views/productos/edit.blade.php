@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Productos | Editar</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-end d-flex">
                        <a href="{{ route('productos.index') }}" class="btn btn-danger  ml-auto text-end">Volver al
                            Listado</a>
                    </div>
                    <form action="{{ route('productos.update', ['id' => $producto->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="container-fluid">
                            @include('includes.alertas')
                            <div class="row justify-content-center">

                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ $producto->getImagenUrl() }}" alt="" height="60px">
                                    </div>

                                    <div class="form-group">
                                        <label for="imagen">Imagen</label>
                                        <input type="file" name="imagen" class="form-control">
                                        @error('imagen')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">


                                        <span class="input-group-text">Nombre: </span>
                                        <input type="text" name="nombre" value="{{ $producto->nombre }}"
                                            class="form-control">
                                        @error('nombre')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror


                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Categoria: </span>
                                        <select name="categoria_id" id="categoria_id" class="form-control">
                                            <option value="">Seleccione...</option>
                                            @foreach ($categorias as $cate)
                                                <option value="{{ $cate->id }}"
                                                    @if ($cate->id == $producto->categoria_id) selected @endif>
                                                    {{ $cate->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categoria_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">

                                        <span class="input-group-text">Descripcion: </span>
                                        <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="2">{{ $producto->descripcion }}</textarea>
                                        @error('descripcion')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Bs: </span>
                                        <input type="number" name="precio" value="{{ $producto->precio }}"
                                            class="form-control">

                                        @error('precio')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <span class="input-group-text">Unid. </span>
                                        <input type="number" name="stock" value="{{ $producto->stock }}"
                                            placeholder="stock" aria-label="stock" class="form-control">
                                        @error('stock')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Modificar</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
