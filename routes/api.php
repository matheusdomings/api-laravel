<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ConsProcController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PlanoSaudeController;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\ProdutosPainelController;
use App\Http\Controllers\SeguimentoProdutosPainelController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VinculoController;
use App\Models\Clientes;
use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\SeguimentoProdutosPainel;
use Illuminate\Http\Request;
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


Route::post('login', [UsuariosController::class, 'realizarLogin']);
Route::post('cadastro', [UsuariosController::class, 'realizarCadastro']);


Route::post('pacientes', [PacienteController::class, 'cadastrar']);

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::get('pacientes', [PacienteController::class, 'listar']);
    Route::get('pacientes/{id}', [PacienteController::class, 'buscarPaciente']);
    Route::put('pacientes/{id}', [PacienteController::class, 'editar']);
    Route::delete('pacientes/{id}', [PacienteController::class, 'deletar']);

    Route::post('plano-saude', [PlanoSaudeController::class, 'listar']);
    Route::get('plano-saude/{id}', [PlanoSaudeController::class, 'buscarPlanoSaude']);
    Route::put('plano-saude/{id}', [PlanoSaudeController::class, 'editar']);
    Route::delete('plano-saude/{id}', [PlanoSaudeController::class, 'deletar']);
    Route::post('plano-saude', [PlanoSaudeController::class, 'cadastrar']);

    Route::post('vinculo', [VinculoController::class, 'vinculo']);

    Route::get('medicos/listar', [MedicoController::class, 'listar']);
    Route::get('medicos/{id}', [MedicoController::class, 'buscarMedico']);
    Route::post('medicos', [MedicoController::class, 'cadastrar']);
    Route::put('medicos/{id}', [MedicoController::class, 'editar']);
    Route::delete('medicos/{id}', [MedicoController::class, 'deletar']);

    Route::post('procedimentos/listar', [ProcedimentoController::class, 'listar']);
    Route::get('procedimentos/{nome}', [ProcedimentoController::class, 'buscarProcedimento']);
    Route::post('procedimentos', [ProcedimentoController::class, 'cadastrar']);
    Route::put('procedimentos/{id}', [ProcedimentoController::class, 'editar']);
    Route::delete('procedimentos/{id}', [ProcedimentoController::class, 'deletar']);

    Route::post('consultas/listar', [ConsultaController::class, 'listar']);
    Route::get('consultas/{id}', [ConsultaController::class, 'buscarConsulta']);
    Route::put('consultas/{id}', [ConsultaController::class, 'editar']);
    Route::post('consultas', [ConsultaController::class, 'cadastrarConsulta']);
    Route::delete('consultas/{id}', [ConsultaController::class, 'deletar']);

    Route::post('consultas/marcar', [ConsProcController::class, 'marcarConsulta']);

    Route::get('especialidades/listar', [EspecialidadeController::class, 'listar']);
    Route::get('especialidades/{id}', [EspecialidadeController::class, 'buscarEspecialidade']);
    Route::post('especialidades', [EspecialidadeController::class, 'cadastrar']);
    Route::put('especialidades/{id}', [EspecialidadeController::class, 'editar']);
    Route::delete('especialidades/{id}', [EspecialidadeController::class, 'deletar']);
});