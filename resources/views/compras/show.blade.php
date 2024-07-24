@extends('adminlte::page')

@section('title', 'Compras | Nuevo')

@section('content_header')
    <h1>Compras | Ver</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Compra: {{ $compra->id }} </div>
                    <div class="card-body">
                        @include('includes.alertas')
                        <div class="mt-2 justify-content-center">
                            <h3 class="mt-3 text-center"><b>Total: </b>{{ $compra->total_compra }}</h3>
                        </div>
                        <div class="mt-3">
                            <p><strong>Usuario: </strong> <br> {{ $compra->usuario->name }}</p>
                            <p><strong>Proveedor: </strong> <br> {{ $compra->proovedor->nombre }}</p>
                            <p><strong>Estado: </strong>
                                @if ($compra->estado == 1)
                                    <span class="badge badge-success">Vigente</span>
                                @else
                                    <span class="badge badge-danger">
                                        Anulado
                                    </span>
                                @endif

                            </p>
                            <p><strong>Fecha de Compra:</strong>{{ $compra->fecha_compra }}</p>
                            <hr>



                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ url('/compras') }}" class="btn btn-primary">Volver al Listado</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-header">Detalles</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGEN</th>
                                        <th>NOMBRE</th>
                                        <th>CANTIDAD</th>
                                        <th>SUB TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($compra->detalles->count() < 1)
                                        <tr>
                                            <td colspan="6">No hay productos para mostrar.</td>
                                        </tr>
                                    @else
                                        @foreach ($compra->detalles as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <img src="{{ $item->producto->getImagenUrl() }}" height="40px"
                                                        alt="imagen">
                                                </td>
                                                <td>{{ $item->producto->nombre }}</td>
                                                <td>{{ $item->cantidad }}</td>
                                                <td>{{ $item->costo }}</td>

                                            </tr>
                                        @endforeach

                                    @endif
                                </tbody>
                                <tfoot>
                                    <td colspan="4"><b>Total</b></td>
                                    <td><b>{{ $compra->total_compra }}</b></td>
                                </tfoot>
                            </table>
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
