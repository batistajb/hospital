<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class EspecialidadesMedicos extends Model
{
    protected $fillable = ['medico_id','especialidade_id'];
    

    public function medico(){
       return $this->belongsTo(Medico::class, 'EspecialidadesMedicos');
    }
    
    public function especialidade(){
       return $this->belongsTo(Especialidade::class, 'EspecialidadesMedicos');
    }

}