<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormaPagamento extends Model
{
	use SoftDeletes;

	protected $fillable = ['titulo','informacao_loja_id'];
	protected $table = 'forma_pagamento';

    public function pedido()
    {
    	return $this->hasMany(Pedido::class);
    }
    public function informacaoLoja()
    {
    	return $this->belongsTo(InformacaoLoja::class);
    }
}
