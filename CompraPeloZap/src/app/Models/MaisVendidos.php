<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaisVendidos extends Model
{
	use SoftDeletes;
    //SELECT *, (SELECT COUNT(produto_id) FROM promocao pm WHERE pm.produto_id = p.id ) as PROMOCAO, (SELECT COUNT(produto_id) FROM mais_vendidos mv WHERE mv.produto_id = p.id) AS MAIS_VENDIDOS FROM produtos p
	protected $fillable = ['produto_id'];

    public function produtos()
    {
    	return $this->belongsTo(Produto::class);
    }
}
