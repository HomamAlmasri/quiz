<?php

namespace App\Services\CRUD;

use App\CrudInterface;
use Illuminate\Database\Eloquent\Model;

abstract class CrudService implements CrudInterface
{
    public $model;

    public function index(){
        return $this->model::all();
    }
    public function show(Model $model)
    {
        return $model;
    }
    public function store(array $data)
    {
        return $this->model::create($data);
    }   
    public function update(array $data, $id)
    {
        
    }
    public function delete($id)
    {}
}