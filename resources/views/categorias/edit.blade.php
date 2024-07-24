@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-end d-flex">
                        <a href="{{ route('categorias.index') }}" class="btn btn-danger  ml-auto text-end">Volver al
                            Listado</a>
                    </div>
                    <form action="{{ route('categorias.update', ['id' => $categoria->id]) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group mb-5">
                            <label for="nombre">Nombre categoria</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}">
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="2">{{ $categoria->descripcion }}</textarea>
                        </div>
                        @error('descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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
