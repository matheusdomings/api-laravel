<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoValidation;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{

    public function listar()
    {
        $medicos = Medico::with('especialidade')->get();
        return response($medicos, 200);
    }

    public function cadastrar(MedicoValidation $request)
    {

        $medico = Medico::create([
            'med_nome' => $request->med_nome,
            'med_crm' => $request->med_crm,
            'med_codigo' => mt_rand(0, 10000),
            'espec_id' => $request->med_espec,
        ]);

        if (!$medico) {
            return response(['error' => 'Especialidade não existe'], 403);
        }

        return response(['medico' => $medico], 201);
    }

    public function buscarMedico($id)
    {

        $medico = Medico::with('especialidade')->where('id', $id)->first();

        if (!$medico) {
            return response(['status' => 'Médico não encontrado.'], 404);
        }

        return response($medico, 200);
    }

    public function editar(Request $request, $id)
    {
        $medico = Medico::where('id', $id)->first();

        if (!$medico) {
            return response(['status' => 'Médico não encontrado.'], 404);
        }

        $medico->update([
            'med_nome' => !empty($request->med_nome)? $request->med_nome : $medico->med_nome,
            'med_crm' => !empty($request->med_crm)?  $request->med_crm : $medico->med_crm,
            'med_espec' => !empty($request->med_espec)?  $request->med_espec : $medico->med_espec
        ]);

        return response($medico, 200);
    }

    public function deletar($id)
    {
        $medico =  Medico::where('id', $id)->first();
        if (!$medico) {
            return response(['status' => 'Médico não encontrado nos registros.'], 404);
        }

        $medico->delete();

        return response(['status' => 'Médico deletado com sucesso.'], 200);
    }
}
