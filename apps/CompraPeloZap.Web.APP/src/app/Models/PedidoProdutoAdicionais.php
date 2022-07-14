<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoProdutoAdicionais extends Model

{
    //use SoftDeletes;
    public $timestamps = false;
    protected $table = 'pedidoProdutoAdicionais';
    protected $fillable = ['pedido_produtos_id', 'produtoAdicionais_id','quantidade'];

    public function PedidoProduto()
    {
        return $this->belongsTo(PedidoProduto::class)->withTrashed();
    }

    public function ProdutoAdicionais()
    {
        return $this->hasMany(ProdutoAdicionais::class)->withTrashed();
    }

}
