<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MateriaisController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required',
            'arquivo' => 'required|max:4096',
        ]);

        $materialNome = time() . '.' . $request->file('arquivo')->getClientOriginalExtension();
        $request->file('arquivo')->storeAs('uploads', $materialNome, 'public');

        $material = new Material();
        $material->tipo = $request->input('tipo_documento');
        $material->nomeMaterial = $materialNome;
        $material->save();

        return response()->json(['message' => 'MAterial enviado com sucesso'], 201);
    }

    public function index()
    {
        $materiais = Material::all();
        return response()->json($materiais, 200);
    }

    public function download($id)
    {
        $material = Material::findOrFail($id);
        $filePath = storage_path('app/public/uploads/' . $material->nomeMaterial);

        if (file_exists($filePath)) {
            return response()->download($filePath, $material->tipo . '.pdf');
        }

        return response()->json(['error' => 'Material não encontrado'], 404);
    }

    public function filter(Request $request)
    {
        $filtroTipo = $request->input('filtro_tipo');

        if ($filtroTipo) {
            $materiais = Material::where('tipo', $filtroTipo)->get();
        } else {
            $materiais = Material::all();
        }

        return response()->json($materiais);
    }
}
