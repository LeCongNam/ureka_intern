<?php
namespace App\Repositories\Auth_Repo;

use App\Repositories\BaseRepository;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface {
    public function getModel()
    {
        return \Modules\Auth\Models\Members::class;
    }



}
