<?php

namespace App\Http\Controllers;

use App\Models\Vinculo;
use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\PlanoSaude;
use Illuminate\Http\Request;
use App\Models\ConsultaMarcadas;
use App\Http\Requests\PacienteValidation;
use App\Http\Requests\PacientePaginacaoValidation;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    public function listar()
    {
        $pacientes = Paciente::all();
        foreach ($pacientes as $paciente) {
            $vinculo = Vinculo::where('paciente_id', $paciente->id)->first();
            if ($vinculo) {
                $paciente->vinculo_codigo = $vinculo->id;
            }
        }

        return response($pacientes, 200);
    }

    public function cadastrar(PacienteValidation $request)
    {
        $paciente = Paciente::create([
            'pac_codigo' => mt_rand(0, 10000),
            'pac_nome' => $request->pac_nome,
            'pac_dt_nascimento' => $request->pac_dt_nascimento,
            'pac_telefone' => $request->pac_telefone
        ]);

        if ($request->plano_saude) {
            Vinculo::create([
                'paciente_id' => $paciente->id,
                'plano_saude_id' => $request->plano_saude,
                'nr_contrato' => mt_rand(0, 100000)
            ]);
        }

        return response(['paciente' => $paciente], 201);
    }

    public function buscarPaciente($id)
    {

        $paciente = Paciente::where('id', $id)->first();
        $vinculo = Vinculo::where('paciente_id', $paciente->id)->first();
        if ($vinculo) {
            $paciente->plano_codigo = $vinculo->plano_saude_id;
        }

        if (!$paciente) {
            return response(['status' => 'Paciente não encontrado.'], 404);
        }

        return response($paciente, 200);
    }

    public function editar(Request $request, $id)
    {

        $paciente = Paciente::where('id', $id)->first();
        if (!$paciente) {
            return response(['status' => 'Paciente não encontrado.'], 404);
        }

        $paciente->update([
            'pac_nome' => $request->pac_nome ? $request->pac_nome : $paciente->pac_nome,
            'pac_telefone' => $request->pac_telefone ?  $request->pac_telefone :  $paciente->pac_telefone,
            'pac_dt_nascimento' => $request->pac_dt_nascimento ?  $request->pac_dt_nascimento :  $paciente->pac_dt_nascimento
        ]);

        if ($request->plano_saude) {
            $vinculo = Vinculo::where('paciente_id', $id)->first();
            if ($vinculo) {
                $vinculo->update([
                    'paciente_id' => $paciente->id,
                    'plano_saude_id' => $request->plano_saude,
                    'nr_contrato' => $vinculo->nr_contrato
                ]);
            } else {
                Vinculo::create([
                    'paciente_id' => $paciente->id,
                    'plano_saude_id' => $request->plano_saude,
                    'nr_contrato' => mt_rand(0, 100000)
                ]);
            }
        }

        return response($paciente, 200);
    }

    public function deletar($id)
    {
        $paciente =  Paciente::where('id', $id)->first();
        if (!$paciente) {
            return response(['status' => 'Paciente não encontrado nos registros.'], 404);
        }
        $paciente->delete();

        return response(['status' => 'Paciente excluído com sucesso.'], 200);
    }
}
