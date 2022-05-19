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
        ])->skip($start)
            ->take($total_item)
            ->where('is_delete', null)
            ->get();
    }

    public function get_single_product($id, $type)
    {
        return $this->model->select([
            'product_id',
            'product_name',
            'product_type',
            'desc',
            'url',
        ])->where('product_id', $id)->where('product_type', $type)->get();
    }


    public function update_versions($prod_id, $type, $attributes = [])
    {
        $result = $this->model->select('product_id')
            ->where('product_id', $prod_id)
            ->where('product_type', $type);
        if ($result) {
            $result->where('product_id', $prod_id)
                ->where('product_type', $type)
                ->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete_versions($prod_id, $type, $attributes = [])
    {
        $result = $this->model->select('product_id')
            ->where('product_id', $prod_id)
            ->where('product_type', $type);
        if ($result) {
            $result->where('product_id', $prod_id)
                ->where('product_type', $type)
                ->update($attributes);
            return $result;
        }
        return false;
    }
}
