<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LivroModel;
use App\Models\Autor;
use App\Models\Genero;

class LivroController extends Controller
{

    // Exibe a view de criação de livros com os dados de autores e gêneros
    public function create()
    {
        // Busca todos os autores e gêneros cadastrados no banco
        $autores = Autor::all();
        $generos = Genero::all();

        // Retorna a view com os dados dos autores e gêneros
        return view('Livro.create', compact('autores', 'generos'));
    }


    // Salva um novo livro no banco
    public function store(Request $request)
    {
        // Validação dos campos
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'foto_livro' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'autor_id' => 'required|exists:autor,id',
            'genero_id' => 'required|exists:genero,id',
        ]);

        // Chama o método salvar do modelo LivroModel, passando o autor_id e genero_id
        $status = LivroModel::salvar($request);

        if ($status) {
            return redirect()->back()->with('mensagem', 'Livro cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('mensagem', 'Erro ao cadastrar o livro. Tente novamente!');
        }
    }

    // Lista os livros do usuário logado
    public function index()
    {
        $livros = LivroModel::listarPorUsuario(auth()->id());
        return view('Livro.index', compact('livros'));
    }

    // Exclui um livro
    public function destroy($id)
    {
        $livro = LivroModel::find($id);

        if ($livro) {
            // Soft delete: preenche o campo 'deleted_At' com a data atual
            $livro->delete();

            return redirect('livros')->with('mensagem', 'Livro excluído com sucesso!');
        } else {
            return redirect('livros')->with('mensagem', 'Livro não encontrado.');
        }
    }


    // Exibe a view de edição de um livro
    public function edit($id)
    {
        $livro = LivroModel::consultar($id);
        return view('Livro.edit', compact('livro'));
    }

    // Atualiza os dados do livro
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'foto_livro' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $status = LivroModel::atualizar($id, $request);

        if ($status) {
            return redirect()->route('listarLivro')->with('success', 'Livro atualizado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao atualizar o livro.');
        }
    }

    // Atualiza o estado atual do livro
    public function toggleStatus($id)
    {
        $status = LivroModel::alterarEstado($id);

        if ($status) {
            return redirect('listarLivro')->with('mensagem', 'Estado do livro atualizado com sucesso!');
        } else {
            return redirect('listarLivro')->with('mensagem', 'Erro ao atualizar o estado do livro.');
        }
    }
}
