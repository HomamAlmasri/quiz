<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionRequest;
use App\Services\CRUD\OptionService;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct(protected OptionService $optionService)
    {
        $this->optionService = $optionService;
    }
    public function index()
    {
        return $this->optionService->index();
    }
    public function store(StoreOptionRequest $request)
    {
        return $this->optionService->store($request->validated());
    }
}
