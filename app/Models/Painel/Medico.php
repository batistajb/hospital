<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = ['nome'];

    public function especialidades(){
          return $this->belongsToMany(Especialidade::class, 'EspecialidadesMedicos'); 
    }
     
    public function medicosConsulta() {
    return $this->hasMany(AgendaDeConsultas::class);
    }
}
 