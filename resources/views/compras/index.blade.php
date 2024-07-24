@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h1>Compras | Lista</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col md-8">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <a href="{{ route('compras.create') }}" class="btn btn-success ml-auto">Nueva Compra</a>
                        </div>

                        <div class="table-responsive mt-3">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FECHA DE COMPRA</th>
                                        <th>USUARIO</th>
                                        <th>PROVEEDOR</th>
                                        <th>TOTAL</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->fecha_compra }}</td>
                                            <td>{{ $item->usuario->name }}</td>
                                            <td>{{ $item->proovedor->razon_social }}</td>
                                            <td>{{ $item->total_compra }}</td>
                                            <td>
                                                @if ($item->estado == true)
                                                    <span class="badge bg-success">Vigente</span>
                                                @else
                                                    <span class="badge bg-danger">Anulado</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('compras.show', ['id' => $item->id]) }}"
                                                    class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                {{-- @if ($item->estado == true)
                                                    <a href="{{ url('/compras/estado/' . $item->id) }}"
                                                        class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                                @else
                                                    <a href="{{ url('/compras/estado/' . $item->id) }}"
                                                        class="btn btn-success"><i class="fas fa-check"></i></a>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $compras->links('pagination::bootstrap-5') }}
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
