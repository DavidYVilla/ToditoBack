@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>Proveedores | Nuevo</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <div class="text-end d-flex">
                        <a href="{{ route('proovedor.index') }}" class="btn btn-danger  ml-auto text-end">Volver al
                            Listado</a>
                    </div>
                    <form action="{{ route('proovedor.store') }}" method="POST">
                        @csrf <div class="container-fluid">
                            @include('includes.alertas')
                            <div class="row justify-content-center">

                                <div class="card-body">

                                    <div class="input-group mb-3">


                                        <span class="input-group-text">Nombre: </span>
                                        <input type="text" name="nombre" value="{{ old('nombre') }}"placeholder="nombre"
                                            aria-label="nombre" class="form-control">
                                        @error('nombre')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <span class="input-group-text">Apellido: </span>
                                        <input type="text" name="apellido"
                                            value="{{ old('apellido') }}"placeholder="apellido" aria-label="apellido"
                                            class="form-control">
                                        @error('apellido')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <div class="input-group mb-3">

                                        <span class="input-group-text">@ </span>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email"
                                            aria-label="email" class="form-control">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Telefono </span>
                                        <input type="text" name="telefono" value="{{ old('telefono') }}"
                                            placeholder="telefono" aria-label="telefono" class="form-control">

                                        @error('telefono')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <span class="input-group-text">NIT</span>
                                        <input type="text" name="nit" value="{{ old('nit') }}" placeholder="nit"
                                            aria-label="nit" class="form-control">
                                        @error('nit')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Razon social</span>
                                        <input type="text" name="razon_social" value="{{ old('razon_social') }}"
                                            placeholder="razon_social" aria-label="razon_social" class="form-control">
                                        @error('razon_social')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Registrar</button>
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
