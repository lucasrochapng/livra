<?php

namespace App\Http\Controllers;

use App\Models\LivroModel;
use App\Models\TrocaLivro;
use App\Models\Troca;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TrocaController extends Controller
{

    public function index()
    {
        $trocas = TrocaLivro::with([
            'usuarioOfertante',
            'usuarioReceptor',
            'livroOfertante', // Carrega diretamente o relacionamento com LivroModel
            'livroReceptor', // Carrega diretamente o relacionamento com LivroModel
        ])->get();

        return view('troca.index', compact('trocas'));
    }




    public function criarTroca(LivroModel $livro)
    {
        // Verifica os livros do usuário logado com estado 'disponível'
        $livrosDisponiveis = LivroModel::where('livro.estado_atual', 'disponivel')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('usuario')
                    ->join('usuario_livro', 'usuario.id', '=', 'usuario_livro.id_usuario')
                    ->whereColumn('livro.id', 'usuario_livro.id_livro')
                    ->where('usuario.id', auth()->id());
            })
            ->get();

        // Retorna a view com as informações necessárias
        return view('troca.criar', [
            'livroSelecionado' => $livro,
            'livrosDisponiveis' => $livrosDisponiveis,
        ]);
    }

    public function store(Request $request)
    {
        // Valida os dados recebidos
        $request->validate([
            'id_livro_ofertante' => 'required|exists:livro,id',
            'id_livro_receptor' => 'required|exists:livro,id',
        ]);

        // Cria a entrada na tabela troca
        $troca = Troca::create([
            'estado_atual' => null, // Deixe o estado_atual como null por enquanto
            'data_solicitacao' => now(), // Preenche com a data/hora atual
        ]);

        // Cria a entrada na tabela troca_livro
        TrocaLivro::create([
            'id_troca' => $troca->id, // Usa o ID da troca criada
            'id_usuario_ofertante' => auth()->id(),
            'id_usuario_receptor' => LivroModel::find($request->id_livro_receptor)->usuarios->first()->id ?? null,
            'id_livro_ofertante' => $request->id_livro_ofertante,
            'id_livro_receptor' => $request->id_livro_receptor,
        ]);

        return redirect()->route('acervo')->with('success', 'Proposta de troca enviada com sucesso!');
    }


    


}
