@extends('layout.app')

@section('title', 'Lista de Tareas')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Lista de Tareas</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">+ Crear Tarea</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Etiquetas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            {{-- <td>{{ $task->title }}</td> --}}
                            <td>
                                <div class="task-title" title="{{ $task->title }}">
                                    {{ $task->title }}
                                </div>
                            </td>
                            <td>
                                <div class="task-description" title="{{ $task->description }}">
                                    {{ $task->description }}
                                </div>
                            </td>
                            <td>
                                <div class="task-category" title="{{ $task->category->name ?? 'Sin categoría' }}">
                                    {{ $task->category->name ?? 'Sin categoría' }}
                                </div>
                            </td>

                           <td>
                                <div class="task-tags">
                                    @forelse($task->tags as $tag)
                                        @if($loop->index < 3)
                                            <span class="badge bg-primary">
                                                {{ $tag->name }}
                                            </span>
                                        @endif
                                    @empty
                                        <span class="text-muted">
                                            Sin etiquetas
                                        </span>
                                    @endforelse
                                    @if($task->tags->count() > 3)
                                        <span class="badge bg-secondary">
                                            +{{ $task->tags->count() - 3 }}
                                        </span>
                                    @endif

                                </div>
                            </td>
                            <td>
                                <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    @if($task->completed)
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Completada
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            Pendiente
                                        </button>
                                    @endif

                                </form>
                            </td>
                            <td>
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline">
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

