<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRangeRequest;
use App\Http\Resources\RangeResource;
use App\Http\Resources\RangeResource1;
use App\Services\CRUD\RangeService;
use App\Services\ScoreService;
use Illuminate\Http\Request;

class RangeController extends Controller
{
    public function __construct(
        protected RangeService $rangeService,
        protected ScoreService $scoreService
    ) {

    }

    public function store(StoreRangeRequest $request){
        $rangesData = [];
        foreach($request->ranges as $range)
        {
            $rangeData = [
                'quiz_id'   => $request->quiz,
                'min'       => $range['min'],
                'max'       => $range['max'],
                'result'    => $range['result'],
            ];
            $this->rangeService->store($rangeData);
            $rangesData[] = $rangeData;
        }
        // dd($rangesData);
        return  RangeResource::collection($rangesData);
    }
}