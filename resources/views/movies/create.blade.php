@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Crea una nueva Película</h1>
        <form action="{{ $action }}" method="POST">
            @csrf {{-- Protección CSRF --}}
            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Campo Título --}}
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $movie->title }}" required>
            </div>

            {{-- Campo Año --}}
            <div class="form-group">
                <label for="year">Año</label>
                <input type="number" class="form-control" id="year" name="year" value="{{ $movie->year }}" required>
            </div>

            {{-- Campo Género --}}
            <div class="form-group">
                <label for="genre">Género</label>
                <input type="text" class="form-control" id="genre" name="genre" value="{{ $movie->genre }}" required>
            </div>

            {{-- Botón para Guardar --}}
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancelar</a> {{-- Asume una ruta para volver al listado --}}
        </form>
    </div>
@endsection
