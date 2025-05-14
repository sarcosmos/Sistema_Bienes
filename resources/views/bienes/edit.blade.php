@extends('layouts.app')

@section('title', 'Editar Bien')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Editar bien: {{ $bien->nombre }}</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <strong>¡Ups!</strong> Hay algunos errores:
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bienes.update', $bien) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @include('bienes.form')
    </form>
@endsection
