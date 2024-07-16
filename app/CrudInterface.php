<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

interface CrudInterface
{
    public function index();
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
}

// interface CrudInterface
// {
//     public function index(Model $model);
//     public function store(array $data , Model $model);
//     public function update(array $data,$id);
//     public function delete($id);
// }