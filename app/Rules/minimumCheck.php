<?php
namespace App\Rules;

use App\Services\ScoreService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinimumCheck implements ValidationRule
{
    protected $questions;
    protected $scoreService;

    public function __construct(array $questions, ScoreService $scoreService)
    {
        $this->questions = $questions;
        $this->scoreService = $scoreService;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $score = $this->scoreService->getScore($this->questions);
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
                    $fail('The :attribute must be continuous without overlaps or gaps.');
                }
                if ($range['max'] > $max) {
                    $fail('The :attribute Max must not be more than ' . $max);
                }
                if ($key == count($value) - 1 && $range['max'] != $max) {
                    $fail('The :attribute Max must equal ' . $max);
                }
            }
        }
    }
}
