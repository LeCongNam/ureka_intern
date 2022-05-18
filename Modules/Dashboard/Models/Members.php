<?php
namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Members extends Model
{
    protected $table = 'members';
    protected $fillable = ['user_name','email','password', 'group_id'];
    protected $timestamp = true;

   
    
    public function group()
    {
        return $this->belongsTo('Group_Member');
    }
}
