@extends('layout.app')

@section('title', 'Crear Etiqueta')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">

        <h1 class="mb-4">Nueva Etiqueta</h1>

        <form action="{{ route('tags.store') }}" method="POST">
            @csrf

            @include('tags._form')

            <button type="submit" class="btn btn-primary">
                Guardar
            </button>

            <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>

    </div>
</div>
@endsection
