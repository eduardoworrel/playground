<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
	use SoftDeletes;

	protected $fillable = ['cep', 'numero', 'rua', 'bairro', 'cidade', 'estado', 'complemento', 'user_id'];
	
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function pedido()
    {
    	return $this->belongsTo(Pedido::class);
    }
}
