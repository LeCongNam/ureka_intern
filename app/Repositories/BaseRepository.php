<?php
namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

     //lấy model tương ứng
     abstract public function getModel();


      /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get_limit_row($col_name=[],$start, $total_item)
    {
        $result = $this->model->select($col_name)->skip($start)->take($total_item)->get();
        return $result;
    }

    public function find($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function find_by_column($column_name,$value)
    {
        $result = $this->model->select($column_name)->where($column_name,$value);
        return $result;
    }


    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }


    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }
        return false;
    }

}
