<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoUsuario extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes_usuarios';

    protected $fillable = [
        'id_avaliador',
        'id_avaliado',
        'nota',
        'comentario',
    ];

    public function avaliador()
    {
        return $this->belongsTo(UsuarioModel::class, 'id_avaliador');
    }





}

