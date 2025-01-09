<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class LivroModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['titulo', 'descricao', 'estado_atual', 'foto_livro', 'data_troca', 'id_autor', 'id_genero'];
    
    protected $table = 'livro';
    public $timestamps = false;


    public static function salvar(Request $request)
    {
        // Armazena a imagem, caso tenha sido enviada
        //$path = $request->file('foto_livro') ? $request->file('foto_livro')->store('livros') : null;

        // Processa o upload da nova imagem, caso tenha sido enviada
        $path = $request->file('foto_livro') ? $request->file('foto_livro')->store('livros', 'public') : null;

        // Insere o livro na tabela 'livro'
        $livroId = DB::table('livro')->insertGetId([
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao'),
            'estado_atual' => 'indisponivel', // O estado inicial do livro
            'foto_livro' => $path,
            'data_cadastro' => now(),
            'id_autor' => $request->input('autor_id'), // Adiciona o autor
            'id_genero' => $request->input('genero_id'), // Adiciona o gênero
        ]);

        // Após inserir o livro, cria o vínculo na tabela 'usuario_livro'
        DB::table('usuario_livro')->insert([
            'id_usuario' => auth()->id(), // ID do usuário logado
            'id_livro' => $livroId, // ID do livro inserido
        ]);

        return true;
    }



    // public static function listarPorUsuario($idUsuario)
    // {
    //     return DB::table('livro')
    //         ->join('usuario_livro', 'livro.id', '=', 'usuario_livro.id_livro')
    //         ->where('usuario_livro.id_usuario', $idUsuario)
    //         ->whereNull('livro.deleted_at')
    //         ->get();
    // }

    public static function listarPorUsuario($idUsuario)
    {
        return LivroModel::join('usuario_livro', 'livro.id', '=', 'usuario_livro.id_livro')
            ->where('usuario_livro.id_usuario', $idUsuario)
            ->whereNull('livro.deleted_at')  // Exclui os livros com data de exclusão
            ->with(['autor', 'genero']) // Carrega os relacionamentos
            ->get(); // Executa a consulta e retorna os resultados
    }

    public static function consultar($id)
    {
        return DB::table('livro')->where('id', $id)->first();
    }

    public static function atualizar($id, Request $request)
    {
        // Processa o upload da nova imagem, caso tenha sido enviada
        $path = $request->file('foto_livro') ? $request->file('foto_livro')->store('livros', 'public') : null;

        $dados = [
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao'),
            'id_autor' => $request->input('autor_id'),
            'id_genero' => $request->input('genero_id'),
        ];

        if ($path) {
            $dados['foto_livro'] = $path;
        }

        return DB::table('livro')->where('id', $id)->update($dados);
    }


    public static function deletar($id)
    {
        $livro = self::find($id);

        if ($livro) {
            // Soft delete: preenche o campo 'deleted_at' com a data atual
            return $livro->delete();
        }

        return false;
    }

    public static function alterarEstado($id)
    {
        $livro = self::consultar($id);

        if ($livro->estado_atual === 'indisponivel') {
            $novoEstado = 'disponivel';
        } elseif ($livro->estado_atual === 'disponivel') {
            $novoEstado = 'indisponivel';
        } else {
            return false; // Não alterar estado se for "em_andamento"
        }

        return DB::table('livro')->where('id', $id)->update(['estado_atual' => $novoEstado]);
    }

    // Relacionamento com Autor
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'id_autor');
    }

    // Relacionamento com Genero
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'id_genero');
    }

    // Evento para excluir a imagem ao realizar o soft delete
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($livro) {
            if ($livro->foto_livro && Storage::exists("public/{$livro->foto_livro}")) {
                Storage::delete("public/{$livro->foto_livro}");
            }
        });
    }


}
