@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Productos | Lista</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col md-8">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <a href="{{ route('productos.create') }}" class="btn btn-success ml-auto">Nuevo
                                Producto</a>
                        </div>

                        <div class="table-responsive mt-3">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMBRE</th>
                                        <th>IMAGEN</th>
                                        <th>DESCRIPCION</th>
                                        <th>STOCK</th>
                                        <th>PRECIO UNITARIO</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->nombre }}</td>
                                            <td class="text-center">
                                                <img src="{{ $item->getImagenUrl() }}" alt="" class="bordered"
                                                    height="40px">
                                            </td>
                                            <td>{{ $item->descripcion }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>{{ $item->precio }}</td>
                                            <td>
                                                @if ($item->estado == true)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                @can('productos.edit')
                                                    <a href="{{ route('productos.edit', ['id' => $item->id]) }}"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('productos.estado')
                                                    @if ($item->estado == true)
                                                        <a href="{{ url('/productos/estado/' . $item->id) }}"
                                                            class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                                    @else
                                                        <a href="{{ url('/productos/estado/' . $item->id) }}"
                                                            class="btn btn-success"><i class="fas fa-check"></i></a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $productos->links('pagination::bootstrap-5') }}
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
