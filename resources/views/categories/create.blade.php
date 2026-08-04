@extends('layout.app')

@section('title', 'Crear Categoría')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">

        <h1 class="mb-4">Nueva Categoría</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            @include('categories._form')

            <button type="submit" class="btn btn-primary">
                Guardar
            </button>

            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>

    </div>
</div>
@endsection
