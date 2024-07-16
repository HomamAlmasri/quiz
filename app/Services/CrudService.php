<?php

namespace App\Services;

use App\CrudInterface;

abstract class CrudService implements CrudInterface
{
    public $model;

    public function index(){
        return $this->model::all();
    }
    public function store(array $data)
    {
        return $this->model::create($data);
    }
    public function update(array $data, $id)
    {
        
    }
    public function delete($id)
    {
        
    }
}