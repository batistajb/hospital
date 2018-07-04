<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class AgendaDeConsultasFormRequest extends FormRequest
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
     
        'paciente_id'     =>'required',
        'medico_id'       =>'required',
        'data_consulta'   =>'required|max:10',
        'hora_consulta'   =>'required|max:5',
        'especialidade_id'=>'required'   
        ];
    }
    public function messages() {
        return [
           'medico_id.required'     =>'O campo "Nome do Médico" é de preenchimento obrigatório',
           'paciente_id.required'   =>'O campo "Nome do Paciente" é de preenchimento obrigatório',
           'data_consulta.required' =>'O campo "Data da Consulta" é de preenchimento obrigatório',
           'data_consulta.max'      =>'O campo "Data da Consulta" só pode conter no máximo 8 caracteres',
           'hora_consulta.required' =>'O campo "Hora da consulta" é de preenchimento obrigatório!',
           'hora_consulta.max'      =>'O campo "Hora da consulta" só pode conter no máximo 4 caracteres',
           'especialidade_id.required' =>'O campo "Nome da Especialidade" é de preenchimento obrigatório!'
        ];
    }
}
