@extends('layout.app')

@section('title','Editar tarea')

@section('content')

<h1 class="mb-4">Editar tarea</h1>

<form
    action="{{ route('tasks.update',$task) }}"
    method="POST"
>

    @csrf
    @method('PUT')

    @include('tasks._form')

    <button class="btn btn-warning">
        Actualizar
    </button>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
        Cancelar
    </a>

</form>

@endsection
