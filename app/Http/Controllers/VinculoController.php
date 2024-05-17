<?php

namespace App\Http\Controllers;

use App\Models\Vinculo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VinculoController extends Controller
{
    public function vinculo(Request $request)
    {

        try {
            $vinculo = Vinculo::create([
                'paciente_id' => $request->paciente_id,
                'plano_saude_id' => $request->plano_saude_id,
                'nr_contrato' => $request->nr_contrato,
            ]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1452) {
                // Lidar com a violação de chave estrangeira
                return response(['status' => 'Não foi possível adicionar o vínculo devido a uma violação de chave estrangeira.'], 422);
            }

            // Lidar com outros erros ou retornar uma resposta genérica
            return response(['status' => 'Ocorreu um erro durante a criação do vínculo.'], 500);
        }

        return response($vinculo, 201);
    }
}
