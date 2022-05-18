<?php
namespace App\Repositories\Product_Repo;

use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface{
    public function getModel()
    {
        return \Modules\Dashboard\Models\Product::class;
    }

    public function get_product_id($id)
    {
        $result =  $this->model->select('product_id')->where('product_id',$id)->first();
        return $result;
    }



}
