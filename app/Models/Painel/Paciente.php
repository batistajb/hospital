<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['nome', 'datanasc','sexo', 'CNS', 'endereco',
        'bairro','municipio','contato'
    ];
    
    protected $dates = ['datanasc'];
 
 
    public function pacientesExame() {
        return $this->hasMany(AgendaDeExames::class);
    }
    
      public function pacientesConsulta() {
        return $this->hasMany(AgendaDeConsultas::class);
    }
}
