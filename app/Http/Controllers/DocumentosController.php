<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentosController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required',
            'arquivo' => 'required|max:4096',
        ]);

        $documentoNome = time() . '.' . $request->file('arquivo')->getClientOriginalExtension();
        $request->file('arquivo')->storeAs('uploads', $documentoNome, 'public');

        $documento = new Documento();
        $documento->tipo = $request->input('tipo_documento');
        $documento->nomeDocumento = $documentoNome;
        $documento->save();

        return response()->json(['message' => 'Documento enviado com sucesso'], 201);
    }

    public function index()
    {
        $documentos = Documento::all();
        return response()->json($documentos);
    }

    public function download($id)
    {
        $documento = Documento::findOrFail($id);
        $filePath = storage_path('app/public/uploads/' . $documento->nomeDocumento);

        if (file_exists($filePath)) {
            return response()->download($filePath, $documento->tipo . '.pdf');
        }

        return response()->json(['error' => 'Documento não encontrado'], 404);
    }

    public function filter(Request $request)
    {
        $filtroTipo = $request->input('filtro_tipo');

        if ($filtroTipo) {
            $documentos = Documento::where('tipo', $filtroTipo)->get();
        } else {
            $documentos = Documento::all();
        }

        return response()->json($documentos);
    }
}
