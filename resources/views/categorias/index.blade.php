@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col md-4">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <a href="{{ route('categorias.create') }}" class="btn btn-success ml-auto">Nueva
                                categoria</a>
                        </div>

                        <div class="table-responsive mt-3">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMBRE</th>
                                        <th>DESCRIPCION</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->nombre }}</td>
                                            <td>{{ $item->descripcion }}</td>
                                            <td>
                                                @if ($item->estado == true)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                @can('categorias.edit')
                                                    <a href="{{ route('categorias.edit', ['id' => $item->id]) }}"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('categorias.estado')
                                                    @if ($item->estado == true)
                                                        <a href="{{ url('/categorias/estado/' . $item->id) }}"
                                                            class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                                    @else
                                                        <a href="{{ url('/categorias/estado/' . $item->id) }}"
                                                            class="btn btn-success"><i class="fas fa-check"></i></a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categorias->links('pagination::bootstrap-5') }}
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
