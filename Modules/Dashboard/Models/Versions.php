<?php
namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Versions extends Model
{
    use SoftDeletes;
    protected $table = 'versions';
    protected $timestamp = true;
    protected $fillable = ['product_id','desc','type', 'url','icon'];

    public function products()
    {
        return $this->belongsTo('Modules\Dashboard\Models\Product','product_id','product_id');
    }
}
