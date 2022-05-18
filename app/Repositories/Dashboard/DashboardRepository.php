<?php
namespace App\Repositories\Dashboard;

use App\Repositories\BaseRepository;

class DashboardRepository extends BaseRepository implements DashboardRepositoryInterface {
    public function getModel()
    {
        return \Modules\Dashboard\Models\Members::class;
    }

    public function get_limit_user($start, $total_item)
    {
        return $this->model->select([
            'id',
            'user_name',
            'email',
            'group_id'
        ])->skip($start)->take($total_item)->get();
    }
}
