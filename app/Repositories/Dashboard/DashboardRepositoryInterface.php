<?php
namespace App\Repositories\Dashboard;
use App\Repositories\RepositoryInterface;

interface  DashboardRepositoryInterface extends RepositoryInterface{
    // get 10 user
    public function get_limit_user( $total_item, $start );
    public function add_user_by_admin($name,$args = []);
    public function get_single_user($id);
    public function delete_user($id );

    
}
