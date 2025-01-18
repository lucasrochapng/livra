<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrocaLivro extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'troca_livro';

    // Chave primária da tabela
    protected $primaryKey = 'id';

    // Permitir que o Eloquent manipule as colunas abaixo
    protected $fillable = [
        'id_troca',
        'id_usuario_ofertante',
        'id_usuario_receptor',
        'id_livro_ofertante',
        'id_livro_receptor',
    ];

    public $timestamps = false;

    // Relacionamento com a tabela Troca
    public function troca()
    {
        return $this->belongsTo(Troca::class, 'id_troca');
    }

    // Relacionamento com o usuário ofertante
    public function usuarioOfertante()
    {
        return $this->belongsTo(UsuarioModel::class, 'id_usuario_ofertante');
    }

    // Relacionamento com o usuário receptor
    public function usuarioReceptor()
    {
        return $this->belongsTo(UsuarioModel::class, 'id_usuario_receptor');
    }

    // Relacionamento com o livro ofertado
    public function livroOfertante()
    {
        return $this->belongsTo(LivroModel::class, 'id_livro_ofertante', 'id');
    }

    // Relacionamento com o livro recebido
    public function livroReceptor()
    {
        return $this->belongsTo(LivroModel::class, 'id_livro_receptor', 'id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(UsuarioModel::class, 'usuario_livro', 'id_livro', 'id_usuario')
            ->withPivot('id_livro', 'id_usuario'); // Especifica explicitamente as colunas sem incluir timestamps
    }





}
