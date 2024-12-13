<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Http\Resources\JobOpportunityResource;
use App\Http\Requests\StoreJobOpportunityRequest;
use App\Http\Requests\SearchJobOpportunityRequest;
use App\Http\Resources\SearchJobOpportunityResource;
use App\Interfaces\JobOpportunityRepositoryInterface;
use App\Services\JobOpportunityService;
use App\Services\Search\JobOpportunityService as SearchJobOpportunityService;

class JobOpportunityController extends Controller
{
    private JobOpportunityService $jobOpportunityService;

    public function __construct(
        JobOpportunityService $jobOpportunityService,
    )
    {
        $this->jobOpportunityService = $jobOpportunityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->jobOpportunityService->all();
        return $this->sendResponse(JobOpportunityResource::collection($data), 'success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobOpportunityRequest $request)
    {
        try {
            $product = $this->jobOpportunityService->store($request->validated());

            return $this->sendResponse(
                new JobOpportunityResource($product),
                'Job opportunity created successfully',
                201
            );

        } catch (\Exception $e) {
            return $this->rollback($e);
        }
    }

    public function search(SearchJobOpportunityRequest $request)
    {
        
        $data = $this->jobOpportunityService->search($request->validated());
        $colecction = new Collection($data);
        return $this->sendResponse(SearchJobOpportunityResource::collection($colecction), 'success');
    }
}
