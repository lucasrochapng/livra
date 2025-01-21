<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Troca extends Model
{
    use HasFactory;

    protected $table = 'troca';

    public $timestamps = false;

    protected $fillable = [
        'estado_atual',
        'data_solicitacao',
        'data_recusado',
        'data_aceito',
        'data_troca',
    ];

    protected $dates = [
        'data_solicitacao',
        'data_recusado',
        'data_aceito',
        'data_troca',
    ];

    public function trocaLivros()
    {
        return $this->hasMany(TrocaLivro::class, 'id_troca');
    }

    


}
