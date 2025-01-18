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
        $userId = auth()->id();
    
        // Trocas onde o usuário é o receptor
        $trocasRecebidas = TrocaLivro::with([
            'usuarioOfertante',
            'usuarioReceptor',
            'livroOfertante',
            'livroReceptor',
        ])
        ->whereHas('troca', function ($query) {
            $query->whereNull('estado_atual');
        })
        ->where('id_usuario_receptor', $userId)
        ->get();
    
        // Trocas onde o usuário é o ofertante
        $trocasEnviadas = TrocaLivro::with([
            'usuarioOfertante',
            'usuarioReceptor',
            'livroOfertante',
            'livroReceptor',
        ])
        ->whereHas('troca', function ($query) {
            $query->whereNull('estado_atual');
        })
        ->where('id_usuario_ofertante', $userId)
        ->get();
    
        return view('troca.index', compact('trocasRecebidas', 'trocasEnviadas'));
    }
    

    // public function index()
    // {
    //     $userId = auth()->id();

    //     // Trocas onde o usuário é o receptor
    //     $trocasRecebidas = TrocaLivro::with([
    //         'usuarioOfertante',
    //         'usuarioReceptor',
    //         'livroOfertante',
    //         'livroReceptor',
    //     ])
    //     ->where('id_usuario_receptor', $userId)
    //     ->get();

    //     // Trocas onde o usuário é o ofertante
    //     $trocasEnviadas = TrocaLivro::with([
    //         'usuarioOfertante',
    //         'usuarioReceptor',
    //         'livroOfertante',
    //         'livroReceptor',
    //     ])
    //     ->where('id_usuario_ofertante', $userId)
    //     ->get();

    //     return view('troca.index', compact('trocasRecebidas', 'trocasEnviadas'));
    // }

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

    public function recusarTroca($id)
    {
        // Busca a troca pelo ID e verifica se o usuário é o receptor
        $troca = Troca::where('id', $id)
            ->whereHas('trocaLivros', function ($query) {
                $query->where('id_usuario_receptor', auth()->id());
            })
            ->firstOrFail();
    
        // Atualiza os campos necessários
        $troca->update([
            'estado_atual' => 'recusado',
            'data_recusado' => now(),
        ]);
    
        return redirect()->route('troca.index')->with('success', 'Troca recusada com sucesso.');
    }
    
    public function cancelarProposta($id)
    {
        // Busca a troca pelo ID e verifica se o usuário é o ofertante
        $troca = Troca::where('id', $id)
            ->whereHas('trocaLivros', function ($query) {
                $query->where('id_usuario_ofertante', auth()->id());
            })
            ->firstOrFail();
    
        // Atualiza os campos necessários
        $troca->update([
            'estado_atual' => 'recusado',
            'data_recusado' => now(),
        ]);
    
        return redirect()->route('troca.index')->with('success', 'Proposta cancelada com sucesso.');
    }
    
    


}
