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

    public function get_limit_prod($id)
    {

        $version = $this->model->paginate(10, [
            'id',
            'product_id',
            'type',
            'desc',
            'url',
            'created_at',
        ], null, 1);

        foreach ($version as $item) {
            $item['products'] =  $item->products;
        }

        return $version;
    }

    public function get_single_product($id, $type)
    {
        $version = $this->model->select()->first($id);
       
        $version['products'] =  $version->products;
        

        return $version;
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
