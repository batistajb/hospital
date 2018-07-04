<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class AgendaDeConsultas extends Model {

     protected $fillable = ['paciente_id','medico_id','usuario_id','especialidade_id','data_consulta','hora_consulta'];
    
    
     
    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    public function medico() {
        return $this->belongsTo(Medico::class);
    }

    public function usuario() {
        return $this->belongsTo(User::class);
    }

}
