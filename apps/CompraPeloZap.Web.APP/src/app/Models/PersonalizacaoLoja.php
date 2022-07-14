<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalizacaoLoja extends Model
{
	use SoftDeletes;

    protected $table = 'personalizacao_loja';
	protected $fillable = ['informacao_loja_id', 'cor1', 'cor2','banner1','banner2', 'logo', 'capa'];
	

    public function informacaoLoja()
    {
    	return $this->belongsTo(informacaoLoja::class);
    }
}
