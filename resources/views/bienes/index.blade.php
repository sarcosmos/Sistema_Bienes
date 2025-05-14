@extends('layouts.app')

@section('title', 'Lista de Bienes')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Bienes Registrados</h2>
    <a href="{{ route('bienes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Registrar Bien
    </a>
</div>

{{-- Filtro de búsqueda --}}
<form method="GET" action="{{ route('bienes.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre o código"
        class="border rounded px-3 py-2 w-1/3">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Buscar
    </button>
</form>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full border border-gray-300 rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">ID</th>
            <th class="p-2 border">Nombre</th>
            <th class="p-2 border">Código</th>
            <th class="p-2 border">Categoría</th>
            <th class="p-2 border">Estado</th>
            <th class="p-2 border">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bienes as $bien)
            <tr class="hover:bg-gray-100">
                <td class="p-2 border">{{ $bien->id }}</td>
                <td class="p-2 border">{{ $bien->nombre }}</td>
                <td class="p-2 border">{{ $bien->codigo }}</td>
                <td class="p-2 border">{{ $bien->categoria }}</td>
                <td class="p-2 border">{{ $bien->estado }}</td>
                <td class="p-2 border space-x-2">
                    <a href="{{ route('bienes.show', $bien) }}" class="text-blue-600 hover:underline">Ver</a>
                    <a href="{{ route('bienes.edit', $bien) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form action="{{ route('bienes.destroy', $bien) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Eliminar este bien?')"
                            class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                    @if($bien->estado === 'Disponible')
                        <a href="{{ route('prestamos.create', $bien) }}" class="text-indigo-600 hover:underline">Prestar</a>
                    @elseif($bien->estado === 'Asignado')
                        <a href="{{ route('devoluciones.create', $bien) }}" class="text-green-600 hover:underline">Devolver</a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center p-4 text-gray-600">No hay bienes registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
