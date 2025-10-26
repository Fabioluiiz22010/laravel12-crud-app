<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    
    // Nome da tabela no banco de dados
    protected $table = 'produtos';

    // Campos que podem ser preenchidos em massa (mass assignable)
    // Mantemos os nomes em Inglês 'name'/'description' pois são os nomes das colunas no banco.
    protected $fillable = [
        'titulo',
        'descricao',
        'preco',
        'estoque',
    ];
}
