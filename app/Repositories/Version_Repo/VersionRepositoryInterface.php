<?php
namespace App\Repositories\Version_Repo;
use App\Repositories\RepositoryInterface;

interface  VersionRepositoryInterface extends RepositoryInterface{
    // get 10 user
   
    public function get_limit_prod($start);
    public function get_single_product($id,$type);
    public function update_versions($id,$attributes = []);
    public function delete_versions($id);

}
