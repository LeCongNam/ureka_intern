<?php

namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $table = 'products';
    protected $fillable = ['product_id','product_name'];
    protected $timestamp = true;
    
    public function versions()
    {
        return $this->hasMany('Modules\Dashboard\Models\Versions','product_id','product_id');
    }
}
