<?php

namespace App\Services\CRUD;

use App\Interfaces\QuizServiceInterface;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Model;

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
    public function show(Model $model)
    {
        return $model->loadMissing('question.option');
    }
}
