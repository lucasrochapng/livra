<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    // Define o nome da tabela
    protected $table = 'autor';

    // Defina os campos que podem ser preenchidos (mass assignment)
    protected $fillable = [
        'nome', 
        'descricao',
    ];

    // Relação com a tabela livro
    public function livros()
    {
        return $this->hasMany(LivroModel::class, 'id_autor');
    }
}
