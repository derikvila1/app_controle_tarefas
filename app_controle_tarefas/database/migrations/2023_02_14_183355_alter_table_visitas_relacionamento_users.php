<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVisitasRelacionamentoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitas', function(Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitas', function(Blueprint $table) {
            $table->dropForeign('visitas_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}