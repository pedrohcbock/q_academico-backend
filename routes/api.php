<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\MateriaisController;
use App\Http\Controllers\NotasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'alunos'], function () {
    Route::get('/', [AlunosController::class, 'index']);
    Route::get('/{aluno}', [AlunosController::class, 'show']);
    Route::post('/', [AlunosController::class, 'create']);
    Route::put('/{aluno}', [AlunosController::class, 'update']);
    Route::put('/{aluno}/change-password', [AlunosController::class, 'changePassword']);
    Route::delete('/{aluno}', [AlunosController::class, 'delete']);
});

Route::group(['prefix' => 'admins'], function () {
    Route::get('/', [AdminsController::class, 'index']);
    Route::get('/{admin}', [AdminsController::class, 'show']);
    Route::post('/', [AdminsController::class, 'create']);
    Route::put('/{admin}', [AdminsController::class, 'update']);
    Route::put('/{admin}/change-password', [AdminsController::class, 'changePassword']);
    Route::delete('/{admin}', [AdminsController::class, 'delete']);
});

Route::group(['prefix' => 'professores'], function () {
    Route::get('/', [ProfessoresController::class, 'index']);
    Route::get('/{professor}', [ProfessoresController::class, 'show']);
    Route::post('/', [ProfessoresController::class, 'create']);
    Route::put('/{professor}', [ProfessoresController::class, 'update']);
    Route::put('/{professor}/change-password', [ProfessoresController::class, 'changePassword']);
    Route::delete('/{professor}', [ProfessoresController::class, 'delete']);
});

Route::group(['prefix' => 'cursos'], function () {
    Route::get('/', [CursosController::class, 'index']);
    Route::get('/{curso}', [CursosController::class, 'show']);
    Route::post('/', [CursosController::class, 'create']);
    Route::put('/{curso}', [CursosController::class, 'update']);
    Route::delete('/{curso}', [CursosController::class, 'delete']);
});

Route::group(['prefix' => 'documentos'], function () {
    Route::post('/', [DocumentosController::class, 'create']);
    Route::get('/', [DocumentosController::class, 'index']);
    Route::get('/download/{id}', [DocumentosController::class, 'download']);
    Route::get('/filter', [DocumentosController::class, 'filter']);
});

Route::group(['prefix' => 'turmas'], function () {
    Route::get('/', [TurmasController::class, 'index']);
    Route::get('/{curso}', [TurmasController::class, 'show']);
    Route::post('/', [TurmasController::class, 'create']);
    Route::put('/{curso}', [TurmasController::class, 'update']);
    Route::delete('/{curso}', [TurmasController::class, 'delete']);
});

Route::group(['prefix' => 'materias'], function () {
    Route::get('/', [MateriasController::class, 'index']);
    Route::get('/{materia}', [MateriasController::class, 'show']);
    Route::post('/', [MateriasController::class, 'create']);
    Route::put('/{materia}', [MateriasController::class, 'update']);
    Route::delete('/{materia}', [MateriasController::class, 'delete']);
});

Route::group(['prefix' => 'materiais'], function () {
    Route::post('/', [MateriaisController::class, 'create']);
    Route::get('/', [MateriaisController::class, 'index']);
    Route::get('/download/{id}', [MateriaisController::class, 'download']);
    Route::get('/filter', [MateriaisController::class, 'filter']);
});

Route::group(['prefix' => 'notas'], function () {
    Route::get('/{nota}', [NotasController::class, 'show']);
    Route::post('/', [NotasController::class, 'create']);
    Route::put('/{nota}', [NotasController::class, 'update']);
    Route::delete('/{curso}', [NotasController::class, 'delete']);
});
