<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    protected $table = 'alunos';
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
        'matricula',
        'telefone',
        'sexo',
        'idTurma',
        'idCurso',
    ];
}
