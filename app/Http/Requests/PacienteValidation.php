<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteValidation extends FormRequest
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
         'pac_nome' => 'required',
         'pac_telefone' => 'required|unique:paciente',
         'pac_dt_nascimento' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pac_nome.required' => 'Campo obrigátorio.',
            'pac_dt_nascimento.required' => 'Campo obrigátorio.',

        ];
    }
}
