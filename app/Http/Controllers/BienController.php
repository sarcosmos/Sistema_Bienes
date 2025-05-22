<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;

class BienController extends Controller
{
    public function index()
    {
        return Bien::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'categoria' => 'required|string',
            'codigo' => 'required|string|unique:bienes',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
        ]);

        // Determinar el estado automáticamente según la cantidad
        $estado = $request->cantidad > 0 ? 'con existencia' : 'agotado';

        $bien = Bien::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'codigo' => $request->codigo,
            'cantidad' => $request->cantidad,
            'estado' => $estado,
        ]);

        return response()->json($bien, 201);
    }

    public function show(Bien $bien)
    {
        return $bien;
    }

    public function update(Request $request, Bien $bien)
    {
        $request->validate([
            'nombre' => 'sometimes|string',
            'categoria' => 'sometimes|string',
            'descripcion' => 'nullable|string',
            'codigo' => 'sometimes|string|unique:bienes,codigo,' . $bien->id,
            'cantidad' => 'sometimes|integer|min:0',
        ]);

        $data = $request->only(['nombre', 'categoria', 'descripcion', 'codigo', 'cantidad']);

        // Si se actualiza la cantidad, recalcular el estado
        if ($request->has('cantidad')) {
            $data['estado'] = $request->cantidad > 0 ? 'con existencia' : 'agotado';
        }

        $bien->update($data);

        return response()->json($bien);
    }

    public function destroy(Bien $bien)
    {
        $bien->delete();
        return response()->json(null, 204);
    }
}


