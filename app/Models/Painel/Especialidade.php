<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model {

    protected $fillable = ['nome','numvagas'];

    public function medico() {
        return $this->belongsToMany(Medico::class, 'EspecialidadesMedicos');
    }

}
