<?php
namespace App\Http\Requests;

use App\Rules\MinimumCheck;
use App\Services\ScoreService;
use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
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
            'name'                               => 'required',
            'questions'                          => 'required|array',
            'questions.*.question'               => 'required',
            'questions.*.options'                => 'required|array',
            'questions.*.options.*.option_text'  => 'required',
            'questions.*.options.*.point'        => 'required|numeric',
            'ranges'                             => ['required', 'array', new MinimumCheck(($this->input('questions')), $this->scoreService)],
            'ranges.*.min'                       => ['required', 'integer'],
            'ranges.*.max'                       => ['required', 'integer'],
            'ranges.*.result'                    => ['required', 'string'],
        ];
    }
}
