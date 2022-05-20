<?php
namespace App\Repositories\Auth_Repo;

use App\Repositories\RepositoryInterface;

interface  AuthRepositoryInterface extends RepositoryInterface{
    // Insert user to DB
    public function regiter_user( $group,$attributes = [] );
  

}
