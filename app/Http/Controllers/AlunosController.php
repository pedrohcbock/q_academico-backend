<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AlunosController extends Controller
{
public function index()
    {
        $alunos = Aluno::all();
        return response()->json($alunos, 200);
    }

    public function show(Aluno $aluno)
    {
        return response()->json($aluno);
    }

    public function create(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'cpf' => 'required',
            'password' => 'required',
            'dataNasc' => 'required',
            'foto' => 'required',
            'nomePai' => 'required',
            'nomeMae' => 'required',
            'matricula' => 'required',
            'telefone' => 'required',
            'sexo' => 'required',
            'idCurso' => 'required',
            'idTurma' => 'required',
        ]);

        $dados['password'] = Hash::make($dados['password']);

        $aluno = Aluno::create($dados);

        return response()->json($aluno, 201);
    }

    public function update(Request $request, Aluno $aluno)
    {
        $dados = $request->validate([
            'nome' => [
                'required',
                Rule::unique('alunos')->ignore($aluno->id),
                'min:3',
            ],
            'email' => 'required',
            'dataNasc' => 'required',
            'telefone' => 'required',
            'nomePai' => 'required',
            'nomeMae' => 'required',
            'foto' => 'required',
            'sexo' => 'required',
        ]);

        unset($dados['password']);

        $aluno->update($dados);

        return response()->json($aluno, 200);
    }

    public function changePassword(Request $request, Aluno $aluno)
    {
        $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|confirmed',
        ]);

        $aluno = Aluno::where('cpf', $request->cpf)->first();

        if (!$aluno) {
            return response()->json(['error' => 'Aluno não encontrado.'], 422);
        }

        $aluno->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Senha alterada com sucesso'], 200);
    }

    public function delete(Aluno $aluno)
    {
        $aluno->delete();

        return response()->json(null, 204);
    }
}
