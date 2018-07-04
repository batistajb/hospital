<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaDeExamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_de_exames', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('paciente_id')->unsigned();
             $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
             $table->integer('exame_id')->unsigned();
             $table->foreign('exame_id')->references('id')->on('exames')->onDelete('cascade');
             $table->integer('tecnico_id')->unsigned();
             $table->foreign('tecnico_id')->references('id')->on('tecnicos')->onDelete('cascade');
             $table->integer('usuario_id')->unsigned();
             $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
             $table->string('data_exame',10);
             $table->string('hora_exame',10);
             $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agenda_de_exames');
    }
}
