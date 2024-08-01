<?php
namespace App\Services\CRUD;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Database\Eloquent\Model;
use App\Services\CRUD\QuestionService;
use App\Services\CRUD\OptionService;
use App\Services\CRUD\RangeService;
use Illuminate\Support\Facades\DB;

class QuizService extends CrudService
{
    protected $questionService;
    protected $optionService;
    protected $rangeService;

    public function __construct(QuestionService $questionService, OptionService $optionService ,RangeService $rangeService)
    {
        $this->model = Quiz::class;
        $this->questionService = $questionService;
        $this->optionService = $optionService;
        $this->rangeService = $rangeService;
    }

    public function index()
    {
        return $this->model::with('questions.options')->get();
    }

    public function show(Model $model)
    {
        return $model->loadMissing('questions.options');
    }

    public function createQuizWithQuestionsAndOptions(array $quizData, array $questionsData, array $rangesData): Quiz
    {
       
        DB::beginTransaction();

        try {
        
            $quiz = Quiz::create(['name' => $quizData['name']]);

          
            foreach ($questionsData as $questionData) {
                $question = $this->questionService->store([
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question']
                ]);

                foreach ($questionData['options'] as $optionData) {
                    $this->optionService->store([
                        'question_id' => $question->id,
                        'option_text' => $optionData['option_text'],
                        'point' => $optionData['point']
                    ]);
                }
            }

         
            foreach ($rangesData as $range) {
                $this->rangeService->store([
                    'quiz_id' => $quiz->id,
                    'min' => $range['min'],
                    'max' => $range['max'],
                    'result' => $range['result']
                ]);
            }

            DB::commit();

            return $quiz->load('questions.options');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
