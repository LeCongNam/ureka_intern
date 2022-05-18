<?php

namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_id','product_name'];
    protected $timestamp = true;
    
    public function versions()
    {
        return $this->hasMany('Version','product_id','product_id');
    }
}
