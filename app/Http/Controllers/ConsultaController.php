<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultaMarcarValidation;
use App\Http\Requests\ConsultaValidation;
use App\Http\Requests\PacientePaginacaoValidation;
use App\Models\Cons_proc;
use App\Models\Consulta;
use App\Models\ConsultaMarcadas;
use App\Models\ConsultaProcedimento;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Procedimento;
use App\Models\Vinculo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{

    public function listar()
    {
        $consultas = Consulta::with('medico', 'vinculo', 'paciente', 'procedimento')->get();
        return response($consultas, 200);
    }

    public function cadastrarConsulta(ConsultaValidation $request)
    {

        $consulta = Consulta::create([
            'cons_codigo' => mt_rand(0, 10000),
            'med_id' => $request->cons_med,
            'pac_id' => $request->cons_pac,
            'data' => $request->data,
            'hora' => $request->hora,
            'vinculo_id' => $request->vinculo_id,
            'particular' => $request->particular,
        ]);

        if ($request->procedimento) {
            ConsultaProcedimento::create([
                'cons_id' => $consulta->id,
                'proc_id' => $request->procedimento
            ]);
        }
        try {
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1452) {
                // Lidar com a violação de chave estrangeira
                return response(['status' => 'Não foi possível adicionar o vínculo devido a uma violação de chave estrangeira.'], 422);
            }

            // Lidar com outros erros ou retornar uma resposta genérica
            return response(['status' => 'Ocorreu um erro durante a criação do vínculo.'], 500);
        }

        return response($consulta, 201);
    }


    public function buscarConsulta($id)
    {

        $consulta = Consulta::where('id', $id)->with('medico', 'vinculo', 'paciente', 'procedimento')->first();

        if (!$consulta) {
            return response(['status' => 'Consulta não encontrado.'], 404);
        }

        return response($consulta, 200);
    }


    public function editar(Request $request, $id)
    {
        $consulta = Consulta::where('id', $id)->first();

        if (!$consulta) {
            return response(['status' => 'Especialidade não encontrado.'], 404);
        }

        $consulta->update([
            'data' => $request->data ? $request->data : $consulta->data,
            'hora' => $request->hora ? $request->hora : $consulta->hora,
            'med_id' => $request->cons_med ? $request->cons_med : $consulta->med_id,
            'pac_id' => $request->cons_pac ? $request->cons_pac : $consulta->pac_id,
            'vinculo_id' => $request->vinculo_id ? $request->vinculo_id : $consulta->vinculo_id,
            'particular' => $request->particular ? $request->particular : $consulta->particular,
        ]);

        ConsultaProcedimento::where('cons_id', $id)->update(['proc_id' => $request->procedimento]);

        return response($consulta, 200);
    }


    public function deletar($id)
    {
        $consulta = Consulta::find($id);
        if (!$consulta) {
            return response(['status' => 'Consulta não encontrado nos registros.'], 404);
        }

        $consulta->delete();

        return response(['status' => 'Especialidade deletado com sucesso.'], 200);
    }
}
