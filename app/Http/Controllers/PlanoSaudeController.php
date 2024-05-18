<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanosaudeValidation;
use App\Models\PlanoSaude;
use Illuminate\Http\Request;

class PlanoSaudeController extends Controller
{
    public function listar()
    {
        $Planos = PlanoSaude::all();
        return response($Planos, 200);
    }

    public function cadastrar(PlanoSaudeValidation $request)
    {
        $PlanoSaude = PlanoSaude::create([
            'plano_descricao' => $request->plano_descricao,
            'plano_telefone' => $request->plano_telefone,
            'plano_codigo' => mt_rand(0, 10000)
        ]);

        return response(['PlanoSaude' => $PlanoSaude], 201);
    }

    public function buscarPlanoSaude($id)
    {

        $PlanoSaude = PlanoSaude::where('id', $id)->first();

        if (!$PlanoSaude) {
            return response(['status' => 'Plano de saúde não encontrado!'], 404);
        }

        return response($PlanoSaude, 200);
    }

    public function editar(Request $request, $id)
    {

        $PlanoSaude = PlanoSaude::where('id', $id)->first();
        if (!$PlanoSaude) {
            return response(['status' => 'Plano de saúde não encontrado!'], 404);
        }

        $PlanoSaude->update([
            'plano_descricao' => $request->plano_descricao ? $request->plano_descricao : $PlanoSaude->plano_descricao,
            'plano_telefone' => $request->plano_telefone ?  $request->plano_telefone :  $PlanoSaude->plano_telefone,
        ]);

        return response($PlanoSaude, 200);
    }

    public function deletar($id)
    {
        $PlanoSaude =  PlanoSaude::where('id', $id)->first();

        if (!$PlanoSaude) {
            return response(['status' => 'Plano de saúde não encontrado!'], 404);
        }
        $PlanoSaude->delete();

        return response(['status' => 'Plano de saúde deletado com sucesso.'], 200);
    }
}
