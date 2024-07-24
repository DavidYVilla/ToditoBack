@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Asignar un Rol</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control">{{ $user->name }}</p>
            <h2 class="h5">Listado de Roles</h2>
            <form action="{{ route('admin.users.update', $user) }}" method="post">
                @method('put')
                @csrf
                @foreach ($roles as $rol)
                    <div class="form-check">
                        <input class="form-check-input" name="roles[]" type="checkbox" value="{{ $rol->id }}"
                            {{ in_array($rol->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }} />
                        <label class="form-label fw-bold"> {{ $rol->name }} </label>
                    </div>


                    {{-- <label for="rol_{{ $rol->id }}">{{ $rol->id }}</label>
                    {{ $rol->name }} --}}
                @endforeach

                <button type="submit" class="btn btn-primary mt-2">Asignar</button>

            </form>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop
