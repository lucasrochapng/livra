<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LivroModel;

class Livro extends Controller
{
    public function create(){
        return view('Livro.create');
    }

    public function store(Request $request){
        $status = LivroModel::salvar($request);
        if($status){
            return redirect()->back()->with('mensagem', 'Livro cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('mensagem', 'Erro ao cadastrar o livro. Tente novamente.');
        }
    }

    public function index(){
        $livros = LivroModel::listar();
        return view('Livro.index', compact('livros'));
    }

    public function destroy($id){
        $status = LivroModel::deletar($id);
        if($status){
            return redirect('listarLivro')->with('mensagem', 'Livro deletado com sucesso!');
        } else {
            return redirect('listarLivro')->with('mensagem', 'Livro não encontrado');
        }
    }

    public function edit($id){
        $livro = LivroModel::consultar($id);
        return view('Livro.edit', compact('livro'));
    }
}
