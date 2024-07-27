<?php

namespace App\Services;

use App\Interfaces\QuizServiceInterface;
use App\Models\Quiz;
use App\Services\CRUD\CrudService;

class QuizService  extends CrudService
{
    public function __construct()
    {
        $this->model = Quiz::class;
    }
    public function index()
    {
        return $this->model::with('question.option')->get();
    }
}
