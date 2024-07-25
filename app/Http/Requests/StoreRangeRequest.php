<?php

namespace App\Http\Requests;

use App\Rules\minimumCheck;
use App\Services\ScoreService;
use Illuminate\Foundation\Http\FormRequest;

class StoreRangeRequest extends FormRequest
{
    public function __construct(protected ScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quiz_id' => 'required|exists:quizzes,id',
            'ranges' => ['required', 'array', new minimumCheck($this->quiz_id, $this->scoreService)],
            'ranges.*.min' => ['required', 'integer'],
            'ranges.*.max' => ['required', 'integer'],
            'ranges.*.result' => ['required', 'string']
        ];
    } 
}
