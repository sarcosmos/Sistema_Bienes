<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Bien::query();

    if ($request->has('buscar') && $request->buscar != '') {
        $query->where('nombre', 'like', '%' . $request->buscar . '%')
              ->orWhere('codigo', 'like', '%' . $request->buscar . '%');
    }

    $bienes = $query->get();

    return view('bienes.index', compact('bienes'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('bienes.create');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación de los datos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'codigo' => 'required|string|max:100',
        'categoria' => 'required|string',
        'cantidad' => 'required|integer|min:1',
        'estado' => 'required|string',
        'fecha_registro' => 'required|date',
    ]);

    // Crear el bien
    $bien = new Bien();
    $bien->nombre = $request->nombre;
    $bien->codigo = $request->codigo;
    $bien->categoria = $request->categoria;
    $bien->cantidad = $request->cantidad;
    $bien->estado = $request->estado;
    $bien->fecha_registro = $request->fecha_registro;
    $bien->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('bienes.index')->with('success', 'Bien registrado correctamente');
}


    /**
     * Display the specified resource.
     */
    public function show(Bien $bien)
{
    return view('bienes.show', compact('bien'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bien $bien)
{
    return view('bienes.edit', compact('bien'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bien $bien)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'codigo' => 'required|string|max:100|unique:bienes,codigo,' . $bien->id,
        'categoria' => 'required|in:Herramienta,Producto,Consumible',
        'cantidad' => 'required|integer|min:1',
        'estado' => 'required|in:Disponible,Asignado',
        'fecha_registro' => 'required|date',
    ]);

    // Actualizar los campos
    $bien->update($request->all());

    // Redirigir con mensaje de éxito
    return redirect()->route('bienes.index')->with('success', 'Bien actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bien $bien)
{
    // Verificar si el bien está asignado o tiene algún préstamo activo
    if ($bien->estado === 'Asignado') {
        return redirect()->route('bienes.index')->with('error', 'No se puede eliminar un bien asignado.');
    }

    // Eliminar el bien
    $bien->delete();

    // Redirigir con un mensaje de éxito
    return redirect()->route('bienes.index')->with('success', 'Bien eliminado correctamente.');
}


}
