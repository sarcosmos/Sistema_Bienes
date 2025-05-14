@csrf

<!-- Campo Nombre -->
<div>
    <label for="nombre" class="block font-bold">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $bien->nombre ?? '') }}"
        class="w-full border rounded px-3 py-2 @error('nombre') border-red-500 @enderror" required>
    @error('nombre')
        <div class="text-red-500 text-sm">{{ $message }}</div>
    @enderror
</div>

<!-- Campo Código -->
<div>
    <label for="codigo" class="block font-bold">Código:</label>
    <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $bien->codigo ?? '') }}"
        class="w-full border rounded px-3 py-2" required>
</div>

<!-- Campo Categoría -->
<div>
    <label for="categoria" class="block font-bold">Categoría:</label>
    <select name="categoria" id="categoria" class="w-full border rounded px-3 py-2" required>
        <option value="">-- Selecciona una categoría --</option>
        <option value="Herramienta" {{ old('categoria', $bien->categoria ?? '') == 'Herramienta' ? 'selected' : '' }}>Herramienta</option>
        <option value="Producto" {{ old('categoria', $bien->categoria ?? '') == 'Producto' ? 'selected' : '' }}>Producto</option>
        <option value="Consumible" {{ old('categoria', $bien->categoria ?? '') == 'Consumible' ? 'selected' : '' }}>Consumible</option>
    </select>
</div>

<!-- Campo Cantidad -->
<div>
    <label for="cantidad" class="block font-bold">Cantidad:</label>
    <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $bien->cantidad ?? 1) }}"
        class="w-full border rounded px-3 py-2" min="1" required>
</div>

<!-- Campo Estado -->
<div>
    <label for="estado" class="block font-bold">Estado:</label>
    <select name="estado" id="estado" class="w-full border rounded px-3 py-2" required>
        <option value="Disponible" {{ old('estado', $bien->estado ?? '') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
        <option value="Asignado" {{ old('estado', $bien->estado ?? '') == 'Asignado' ? 'selected' : '' }}>Asignado</option>
    </select>
</div>

<!-- Mensajes de éxito y error -->
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<!-- Campo Fecha de Registro -->
<div>
    <label for="fecha_registro" class="block font-bold">Fecha de Registro:</label>
    <input type="date" name="fecha_registro" id="fecha_registro" 
           value="{{ old('fecha_registro', $bien->fecha_registro ?? '') }}" 
           class="w-full border rounded px-3 py-2" required>
</div>

<!-- Botón de envío -->
<div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Guardar Bien
    </button>
</div>
