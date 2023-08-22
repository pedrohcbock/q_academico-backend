<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfessoresController extends Controller
{
    public function index()
    {
        $professores = Professor::all();
        return response()->json($professores, 200);
    }

    public function show(Professor $professor)
    {
        return response()->json($professor, 200);
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
            'siape' => 'required',
            'telefone' => 'required',
            'sexo' => 'required',
            'idMateria' => 'required',
        ]);

        $dados['password'] = Hash::make($dados['password']);

        $professor = Professor::create($dados);

        return response()->json($professor, 201);
    }

    public function update(Request $request, Professor $professor)
    {
        $dados = $request->validate([
            'nome' => [
                'required',
                Rule::unique('professores')->ignore($professor->id),
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

        $professor->update($dados);

        return response()->json($professor, 200);
    }

    public function changePassword(Request $request, Professor $professor)
    {
        $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|confirmed',
        ]);

        $professor = Professor::where('cpf', $request->cpf)->first();

        if (!$professor) {
            return response()->json(['error' => 'Professor não encontrado.'], 422);
        }

        $professor->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Senha alterada com sucesso'], 200);
    }

    public function delete(Professor $professor)
    {
        $professor->delete();

        return response()->json(null, 204);
    }
}
