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

    public function update_versions($id, $attributes = [])
    {
        $result = $this->update($id, $attributes);
        return $result;
    }

    public function delete_versions($id)
    {
        $result =   $this->delete($id);

        if ($result) {
            $this->update($id, [
                'is_delete' => 1
            ]);
            return $result;
        }
        return false;
    }
}
