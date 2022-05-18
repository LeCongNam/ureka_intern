<?php
namespace App\Repositories\Version_Repo;

use App\Repositories\BaseRepository;
use App\Repositories\Version_Repo\VersionRepositoryInterface;

class VersionRepository extends BaseRepository implements VersionRepositoryInterface{
    public function getModel()
    {
        return \Modules\Dashboard\Models\Versions::class;

    }

    public function get_limit_prod($start, $total_item)
    {
        //    $this->model->all();
        return $this->model->select([
            'product_id',
            'product_name',
            'product_type',
            'desc',
            'url',
            'created_at'
        ])->skip($start)->take($total_item)->get();
    }

}
