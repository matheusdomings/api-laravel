<?php

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PlanoSaudeController;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

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


Route::post('cadastro', [UsuariosController::class, 'realizarCadastro']);
Route::post('login', [UsuariosController::class, 'realizarLogin']);


Route::group(['middleware' => ['jwt.verify']], function () {

    Route::get('pacientes', [PacienteController::class, 'listar']);
    Route::post('pacientes', [PacienteController::class, 'cadastrar']);
    Route::get('pacientes/{id}', [PacienteController::class, 'buscarPaciente']);
    Route::put('pacientes/{id}', [PacienteController::class, 'editar']);
    Route::delete('pacientes/{id}', [PacienteController::class, 'deletar']);

    Route::get('plano-saude', [PlanoSaudeController::class, 'listar']);
    Route::get('plano-saude/{id}', [PlanoSaudeController::class, 'buscarPlanoSaude']);
    Route::put('plano-saude/{id}', [PlanoSaudeController::class, 'editar']);
    Route::delete('plano-saude/{id}', [PlanoSaudeController::class, 'deletar']);
    Route::post('plano-saude', [PlanoSaudeController::class, 'cadastrar']);

    Route::get('medicos', [MedicoController::class, 'listar']);
    Route::get('medicos/{id}', [MedicoController::class, 'buscarMedico']);
    Route::post('medicos', [MedicoController::class, 'cadastrar']);
    Route::put('medicos/{id}', [MedicoController::class, 'editar']);
    Route::delete('medicos/{id}', [MedicoController::class, 'deletar']);

    Route::get('procedimentos', [ProcedimentoController::class, 'listar']);
    Route::get('procedimentos/{nome}', [ProcedimentoController::class, 'buscarProcedimento']);
    Route::post('procedimentos', [ProcedimentoController::class, 'cadastrar']);
    Route::put('procedimentos/{id}', [ProcedimentoController::class, 'editar']);
    Route::delete('procedimentos/{id}', [ProcedimentoController::class, 'deletar']);

    Route::get('consultas', [ConsultaController::class, 'listar']);
    Route::get('consultas/{id}', [ConsultaController::class, 'buscarConsulta']);
    Route::put('consultas/{id}', [ConsultaController::class, 'editar']);
    Route::post('consultas', [ConsultaController::class, 'cadastrarConsulta']);
    Route::delete('consultas/{id}', [ConsultaController::class, 'deletar']);

    Route::get('especialidades', [EspecialidadeController::class, 'listar']);
    Route::get('especialidades/{id}', [EspecialidadeController::class, 'buscarEspecialidade']);
    Route::post('especialidades', [EspecialidadeController::class, 'cadastrar']);
    Route::put('especialidades/{id}', [EspecialidadeController::class, 'editar']);
    Route::delete('especialidades/{id}', [EspecialidadeController::class, 'deletar']);
});
