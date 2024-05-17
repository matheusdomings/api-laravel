<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicoValidation extends FormRequest
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
         'med_nome' => 'required',
         'med_crm' => 'required|unique:medico,med_crm',
         'med_espec' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'med_nome.required' => 'Campo obrigátorio.',
            'med_crm.required' => 'Campo obrigátorio.',
            'med_crm.unique' => 'Médico com esse CRM já existe.',
            'med_espec.required' => 'Campo obrigátorio.',
        ];
    }
}
