<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobOpportunityRequest;
use App\Http\Requests\UpdateJobOpportunityRequest;
use App\Http\Resources\JobOpportunityResource;
use App\Models\JobOpportunity;

class JobOpportunityController extends Controller
{
    private JobOpportunityRepositoryInterface $jobOpportunitRepositoryInterface;

    public function __construct(JobOpportunitRepositoryInterface $jobOpportunitRepositoryInterface)
    {
        $this->jobOpportunitRepositoryInterface = $jobOpportunitRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->jobOpportunitRepositoryInterface->index();
        return $this->sendResponse(StoreJobOpportunityRequest::collection($data), 'success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobOpportunityRequest $request)
    {
        try {
            $product = $this->jobOpportunitRepositoryInterface->store($request->validated());

            return $this->sendResponse(
                new JobOpportunityResource($product),
                'Product created successfully',
                201
            );

        } catch (\Exception $e) {
            return $this->rollback($e);
        }
    }
}
