<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AtualizaComIdLojaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categoria_produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('informacao_loja_id')->after("id");
            $table->foreign('informacao_loja_id')->references('id')->on('informacao_loja');
        });

        Schema::table('forma_pagamento', function (Blueprint $table) {
            $table->unsignedBigInteger('informacao_loja_id')->after("id");
            $table->foreign('informacao_loja_id')->references('id')->on('informacao_loja');
        });

        Schema::table('forma_entrega', function (Blueprint $table) {
            $table->unsignedBigInteger('informacao_loja_id')->after("id");
            $table->foreign('informacao_loja_id')->references('id')->on('informacao_loja');
        });
        
        Schema::table('pedido', function (Blueprint $table) {
            $table->unsignedBigInteger('informacao_loja_id')->after("id");
            $table->foreign('informacao_loja_id')->references('id')->on('informacao_loja');
        });

        Schema::table('cupom', function (Blueprint $table) {
            $table->unsignedBigInteger('informacao_loja_id')->after("id");
            $table->foreign('informacao_loja_id')->references('id')->on('informacao_loja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categorias_produto', function (Blueprint $table) {
            //
        });
    }
}
