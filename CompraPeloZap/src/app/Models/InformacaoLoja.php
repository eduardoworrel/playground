<?php

namespace App\Models;

use  App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformacaoLoja extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'titulo', 'subtitulo', 'contato_loja', 'endereco','aberto'];
    protected $table = 'informacao_loja';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categoriaProdutos()
    {
        return $this->hasMany(CategoriaProdutos::class);
    }
    public function cupom()
    {
        return $this->hasMany(Cupom::class);
    }
    public function formaPagamento()
    {
        return $this->hasMany(FormaPagamento::class);
    }
    public function formaEntrega()
    {
        return $this->hasMany(FormaEntrega::class);
    }
    public function pedido()
    {
        return $this->hasMany(Pedido::class);
    }
    public function personalizacaoLoja()
    {
    	return $this->hasOne(PersonalizacaoLoja::class);
    }
}

