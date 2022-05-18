<?php
namespace App\Repositories\Product_Repo;
use App\Repositories\RepositoryInterface;

interface  ProductRepositoryInterface extends RepositoryInterface{
    // get 10 user
   public function get_product_id($product_id);


}
