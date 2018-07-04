<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class TecnicoFormRequest extends FormRequest
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
     
        'nome' => 'required|min:3|max:30',
      
        ];
    }
    public function messages() {
        return [
            
           'nome.required' => 'O campo "Nome do Técnico" é de preenchimento obrigatório!',
           'nome.min' => 'O campo "Nome do Técnico" tem que conter no mínimo 3 caracters',
           'nome.max'  => 'O campo "Nome do Técnico" tem que conter no máximo 30 caracters'
         ];
    }
}
