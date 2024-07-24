@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>Proveedores | Lista</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col md-8">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <a href="{{ route('proovedor.create') }}" class="btn btn-success ml-auto">Nuevo
                                Proveedor</a>
                        </div>

                        <div class="table-responsive mt-3">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMBRE</th>
                                        <th>RAZON SOCIAL</th>
                                        <th>NIT</th>
                                        <th>TELEFONO</th>
                                        <th>E-MAIL</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proovedor as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->nombre }} {{ $item->apellido }}</td>

                                            <td>{{ $item->razon_social }}</td>
                                            <td>{{ $item->nit }}</td>
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
                                                @can('proovedor.edit')
                                                    <a href="{{ route('proovedor.edit', ['id' => $item->id]) }}"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('proovedor.estado')
                                                    @if ($item->estado == true)
                                                        <a href="{{ url('/proovedor/estado/' . $item->id) }}"
                                                            class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                                    @else
                                                        <a href="{{ url('/proovedor/estado/' . $item->id) }}"
                                                            class="btn btn-success"><i class="fas fa-check"></i></a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $proovedor->links('pagination::bootstrap-5') }}
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
