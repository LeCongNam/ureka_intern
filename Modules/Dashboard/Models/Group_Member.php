<?php

namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

class Group_Member extends Model
{
    protected $table = 'group_members';
    protected $fillable = ['group_id', 'group_name'];
    protected $timestamp = true;
    public function versions()
    {
        return $this->hasMany('Members', 'group_id','id');
    }
}
