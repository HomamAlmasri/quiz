<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Services\CRUD\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(protected PatientService $patientService)
    {
        $this->patientService = $patientService;
    }
public function store(StorePatientRequest $request)
    {
       return $this->patientService->store($request->validated());
    }    
}
