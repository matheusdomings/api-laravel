<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspecialidadeValidation;
use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    public function listar()
    {
        $especialidade = Especialidade::all();
        return response($especialidade, 200);
    }

    public function cadastrar(EspecialidadeValidation $request)
    {

        $especialidade = Especialidade::create(['espec_codigo' => mt_rand(0, 10000), 'espec_nome' => $request->espec_nome]);

        return response(['especialidade' =>  $especialidade], 201);
    }


    public function buscarEspecialidade($id)
    {

        $especialidade = Especialidade::where('id', $id)->first();

        if (!$especialidade) {
            return response(['status' => 'Especialidade não encontrado.'], 404);
        }

        return response($especialidade, 200);
    }

    public function editar(Request $request, $id)
    {
        $especialidade = Especialidade::where('id', $id)->first();

        if (!$especialidade) {
            return response(['status' => 'Especialidade não encontrado.'], 404);
        }

        $especialidade->update([
            'espec_nome' => $request->espec_nome ? $request->espec_nome : $especialidade->espec_nome,
        ]);

        return response($especialidade, 200);
    }

    public function deletar($id)
    {
        $especialidade =  Especialidade::where('id', $id)->first();
        if (!$especialidade) {
            return response(['status' => 'Especialidade não encontrado nos registros.'], 404);
        }

        $especialidade->delete();

        return response(['status' => 'Especialidade deletado com sucesso.'], 200);
    }
}
