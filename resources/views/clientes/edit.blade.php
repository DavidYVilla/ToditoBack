@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes | Editar</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-end d-flex">
                        <a href="{{ route('clientes.index') }}" class="btn btn-danger  ml-auto text-end">Volver al
                            Listado</a>
                    </div>
                    <form action="{{ route('clientes.update', ['id' => $clientes->id]) }}" method="post">
                        @method('put')
                        @csrf <div class="container-fluid">
                            @include('includes.alertas')
                            <div class="row justify-content-center">

                                <div class="card-body">

                                    <div class="input-group mb-3">


                                        <span class="input-group-text">Nombre: </span>
                                        <input type="text" name="nombre"
                                            value="{{ $clientes->nombre }}"placeholder="nombre" aria-label="nombre"
                                            class="form-control">
                                        @error('nombre')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <span class="input-group-text">Apellido: </span>
                                        <input type="text" name="apellido"
                                            value="{{ $clientes->apellido }}"placeholder="apellido" aria-label="apellido"
                                            class="form-control">
                                        @error('apellido')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <div class="input-group mb-3">

                                        <span class="input-group-text">Direccion: </span>
                                        <textarea class="form-control"placeholder="Descripción" name="direccion" id="direccion" cols="30" rows="1">{{ $clientes->direccion }}</textarea>
                                        @error('direccion')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Telefono </span>
                                        <input type="text" name="telefono" value="{{ $clientes->telefono }}"
                                            placeholder="telefono" aria-label="telefono" class="form-control">

                                        @error('telefono')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <span class="input-group-text">@ </span>
                                        <input type="text" name="email" value="{{ $clientes->email }}"
                                            placeholder="email" aria-label="email" class="form-control">
                                        @error('email')
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
