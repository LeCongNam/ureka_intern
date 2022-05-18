<?php
namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Members extends Authenticatable
{
    protected $table = 'members';
    protected $fillable = ['user_name','email','password'];
    public $timestamps = TRUE;
    protected $user_name =null ;
    protected $email =null ;
    protected $password =null ;
    protected $group_id  =null ;
    protected $created_at =null ;
    protected $updated_at =null ;
}
