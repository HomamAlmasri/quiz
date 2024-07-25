<?php

namespace App\Services\CRUD;

use App\Interfaces\PatientServiceInterface;
use App\Models\Patient;

class PatientService extends CrudService 
{
    public function __construct()
    {
      $this->model = Patient::class;   
    }
    public function store(array $data)
    {
        return $this->model::firstOrCreate(
            ['name'=>$data['name'],
            'email'=>$data['email']]
        );
    }
}