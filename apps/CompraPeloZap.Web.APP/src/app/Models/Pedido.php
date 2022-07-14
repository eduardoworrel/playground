<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Pedido extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'user_id',
        'endereco_id',
        'endereco',
        'observacao',
        'status',
        'informacao_loja_id',
        'forma_pagamento_id',
        'forma_entrega_id',
        'cupom_id'
    ];
	protected $table ='pedido';
    public function user()
    {
    	return $this->belongsTo(User::class)->withTrashed();
    }
    public function endereco()
    {
    	return $this->belongsTo(Endereco::class)->withTrashed();
    }
    public function formaPagamento()
    {
    	return $this->belongsTo(FormaPagamento::class)->withTrashed();
    }
    public function formaEntrega()
    {
    	return $this->belongsTo(FormaEntrega::class)->withTrashed();
    }
    public function cupom()
    {
    	return $this->belongsTo(Cupom::class)->withTrashed();
    }
    public function produtosPedido()
    {
    	return $this->hasMany(produtosPedido::class)->withTrashed();
    }
    public function informacaoLoja()
    {
    	return $this->belongsTo(informacaoLoja::class)->withTrashed();
    }
}
