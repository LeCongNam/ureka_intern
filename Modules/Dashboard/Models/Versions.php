<?php
namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

class Versions extends Model
{
    protected $table = 'versions';
    protected $timestamp = true;
    protected $fillable = ['product_id','product_name','desc','product_type', 'url','icon'];

    public function products()
    {
        return $this->belongsTo('Product');
    }
}
