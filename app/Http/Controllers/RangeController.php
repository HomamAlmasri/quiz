<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRangeRequest;
use App\Http\Resources\RangeResource;
use App\Models\Patient;
use App\Services\CRUD\RangeService;
use App\Services\ScoreService;
use Illuminate\Http\Request;

class RangeController extends Controller
{
    protected $rangeService;
    protected $scoreService;

    public function __construct(RangeService $rangeService, ScoreService $scoreService)
    {
        $this->rangeService = $rangeService;
        $this->scoreService = $scoreService;
    }

    public function store(StoreRangeRequest $request)
    {
        $rangesData = [];
        foreach ($request->ranges as $range) {
            $rangeData = [
                'quiz_id' => $request->quiz_id,
                'min' => $range['min'],
                'max' => $range['max'],
                'result' => $range['result'],
            ];
        //    dd($rangeData);
      
            $this->rangeService->store($rangeData);
            $rangesData[] = $rangeData;
        }

        return RangeResource::collection($rangesData);
    }
}
