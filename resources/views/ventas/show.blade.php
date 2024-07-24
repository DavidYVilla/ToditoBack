@extends('adminlte::page')

@section('title', 'Ventas | Nuevo')

@section('content_header')
    <h1>Ventas | Ver</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Venta: {{ $venta->id }} </div>
                    <div class="card-body">
                        @include('includes.alertas')
                        <div class="mt-2 justify-content-center">
                            <h3 class="mt-3 text-center"><b>Total: </b>{{ $venta->total_venta }}</h3>
                        </div>
                        <div class="mt-3">
                            <p><strong>Usuario: </strong> <br> {{ $venta->usuario->name }}</p>
                            <p><strong>Cliente: </strong> <br> {{ $venta->cliente->nombre }}</p>
                            <p><strong>Estado: </strong>
                                @if ($venta->estado == 1)
                                    <span class="badge badge-success">Vigente</span>
                                @else
                                    <span class="badge badge-danger">
                                        Anulado
                                    </span>
                                @endif

                            </p>
                            <p><strong>Fecha de venta:</strong>{{ $venta->fecha_venta }}</p>
                            <hr>



                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ url('/ventas') }}" class="btn btn-primary">Volver al Listado</a>
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
                                    @if ($venta->detalles->count() < 1)
                                        <tr>
                                            <td colspan="6">No hay productos para mostrar.</td>
                                        </tr>
                                    @else
                                        @foreach ($venta->detalles as $key => $item)
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
                                    <td><b>{{ $venta->total_venta }}</b></td>
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
