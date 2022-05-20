<?php

namespace App\Repositories\Auth_Repo;

use App\Repositories\BaseRepository;
use Modules\Auth\Models\Group_Member;
use Modules\Auth\Models\Members;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function getModel()
    {
        return Members::class;
    }


    public function regiter_user($group, $attributes = [])
    {
        $group = $this->model->firstOrCreate(['group_id' => $group], [
            [
                'group_id' => 1,
                'group_name' => 'admin'
            ],
            [
                'group_id' => 2,
                'group_name' => 'dev'
            ]])->group();

        if ($group){
            return $this->model->create($attributes);
        }
        return false;
    }
}
