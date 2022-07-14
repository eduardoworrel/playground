<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PersonalizaLojaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personalizacao_loja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('informacao_loja_id');
            $table->foreign('informacao_loja_id')->references('id')->on('informacao_loja');
            
            $table->string("cor1");
            $table->string("cor2");
            $table->string("banner1");
            $table->string("banner2");
            $table->string("logo");
            $table->string("capa");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personalizacao_loja');
    }
}
