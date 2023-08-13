<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;
    protected $table = 'turmas';
    public $timestamps = false;

    protected $fillable = [
        'turma',
        'numeroAlunos',
        'idMateria',
        'idCurso',
    ];
}
