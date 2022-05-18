<?php

namespace App\Repositories\Version_Repo;

use App\Repositories\BaseRepository;
use App\Repositories\Version_Repo\VersionRepositoryInterface;

class VersionRepository extends BaseRepository implements VersionRepositoryInterface
{
    public function getModel()
    {
        return \Modules\Dashboard\Models\Versions::class;
    }

    public function get_limit_prod($start, $total_item)
    {
        return $this->model->select([
            'product_id',
            'product_name',
            'product_type',
            'desc',
            'url',
            'created_at'
        ])->skip($start)->take($total_item)->get();
    }

    public function get_single_product($id,$type)
    {
        return $this->model->select([
            'product_id',
            'product_name',
            'product_type',
            'desc',
            'url',
        ])->where('product_id',$id)->where('product_type',$type)->get();
    }
}
