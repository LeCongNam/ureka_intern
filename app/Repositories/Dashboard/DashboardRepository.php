<?php
namespace App\Repositories\Dashboard;

use App\Repositories\BaseRepository;

class DashboardRepository extends BaseRepository implements DashboardRepositoryInterface {
    public function getModel()
    {
        return \Modules\Dashboard\Models\Members::class;
    }

    public function get_limit_user( $total_item, $page )
    {
        return $this->model->paginate($total_item,[
            'id',
            'user_name',
            'email',
            'group_id'
        ], null, $page);
    }


    public function add_user_by_admin($name,$args = [])
    {
        $user =  $this->model->where('user_name',$name)->exists();
        if ($user == false) {
            return $this->model->create($args);
        }

        return false;
    }


    public function get_single_user($id)
    {
        return $this->model->select([
            'id',
            'user_name',
            'email',
            'group_id',
        ])->where('id',$id)->first();
    }

    public function edit_user_by_id($id, $attributes = [])
    {
        $result  = $this->update($id, $attributes);
        return $result;
    }

    public function delete_user($id )
    {
        return $this->delete($id);
    }

  
}
