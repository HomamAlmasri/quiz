<?php

namespace App\Services\CRUD;

use App\Interfaces\RangeServiceInterface;
use App\Models\Range;
use App\Services\CRUD\CrudService;

class RangeService extends CrudService
{
    public function __construct()
    {
        $this->model = Range::class;
    }
    public function store(array $data)
    {
        return $this->model::firstOrCreate(
            [
                'quiz_id' => $data['quiz_id'],
            ]
        );
    }
}
