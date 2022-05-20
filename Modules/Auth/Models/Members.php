<?php
namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Auth\Models\Group_Member;

class Members extends Model
{
    use SoftDeletes;

    protected $table = 'members';
    protected $fillable = ['user_name','email','password', 'group_id'];
    protected $timestamp = true;



    public function group()
    {
        return $this->belongsTo(Members::class, 'group_id','group_id');
    }
}
