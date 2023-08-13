<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $table = 'professores';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'password',
        'dataNasc',
        'foto',
        'nomePai',
        'nomeMae',
        'siape',
        'telefone',
        'sexo',
        'idMateria',
    ];
}
