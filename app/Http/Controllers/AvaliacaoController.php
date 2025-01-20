<?php

namespace App\Http\Controllers;

use App\Models\AvaliacaoUsuario;
use App\Models\AvaliacoesPendentes;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function pendentes()
    {
        $avaliacoesPendentes = AvaliacoesPendentes::with('usuarioAvaliado')
            ->where('id_usuario_avaliador', auth()->id())
            ->get();

        return view('avaliacao.pendentes', compact('avaliacoesPendentes'));
    }

    public function avaliar(Request $request, $id)
    {
        $request->validate([
            'nota' => 'required|integer|min:0|max:5',
            'comentario' => 'nullable|string',
        ]);

        $pendente = AvaliacoesPendentes::findOrFail($id);

        // Registrar a avaliação
        AvaliacaoUsuario::create([
            'id_avaliador' => $pendente->id_usuario_avaliador,
            'id_avaliado' => $pendente->id_usuario_avaliado,
            'nota' => $request->nota,
            'comentario' => $request->comentario,
        ]);

        // Remover da lista de pendentes
        $pendente->delete();

        return redirect()->route('avaliacoes.pendentes')
            ->with('success', 'Avaliação registrada com sucesso!');
    }
}
