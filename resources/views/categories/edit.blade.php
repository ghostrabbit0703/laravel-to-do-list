@extends('layout.app')

@section('title', 'Editar Categoría')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">

        <h1 class="mb-4">Editar Categoría</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            @include('categories._form')

            <button type="submit" class="btn btn-warning">
                Actualizar
            </button>

            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>

    </div>
</div>
@endsection
