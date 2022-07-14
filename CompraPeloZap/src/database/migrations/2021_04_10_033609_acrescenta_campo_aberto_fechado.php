<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcrescentaCampoAbertoFechado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informacao_loja', function (Blueprint $table) {
            $table->integer("aberto");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informacao_loja', function (Blueprint $table) {
            $table->dropColumn("aberto");
        });
    }
}
