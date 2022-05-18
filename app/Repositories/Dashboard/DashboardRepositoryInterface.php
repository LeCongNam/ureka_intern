<?php
namespace App\Repositories\Dashboard;
use App\Repositories\RepositoryInterface;

interface  DashboardRepositoryInterface extends RepositoryInterface{
    // get 10 user
    public function get_limit_user($start, $total_item);


}
