<?php

namespace App\Rules;

use App\Models\Quiz;
use App\Services\ScoreService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class minimumCheck implements ValidationRule
{
    public function __construct(protected $quizId, protected ScoreService $scoreService)
    {
        $this->quizId = $quizId;
        $this->scoreService = $scoreService;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $score = $this->scoreService->getScore($this->quizId);
        $min = min($score);
        $max = max($score);


        foreach ($value as $key => $range) {

            if ($key == 0) {
                if ($range['min'] !== $min) {
                    $fail('The :attribute minimum must be equal to ' . $min);
                }
            } else {
                $prevRange =  $value[$key - 1];
                if ($range['min'] != $prevRange['max'] + 1) {
                    $fail('The :attribute must be continues wihtout overlaps or gaps ');
                }
                if ($range['max'] > $max) {
                    $fail('The :attribute Max has not be more than ' . $max);
                }
                // dd($max,$key == count($value) - 1 ,$range['max'] != $max ,$range['max']);
                if ($key == count($value) - 1 && $range['max'] != $max) {
                    $fail('The :attribute Max must equal to ' . $max);
                }
            }
        }
    }
}
