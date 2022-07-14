<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estoque extends Model
{
	use SoftDeletes;

	protected $fillable = ['produto_id','quantidade'];
	
    public function produtos()
    {
    	return $this->belongsTo(Produto::class);
    }
}
