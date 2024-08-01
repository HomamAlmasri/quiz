<?php
namespace App\Services;

class ScoreService
{
    public static function getScore(array $questions)
    {
        $possibleScores = [];

        foreach ($questions as $question) {
            $options = array_column($question['options'], 'point');
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
