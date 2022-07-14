<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaisVendidos extends Model
{
	use SoftDeletes;

	protected $fillable = ['produto_id'];
	
    public function produtos()
    {
    	return $this->belongsTo(Produto::class);
    }
}
