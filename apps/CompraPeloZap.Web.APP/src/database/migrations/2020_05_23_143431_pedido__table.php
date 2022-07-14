<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            //$table->unsignedBigInteger('endereco_id');
            //$table->foreign('endereco_id')->references('id')->on('enderecos');

            $table->unsignedBigInteger('cupom_id')->nullable();
            $table->foreign('cupom_id')->references('id')->on('cupom')->nullable();

            $table->unsignedBigInteger('forma_pagamento_id');
            $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamento');

            $table->unsignedBigInteger('forma_entrega_id');
            $table->foreign('forma_entrega_id')->references('id')->on('forma_entrega');

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
        Schema::dropIfExists('pedido');
    }
}
