<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Services\QuestionService;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(protected QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }
    public function index(){
       $data = $this->questionService->index();
       return response()->json($data);
    }

    public function store(StoreQuestionRequest $request){
        $validated = $request->validated();

        return $this->questionService->store($validated);
    }

}
