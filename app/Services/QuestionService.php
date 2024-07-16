<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Model;

class QuestionService extends CrudService
{
    public function __construct() {
        $this->model = Question::class;
    }
    public function index(){
        return $this->model::with('quiz')->get();
    }
}