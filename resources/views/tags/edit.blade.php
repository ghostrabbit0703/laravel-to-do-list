@extends('layout.app')

@section('title', 'Editar Etiquetas')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">

        <h1 class="mb-4">Editar Etiquetas</h1>

        <form action="{{ route('tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')

            @include('tags._form')

            <button type="submit" class="btn btn-warning">
                Actualizar
            </button>

            <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>

    </div>
</div>
@endsection
