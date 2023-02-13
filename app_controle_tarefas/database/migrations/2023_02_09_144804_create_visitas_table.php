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
            $table->bigInteger('requesterId');
            $table->string('status')->default('pending');
            $table->string('spaceName');
            $table->bigInteger('spaceCode');
            $table->string('day');
            $table->string('hour');
            $table->bigInteger('peopleNumber');
            $table->string('name');
            $table->string('grade');
            $table->bigInteger('age');
            $table->boolean('pcd')->default(false);
            $table->string('pcdType');
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