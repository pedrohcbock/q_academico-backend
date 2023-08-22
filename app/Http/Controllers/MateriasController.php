<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return response()->json($materias, 200);
    }

    public function show(Materia $materia)
    {
        return response()->json($materia, 200);
    }

    public function create(Request $request)
    {
        $dados = $request->validate([
            'materia' => 'required',
            'cargaHoraria' => 'required',
        ]);

        $materia = Materia::create($dados);

        return response()->json($materia, 201);
    }

    public function update(Request $request, Materia $materia)
    {
        $dados = $request->validate([
            'materia' => 'required',
            'cargaHoraria' => 'required',
        ]);

        $materia->update($dados);

        return response()->json($materia, 200);
    }

    public function delete(Materia $materia)
    {
        $materia->delete();

        return response()->json(null, 204);
    }
}
