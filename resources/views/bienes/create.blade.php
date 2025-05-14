@extends('layouts.app')

@section('title', 'Registrar Bien')

@section('content')
    <div class="max-w-2xl mx-auto mt-6">
        <h2 class="text-2xl font-semibold mb-4">Registrar Nuevo Bien</h2>

        <!-- Mensajes de error de validación -->
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

        <!-- Formulario de registro -->
        <form action="{{ route('bienes.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('bienes.form') <!-- Incluye el formulario común -->
            
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
                    Guardar Bien
                </button>
            </div>
        </form>
    </div>
@endsection
