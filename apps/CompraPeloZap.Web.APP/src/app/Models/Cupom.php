<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cupom extends Model
{
	use SoftDeletes;

	protected $fillable = ['codigo','informacao_loja_id', 'datahora_inicio_validade', 'datahora_fim_validade', 'valor'];
	protected $table = 'cupom';
    public function pedido()
    {
    	return $this->hasMany(Pedido::class);
    }
    public function informacaoLoja()
    {
    	return $this->belongsTo(informacaoLoja::class);
    }
}
