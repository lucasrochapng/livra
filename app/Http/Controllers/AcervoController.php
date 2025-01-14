<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LivroModel;

class AcervoController extends Controller
{

    // public function acervo()
    // {
    //     // Filtra os livros para não mostrar os do usuário logado e só mostrar os livros com estado_atual 'disponivel'
    //     $livros = LivroModel::whereHas('usuario', function($query) {
    //         $query->where('usuario.id', '!=', auth()->id()); // Exclui os livros do usuário logado
    //     })
    //     ->where('estado_atual', 'disponivel') // Filtra livros com estado_atual 'disponivel'
    //     ->get();

    //     return view('acervo.index', compact('livros'));
    // }

    public function acervo(Request $request)
    {
        // Obtém os parâmetros de pesquisa e filtro
        $query = LivroModel::whereHas('usuario', function ($q) {
            $q->where('usuario.id', '!=', auth()->id());
        })
        ->where('estado_atual', 'disponivel');

        // Filtrar por campo selecionado (título, autor, gênero)
        if ($request->filled('filtro') && $request->filled('pesquisa')) {
            $campo = $request->input('filtro'); // 'titulo', 'autor.nome', 'genero.nome'
            $pesquisa = $request->input('pesquisa');
            
            if ($campo === 'autor' || $campo === 'genero') {
                $query = $query->whereHas($campo, function ($q) use ($pesquisa) {
                    $q->where('nome', 'like', '%' . $pesquisa . '%');
                });
            } else {
                $query = $query->where($campo, 'like', '%' . $pesquisa . '%');
            }
        }

        // Filtrar por letra inicial do título
        if ($request->filled('letra')) {
            $letra = $request->input('letra');
            $query = $query->where('titulo', 'like', $letra . '%');
        }

        // Ordenar por ordem alfabética
        $livros = $query->orderBy('titulo')->get();

        return view('acervo.index', compact('livros'));
    }



}
