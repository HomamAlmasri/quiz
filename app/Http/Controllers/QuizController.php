<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Models\Quiz;
use App\Services\CRUD\QuizService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class QuizController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function index()
    {
        return $this->quizService->index();
    }

    public function show(Quiz $quiz)
    {
        return $this->quizService->show($quiz);
    }

    public function store(StoreExamRequest $request): JsonResponse
    {

            $this->quizService->createQuizWithQuestionsAndOptions(    
            $request->only('name'),
            $request->input('questions'),
            $request->input('ranges')
            );
            return response()->json('Quiz Created Successfully' , 201);
    
    }
}
