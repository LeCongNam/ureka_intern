<?php
namespace App\Repositories\Version_Repo;
use App\Repositories\RepositoryInterface;

interface  VersionRepositoryInterface extends RepositoryInterface{
    // get 10 user
   
    public function get_limit_prod($start, $total_item);
    public function get_single_product($id,$type);

}
