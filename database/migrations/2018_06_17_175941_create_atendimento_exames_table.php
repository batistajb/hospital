<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtendimentoExamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimento_exames', function (Blueprint $table) {
            $table->increments('id');
            $table ->string('pessimo',10)->nullable();
            $table ->string('ruim',10)->nullable();
            $table ->string('regular',10)->nullable();
            $table ->string('bom',10)->nullable();
            $table ->string('otimo',10)->nullable();
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
        Schema::dropIfExists('atendimento_exames');
    }
}
