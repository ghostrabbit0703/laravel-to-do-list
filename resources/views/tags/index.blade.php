@extends('layout.app')

@section('title', 'Lista de Etiquetas')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Lista de Etiquetas</h5>
            <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sm">+ Crear Etiqueta</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>
                                    <div class="task-title" title="{{ $tag->name }}">
                                        {{ $tag->name }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('tags.show', $tag) }}" class="btn btn-sm btn-info">Ver</a>
                                    <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta etiqueta?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    No hay etiquetas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <small class="text-muted">
                    Mostrando {{ $tags->firstItem() ?? 0 }} -
                    {{ $tags->lastItem() ?? 0 }} de
                    {{ $tags->total() }} etiquetas
                </small>
                <div>
                    {{ $tags->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
