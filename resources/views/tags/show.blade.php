@extends('layout.app')

@section('title', 'Ver Etiqueta')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">

        <div class="card">
            <div class="card-header">
                <h3>Detalle de la Etiqueta</h3>
            </div>

            <div class="card-body">
                <p>
                    <strong>ID:</strong>
                    {{ $tag->id }}
                </p>

                <p>
                    <strong>Nombre:</strong>
                    {{ $tag->name }}
                </p>

                <p>
                    <strong>Creada:</strong>
                    {{ $tag->created_at }}
                </p>

                <p>
                    <strong>Actualizada:</strong>
                    {{ $tag->updated_at }}
                </p>
            </div>

            <div class="card-footer">
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                    Volver
                </a>

                <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning">
                    Editar
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
