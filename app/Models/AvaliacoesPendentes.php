<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacoesPendentes extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes_pendentes';

    protected $fillable = [
        'id_troca',
        'id_usuario_avaliador',
        'id_usuario_avaliado',
    ];

    public $timestamps = false;

    public function usuarioAvaliado()
    {
        return $this->belongsTo(UsuarioModel::class, 'id_usuario_avaliado');
    }
}

