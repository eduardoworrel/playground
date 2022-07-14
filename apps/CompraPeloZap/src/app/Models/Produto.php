<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    protected $fillable = ['categoria_produtos_id', 'titulo',  'descricao',  'preco', 'ativo', 'promocao', 'mais_vendido', 'image'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaProdutos::class)->withTrashed();
    }
    public function estoque()
    {
        return $this->hasMany(Estoque::class);
    }
    public function produtoAdicionais()
    {
        return $this->hasMany(ProdutoAdicionais::class);
    }

    public function valorTotal($quantidade)
    {
        return $this->preco * $quantidade;
    }
}
