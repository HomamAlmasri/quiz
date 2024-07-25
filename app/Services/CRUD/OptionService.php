<?php

namespace App\Services\CRUD;

use App\Interfaces\OptionServiceInterface;
use App\Models\Option;

class OptionService  extends CrudService
{

    public function __construct()
    {
        $this->model = Option::class;
    }
}
