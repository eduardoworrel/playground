<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produtosPedido extends Model
{
	use SoftDeletes;

	protected $fillable = ['pedido_id', 'produto_id','quantidade'];
	protected $table = 'pedido_produtos';
    public function produto()
    {
    	return $this->belongsTo(Produto::class)->withTrashed();
    }
    public function pedido()
    {
    	return $this->belongsTo(Pedido::class);
    }
    public function pedidoProdutoAdicionais(){
        $this->hasMany(PedidoProdutoAdicionais::class);
    }
}
