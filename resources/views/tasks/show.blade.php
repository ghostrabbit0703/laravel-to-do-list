@extends('layout.app')

@section('title','Detalle de tarea')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>{{ $task->title }}</h3>
    </div>

    <div class="card-body">

        <p>
            <strong>Descripción:</strong><br>
            {{ $task->description }}
        </p>

        <p>
            <strong>Categoría:</strong>

            {{ $task->category->name }}
        </p>

        <p>

            <strong>Etiquetas:</strong><br>

            @forelse($task->tags as $tag)

                <span class="badge bg-primary">

                    {{ $tag->name }}

                </span>

            @empty

                <span class="text-muted">
                    Sin etiquetas
                </span>

            @endforelse

        </p>

        <p>

            <strong>Estado:</strong>

            @if($task->completed)

                <span class="badge bg-success">
                    Completada
                </span>

            @else

                <span class="badge bg-warning text-dark">
                    Pendiente
                </span>

            @endif

        </p>

    </div>

    <div class="card-footer">

        <a
            href="{{ route('tasks.edit',$task) }}"
            class="btn btn-warning"
        >
            Editar
        </a>

        <a
            href="{{ route('tasks.index') }}"
            class="btn btn-secondary"
        >
            Volver
        </a>

    </div>

</div>

@endsection
