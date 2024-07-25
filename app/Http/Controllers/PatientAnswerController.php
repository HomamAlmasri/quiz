<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientAnswerRequest;
use App\Http\Requests\PatientAnswersRequest;
use App\Http\Resources\PatientAnswersResource;
use App\Models\Patient;
use App\Models\Quiz;
use App\Services\CRUD\PatientAnswerService;
use Illuminate\Http\Request;

class PatientAnswerController extends Controller
{
    public function __construct(protected PatientAnswerService $patientAnswerService)
    {
     $this->patientAnswerService = $patientAnswerService;   
    }
   
    public function storeMany(PatientAnswersRequest $request)
    { 
        $answersData = [];
        foreach($request->answers as $answer)
        {   
            $answerData = [
                'patient_id'    => $request->patient_id,
                'question_id'   => $answer['question_id'],
                'option_id'     => $answer['option_id'],
            ];
            $this->patientAnswerService->store($answerData);
            $answersData[] = $answerData;
        
        }
        return PatientAnswersResource::collection($answersData);
    }
    public function show(Quiz $quiz,Patient $patient){
        $this->patientAnswerService->shows($quiz->id,$patient->id);    
    }
}   
    