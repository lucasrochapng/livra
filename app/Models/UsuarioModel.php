<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioModel extends Model
{
    
    use HasFactory;

    public static function salvar(Request $request){
        $status = DB::table('usuario')->insert([
            'nome'=>$request->input('nome'),
            'email'=>$request->input('email'),
            'senha'=>$request->input('senha'),
            'telefone'=>$request->input('telefone'),
        ]);
        return $status;
    }

    public static function listar(){
        $usuarios = DB::table('usuario')->get();
        return $usuarios;
    }

    public static function deletar($id){
        $status = DB::table('usuario')->where('id',$id)->delete();
        return $status;
    }

    public static function consultar($id){
        $usuario = DB::table('usuario')->where('id', $id)->first();
        return $usuario;
    }

}
