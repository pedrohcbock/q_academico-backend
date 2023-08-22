<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotasController extends Controller
{
    public function show(Nota $notas)
    {
        $alunoId = Auth::guard('aluno')->id();
        $notas = Nota::where('idAluno', $alunoId)->get();

        return response()->json($notas, 200);
    }

    public function create(Request $request)
    {
        $dados = $request->validate([
            'idAluno' => 'required',
            'idMateria' => 'required',
            'nota' => 'required'
        ]);

        $nota = Nota::create($dados);

        return response()->json($nota, 201);
    }

    public function update(Request $request, Nota $nota)
    {
        $dados = $request->validate([
            'idAluno' => 'required',
            'idMateria' => 'required',
            'nota' => 'required'
        ]);

        $nota->update($dados);

        return response()->json($nota, 200);
    }

    public function delete(Nota $nota)
    {
        $nota->delete();

        return response()->json(null, 204);
    }
}
