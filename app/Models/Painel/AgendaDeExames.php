<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class AgendaDeExames extends Model {

     protected $fillable = ['paciente_id','exame_id','tecnico_id','usuario_id','data_exame','hora_exame'];
    
     
    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    public function exame() {
        return $this->belongsTo(Exame::class);
    }

    public function tecnico() {
        return $this->belongsTo(Tecnico::class);
    }

    public function usuario() {
        return $this->belongsTo(User::class);
    }

}
