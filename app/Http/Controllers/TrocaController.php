<?php

namespace App\Http\Controllers;

use App\Models\LivroModel;
use App\Models\TrocaLivro;
use App\Models\Troca;
use App\Models\UsuarioLivro;
use App\Models\AvaliacoesPendentes;
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

        // Trocas onde o usuário é o ofertante
        $trocasComoOfertante = Troca::whereHas('trocaLivros', function ($query) use ($userId) {
            $query->where('id_usuario_ofertante', $userId);
        })
        ->where('estado_atual', 'em_andamento')
        ->get()
        ->map(function ($troca) {
            $troca->papel = 'ofertante'; // Adiciona uma propriedade personalizada
            return $troca;
        });

        // Trocas onde o usuário é o receptor
        $trocasComoReceptor = Troca::whereHas('trocaLivros', function ($query) use ($userId) {
            $query->where('id_usuario_receptor', $userId);
        })
        ->where('estado_atual', 'em_andamento')
        ->get()
        ->map(function ($troca) {
            $troca->papel = 'receptor'; // Adiciona uma propriedade personalizada
            return $troca;
        });

        // Combina as duas listas
        $trocas = $trocasComoOfertante->merge($trocasComoReceptor);
    
        return view('troca.index', compact('trocasRecebidas', 'trocasEnviadas', 'trocas'));
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
    
    public function aceitar($id)
    {
        // Busca a troca pelo ID
        $troca = Troca::findOrFail($id);
    
        // Atualiza o estado e a data de aceitação
        $troca->update([
            'estado_atual' => 'em_andamento',
            'data_aceito' => now(),
        ]);
    
        // Redireciona para a página de trocas com uma mensagem de sucesso
        return redirect()->route('troca.index')->with('success', 'Troca aceita com sucesso!');
    }
    
    public function finalizarTroca(Troca $troca)
    {
        // Atualiza o estado e a data da troca
        $troca->update([
            'estado_atual' => 'finalizado',
            'data_troca' => now(),
        ]);

        // Recupera os registros da tabela troca_livro
        $trocaLivros = TrocaLivro::where('id_troca', $troca->id)->first();

        if ($trocaLivros) {
            // Atualiza a tabela usuario_livro para inverter os donos dos livros
            UsuarioLivro::where('id_livro', $trocaLivros->id_livro_ofertante)
                ->update(['id_usuario' => $trocaLivros->id_usuario_receptor]);

            UsuarioLivro::where('id_livro', $trocaLivros->id_livro_receptor)
                ->update(['id_usuario' => $trocaLivros->id_usuario_ofertante]);

            // Atualiza o estado dos livros na tabela livro para 'indisponivel'
            LivroModel::where('id', $trocaLivros->id_livro_ofertante)
                ->update(['estado_atual' => 'indisponivel']);

            LivroModel::where('id', $trocaLivros->id_livro_receptor)
                ->update(['estado_atual' => 'indisponivel']);
        }

        // Adicionar registros de avaliações pendentes para ambos os usuários
        foreach ($troca->trocaLivros as $livro) {
            AvaliacoesPendentes::create([
                'id_troca' => $troca->id,
                'id_usuario_avaliador' => $livro->id_usuario_ofertante,
                'id_usuario_avaliado' => $livro->id_usuario_receptor,
            ]);

            AvaliacoesPendentes::create([
                'id_troca' => $troca->id,
                'id_usuario_avaliador' => $livro->id_usuario_receptor,
                'id_usuario_avaliado' => $livro->id_usuario_ofertante,
            ]);
        }

        // Redireciona para a página de trocas com uma mensagem de sucesso
        return redirect()->route('troca.index')->with('success', 'Troca finalizada e os livros foram atualizados!');
    }


    

}
