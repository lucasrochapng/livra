<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioLivro extends Model
{
    use HasFactory;

    protected $table = 'usuario_livro';
    public $timestamps = false;
    protected $fillable = [
        'id_usuario', 'id_livro', 'historico_dono'
    ];

    public function livro()
    {
        return $this->belongsTo(LivroModel::class, 'id_livro');
    }

    public function usuario()
    {
        return $this->belongsTo(UsuarioModel::class, 'id_usuario');
    }

    public function trocasOfertadas()
    {
        return $this->hasMany(TrocaLivro::class, 'id_livro_ofertante');
    }

    public function trocasRecebidas()
    {
        return $this->hasMany(TrocaLivro::class, 'id_livro_receptor');
    }





}
