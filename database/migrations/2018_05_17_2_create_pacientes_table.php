<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('pacientes', function (Blueprint $table) {
           
            $table->increments('id');
            $table->string('nome',150);
            $table->string('datanasc',50);
            $table->enum('sexo',['Masculino','Feminino']); 
            $table->string('CNS',20);
            $table->string('endereco',150);
            $table->string('bairro',50);
            $table->string('municipio',50);
            $table->string('contato', 50);  
            $table->timestamps();
                        
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
