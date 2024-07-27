<?php

namespace App\Services\CRUD;

use App\Interfaces\PatientAnswerServiceInterface;
use App\Models\PatientAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\ArrayRule;

class PatientAnswerService extends CrudService
{
    public function __construct()
    {
        return $this->model = PatientAnswer::class;
    }
    public function getresult($quizId, $patientId, array $data)
    {

        $score = 0;
        foreach ($data as $answers) {
            $score += $answers['option_id'];
        }
        $ranges = DB::table('ranges')
            ->where('quiz_id', $quizId)
            ->get();
        foreach ($ranges as $range) {
            if ($score >= $range->min && $score <= $range->max) {
                return $range->result;
            }
        }
    }
}
