<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class ExameFormRequest extends FormRequest
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
     
        'nome' => 'required|min:3|max:100',
        'numvagas' =>  'required'  
        ];
    }
    public function messages() {
        return [
            
           'nome.required' => 'O campo "Nome de Exame" é de preenchimento obrigatório',
           'nome.min' => 'O campo "Nome do Exame" precisa de no mínimo 3 caracters',
           'numvagas.required' => 'O campo "Quantidade de vagas por dia" é de preenchimento obrigatório' 

        ];
    }
}
