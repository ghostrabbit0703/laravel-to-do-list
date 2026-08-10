@extends('layout.app')

@section('title', 'Lista de Categorias')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Lista de Categorías</h5>
            <a href="{{ route('categories.create') }}"
            class="btn btn-primary">
                + Crear Categoría
            </a>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div >
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)

                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <div class="task-title" title="{{ $category->name }}">
                                        {{ $category->name }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('categories.show', $category) }}"
                                    class="btn btn-sm btn-info">
                                        Ver
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}"
                                    class="btn btn-sm btn-warning">
                                        Editar
                                    </a>
                                    <form
                                        action="{{ route('categories.destroy', $category) }}"
                                        method="POST"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Eliminar esta categoría?')"
                                        >
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    No hay categorías registradas.
                                </td>
                            </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <small class="text-muted">
                    Mostrando {{ $categories->firstItem() ?? 0 }} -
                    {{ $categories->lastItem() ?? 0 }} de
                    {{ $categories->total() }} categorías
                </small>
                <div>
                    {{ $categories->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>

    </div>
@endsection
