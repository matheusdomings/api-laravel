<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanosaudeValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
         'plano_descricao' => 'required|unique:plano_saudes',
         'plano_telefone' => 'required|unique:plano_saudes',
        ];
    }

    public function messages()
    {
        return [
            'plano_descricao.required' => 'Campo obrigátorio.',
            'plano_descricao.unique' => 'Já existe um plano_descricao com esse nome',
            'plano_telefone.unique' => 'Já existe um plano_telefone com esse telefone',
        ];
    }
}
