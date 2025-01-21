<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\UsuarioModel;
use App\Models\Troca;
use App\Models\AvaliacaoUsuario;

class Usuario extends Controller
{

    public function index()
    {
        $usuario = auth()->user();
    
        // Calcula a média usando o método na model
        $mediaNota = $usuario->mediaAvaliacoes();
    
        // Obtém as avaliações recebidas
        $avaliacoes = $usuario->avaliacoesRecebidas()->with('avaliador')->get();

        // Calcula o número de trocas concluídas
        $trocasConcluidas = DB::table('troca_livro')
        ->join('troca', 'troca_livro.id_troca', '=', 'troca.id')
        ->where(function ($query) use ($usuario) {
            $query->where('troca_livro.id_usuario_ofertante', $usuario->id)
                ->orWhere('troca_livro.id_usuario_receptor', $usuario->id);
        })
        ->where('troca.estado_atual', 'finalizado')
        ->distinct('troca_livro.id_troca')
        ->count('troca_livro.id_troca');
    
        return view('usuario.index', compact('usuario', 'mediaNota', 'avaliacoes', 'trocasConcluidas'));
    }
       
    
    public function create(){
        return view('Usuario.create');
    }

    public function store(Request $request){
        $status = UsuarioModel::salvar($request);

        if ($status){
            return redirect()->back()->with('mensagem', 'Usuário cadastrado com sucesso!');
        }
        else {
            return redirect()->back()->with('mensagem', 'Erro ao cadastrar o usuário. Tente novamente!');
        }
    }

    public function edit($id)
    {
        $usuario = UsuarioModel::findOrFail($id);
        return view('usuario.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:15',
            'email' => 'required|email|unique:usuario,email,' . $id, // Use o nome correto da tabela aqui
            'senha' => 'nullable|string|min:6',
        ]);
    
        $usuario = UsuarioModel::findOrFail($id);
    
        $usuario->nome = $request->input('nome');
        $usuario->telefone = $request->input('telefone');
        $usuario->email = $request->input('email');
    
        if ($request->filled('senha')) {
            $usuario->senha = Hash::make($request->input('senha'));
        }
    
        $usuario->save();
    
        return redirect()->route('usuario.index')->with('success', 'Usuário atualizado com sucesso!');
    }
    


    public function destroy($id){
        $status = UsuarioModel::deletar($id);
        if($status) {
            return redirect('listarUsuario')->with('mensagem', 'Usuário deletado com sucesso!');
        }
        else {
            return redirect('listarUsuario')->with('mensagem', 'Usuário não encontrado');
        }
    }

    public function show($id)
    {
        // Encontra o usuário pelo ID
        $usuario = UsuarioModel::findOrFail($id);

        // Calcula a média usando o método na model
        $mediaNota = $usuario->mediaAvaliacoes();

        // Obtém as avaliações recebidas
        $avaliacoes = $usuario->avaliacoesRecebidas()->with('avaliador')->get();

        // Calcula o número de trocas concluídas
        $trocasConcluidas = DB::table('troca_livro')
            ->join('troca', 'troca_livro.id_troca', '=', 'troca.id')
            ->where(function ($query) use ($usuario) {
                $query->where('troca_livro.id_usuario_ofertante', $usuario->id)
                    ->orWhere('troca_livro.id_usuario_receptor', $usuario->id);
            })
            ->where('troca.estado_atual', 'finalizado')
            ->distinct('troca_livro.id_troca')
            ->count('troca_livro.id_troca');

        return view('usuario.show', compact('usuario', 'mediaNota', 'avaliacoes', 'trocasConcluidas'));
    }

    

    


}
