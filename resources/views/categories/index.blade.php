@extends('layout.app')

@section('title', 'Lista de Categorias')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Lista de Tareas</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">+ Crear Tarea</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>

                            <td>
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta tarea?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay tareas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
