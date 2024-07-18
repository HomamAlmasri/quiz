<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizRequest;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
      
   public function __construct(protected QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function index(){
        
       return $this->quizService->index();   

    }
    
    public function store(StoreQuizRequest $request){
        $validated = $request->validated();
        
        return $this->quizService->store($validated);

    }

}
