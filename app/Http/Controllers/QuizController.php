<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizRequest;
use App\Models\Quiz;
use App\Services\CRUD\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function __construct(protected QuizService $quizService)
    {
    }

    public function index()
    {

        return $this->quizService->index();
    }

    public function show(Quiz $quiz)
    {
        return $this->quizService->show($quiz);
    }

    public function store(StoreQuizRequest $request)
    {
        return $this->quizService->store($request->validated());
    }
}
