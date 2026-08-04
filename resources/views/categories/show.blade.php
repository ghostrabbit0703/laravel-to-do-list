@extends('layout.app')

@section('title', 'Ver Categoría')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">

        <div class="card">
            <div class="card-header">
                <h3>Detalle de la Categoría</h3>
            </div>

            <div class="card-body">
                <p>
                    <strong>ID:</strong>
                    {{ $category->id }}
                </p>

                <p>
                    <strong>Nombre:</strong>
                    {{ $category->name }}
                </p>

                <p>
                    <strong>Creada:</strong>
                    {{ $category->created_at }}
                </p>

                <p>
                    <strong>Actualizada:</strong>
                    {{ $category->updated_at }}
                </p>
            </div>

            <div class="card-footer">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    Volver
                </a>

                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                    Editar
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
