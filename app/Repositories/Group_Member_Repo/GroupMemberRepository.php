<?php
namespace App\Repositories\Group_Member_Repo;

use App\Repositories\BaseRepository;

class GroupMemberRepository extends BaseRepository implements GroupMemberRepositoryInterface {
    public function getModel()
    {
        return \Modules\Dashboard\Models\Group_Member::class;
    }

}
