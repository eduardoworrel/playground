<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoAdicionais extends Model
{
    use SoftDeletes;
    protected $table = 'produtoAdicionais';
    public $timestamps = false;
    protected $fillable = ['produtos_id', 'nome',  'valor',  'tipo'];

    public function produto()
    {
        return $this->belongsTo(Produto::class)->withTrashed();
    }
}
