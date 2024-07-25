<?php

namespace App\Services;

use App\Interfaces\ScoreServiceInterface;
use Illuminate\Support\Facades\DB;

class ScoreService 
{
    public static function getScore($quizId){
    
    $questions = DB::table('questions')
        ->where('quiz_id', $quizId)
        ->get();
    
        $possibleScores = [];
    
    foreach ($questions as $question) {
        
        $options = DB::table('options')
            ->where('question_id', $question->id)
            ->pluck('points')
            ->toArray();
        
            if (empty($possibleScores)) {
           
            $possibleScores = $options;
        
        } else {

            $newScores = [];

            foreach ($possibleScores as $score) {
             
                foreach ($options as $optionPoints) {
                 
                    $newScores[] = $score + $optionPoints;
                }
            }
  
            $possibleScores = array_unique($newScores);
        }
    }


    sort($possibleScores);
   
    return $possibleScores;
}
    }
