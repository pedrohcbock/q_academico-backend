<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return response()->json($cursos, 200);
    }

    public function show(Curso $curso)
    {
        return response()->json($curso, 200);
    }

    public function create(Request $request)
    {
        $dados = $request->validate([
            'curso' => 'required',
        ]);

        $curso = Curso::create($dados);

        return response()->json($curso, 201);
    }

    public function update(Request $request, Curso $curso)
    {
        $dados = $request->validate([
            'curso' => 'required',
        ]);

        $curso->update($dados);

        return response()->json($curso, 200);
    }

    public function delete(Curso $curso)
    {
        $curso->delete();

        return response()->json(null, 204);
    }
}
