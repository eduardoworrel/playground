<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoriaProdutos extends Model
{
    use SoftDeletes;

    public $timestamps = true;

	protected $fillable = ['informacao_loja_id','titulo'];

    public function produtos()
    {
    	return $this->hasMany(Produto::class)->withTrashed();
    }
    public function informacaoLoja()
    {
    	return $this->belongsTo(informacaoLoja::class);
    }
}
