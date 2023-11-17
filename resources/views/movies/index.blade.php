@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Listado de Películas</h1>
        <a href="{{ route('movies.create') }}" class="btn btn-success mb-3">Añadir Nueva Película</a>

        <table class="table table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Año</th>
                <th>Género</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->year }}</td>
                    <td>{{ $movie->genre }}</td>
                    <td>
                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de querer eliminar esta película?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
