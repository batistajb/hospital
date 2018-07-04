<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $fillable = ['nome'];
    
      public function tecnicosExame() {
        return $this->hasMany(AgendaDeExames::class);
    }
}

