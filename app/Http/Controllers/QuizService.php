<?php

namespace App\Services;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Model;

class QuizService extends CrudService
{
    public function __construct() {
        $this->model = Quiz::class;
    }
}