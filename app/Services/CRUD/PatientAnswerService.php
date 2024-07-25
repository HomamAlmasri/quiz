<?php

namespace App\Services\CRUD;

use App\Interfaces\PatientAnswerServiceInterface;
use App\Models\PatientAnswer;
use Illuminate\Support\Facades\DB;

class PatientAnswerService extends CrudService
{
    public function __construct()
    {
        return $this->model = PatientAnswer::class;
    }
    public function shows($quizId ,$patientId){
        $score = 0;
        $questions = DB::table('questions')
        ->where('quiz_id', $quizId)
        ->get();
        foreach($questions as $question){
        $answers = DB::table('patient_answers')
        ->where('question_id',$question->id)
        ->where('patient_id',$patientId)  
        ->pluck('option_id');
        $score += $answers;
    }   
    dd($answers , $score);   
    }
}