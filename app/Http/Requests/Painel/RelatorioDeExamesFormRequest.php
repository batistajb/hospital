<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class RelatorioDeExamesFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [      
        'dataum'    => 'required',
        'datadois'  => 'required',
 
        ];
    }
    public function messages() {
        return [
            
           'dataum.required' => 'Preencha Todos os campos de data!',
           'datadois.required' => 'Preencha Todos os campos de data!',
        ];
    }
}
