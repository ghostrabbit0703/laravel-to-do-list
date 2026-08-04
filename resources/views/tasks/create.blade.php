@extends('layout.app')

@section('title','Crear tarea')

@section('content')

<h1 class="mb-4">Nueva tarea</h1>

<form action="{{ route('tasks.store') }}" method="POST">

    @csrf

    @include('tasks._form')

    <button class="btn btn-success">
        Guardar
    </button>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
        Cancelar
    </a>

</form>

@endsection
