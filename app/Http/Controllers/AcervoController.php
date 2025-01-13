<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LivroModel;

class AcervoController extends Controller
{

    public function acervo()
    {
        // Filtra os livros para não mostrar os do usuário logado e só mostrar os livros com estado_atual 'disponivel'
        $livros = LivroModel::whereHas('usuario', function($query) {
            $query->where('usuario.id', '!=', auth()->id()); // Exclui os livros do usuário logado
        })
        ->where('estado_atual', 'disponivel') // Filtra livros com estado_atual 'disponivel'
        ->get();

        return view('acervo.index', compact('livros'));
    }



}
