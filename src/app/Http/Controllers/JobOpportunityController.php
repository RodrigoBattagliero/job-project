<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunity;
use App\Http\Resources\JobOpportunityResource;
use App\Http\Requests\StoreJobOpportunityRequest;
use App\Http\Requests\UpdateJobOpportunityRequest;
use App\Interfaces\JobOpportunityRepositoryInterface;

class JobOpportunityController extends Controller
{
    private JobOpportunityRepositoryInterface $jobOpportunityRepositoryInterface;

    public function __construct(JobOpportunityRepositoryInterface $jobOpportunityRepositoryInterface)
    {
        $this->jobOpportunityRepositoryInterface = $jobOpportunityRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->jobOpportunityRepositoryInterface->index();
        return $this->sendResponse(JobOpportunityResource::collection($data), 'success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobOpportunityRequest $request)
    {
        try {
            $product = $this->jobOpportunityRepositoryInterface->store($request->validated());

            return $this->sendResponse(
                new JobOpportunityResource($product),
                'Job opportunity created successfully',
                201
            );

        } catch (\Exception $e) {
            return $this->rollback($e);
        }
    }
}
