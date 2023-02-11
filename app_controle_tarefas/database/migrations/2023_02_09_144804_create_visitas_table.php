<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('day');
            $table->bigInteger('participantes');
            $table->string('name');
            $table->string('série');
            $table->bigInteger('idade');
            $table->boolean('confirmed')->nullable();
            $table->bigInteger('solicitante');
            $table->bigInteger('spaceCode')->nullable();
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
        Schema::dropIfExists('visitas');
    }
}
