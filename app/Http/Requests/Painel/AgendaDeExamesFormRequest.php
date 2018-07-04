<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class AgendaDeExamesFormRequest extends FormRequest
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
     
        'paciente_id' => 'required',
        'data_exame' =>  'required|max:10',
        'hora_exame' =>  'required',
        'exame_id'   =>  'required',
        'tecnico_id' =>  'required'
        ];
    }
    public function messages() {
        return [
           'hora_exame.required'=>'O campo "Hora do Exame" é de preenchimento obrigatório!', 
           'paciente_id.required' => 'O campo "Nome do Paciente" é de preenchimento obrigatório!',  
           'data_exame.required' =>'O campo "Data do Exame" é de preenchimento obrigatório!',
           'data_exame.max'=>'O campo "Data do Exame" só pode conter no máximo 8 caracters!',
           'exame_id.required'=>'O campo "Nome do Exame" é de preenchimento obrigatório',
           'tecnico_id.required'=>'O campo "Nome do Técnico" é de preenchimento obrigatório',
        ];
    }
}
