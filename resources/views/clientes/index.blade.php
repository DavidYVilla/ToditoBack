@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes | Lista</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col md-8">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <a href="{{ route('clientes.create') }}" class="btn btn-success ml-auto">Nuevo
                                Cliente</a>
                        </div>

                        <div class="table-responsive mt-3">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMBRE</th>

                                        <th>DIRECCION</th>
                                        <th>TELEFONO</th>
                                        <th>E-MAIL</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->nombre }} {{ $item->apellido }}</td>

                                            <td>{{ $item->direccion }}</td>
                                            <td>{{ $item->telefono }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->estado == true)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                @can('clientes.edit')
                                                    <a href="{{ route('clientes.edit', ['id' => $item->id]) }}"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('clientes.estado')
                                                    @if ($item->estado == true)
                                                        <a href="{{ url('/clientes/estado/' . $item->id) }}"
                                                            class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                                    @else
                                                        <a href="{{ url('/clientes/estado/' . $item->id) }}"
                                                            class="btn btn-success"><i class="fas fa-check"></i></a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $clientes->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
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
