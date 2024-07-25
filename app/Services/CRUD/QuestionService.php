<?php

namespace  App\Services\CRUD;

use App\Models\Question;


class QuestionService extends CrudService
{
    public function __construct()
    {
        $this->model = Question::class;
    }
    public function index()
    {
        return $this->model::with('quiz','option')->get();
    }
}
