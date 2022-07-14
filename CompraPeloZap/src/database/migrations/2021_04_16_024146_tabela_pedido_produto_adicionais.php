<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelaPedidoProdutoAdicionais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidoProdutoAdicionais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_produtos_id');
            $table->foreign('pedido_produtos_id')->references('id')->on('pedido_produtos');
            $table->unsignedBigInteger('produtoAdicionais_id');
            $table->foreign('produtoAdicionais_id')->references('id')->on('produtoAdicionais');
            $table->integer('quantidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidoProdutoAdicionais');
    }
}
