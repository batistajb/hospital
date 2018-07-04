<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    protected $fillable = ['nome','numvagas'];
    
  public function exames() {
        return $this->hasMany(AgendaDeExames::class);
    }
}
