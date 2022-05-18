<?php
namespace App\Repositories\Auth_Repo;

use App\Repositories\BaseRepository;

class SessionsRepository extends BaseRepository implements DashboardRepositoryInterface {
    public function getModel()
    {
        return \Modules\Auth\Models\Session::class;
    }



}
