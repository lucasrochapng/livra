<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroModel extends Model
{
    use HasFactory;

    public static function salvar(Request $request){
        $status = DB::table('livro')->insert([
            'titulo'=>$request->input('titulo'),
            'autor'=>$request->input('autor'),
            'genero'=>$request->input('genero'),
            'descricao'=>$request->input('descricao')
        ]);
        return $status;
    }

    public static function listar(){
        $livros = DB::table('livro')->get();
        return $livros;
    }

    public static function deletar($id){
        $status = DB::table('livro')->delete($id);
        return $status;
    }

    public static function consultar($id){
        $livro = DB::table('livro')->where('id', $id)->first();
        return $livro;
    }

}