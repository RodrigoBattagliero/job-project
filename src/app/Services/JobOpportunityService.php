<?php 

namespace App\Services;

use App\Services\Search\SearchService;
use App\Interfaces\JobOpportunityRepositoryInterface;

class JobOpportunityService 
{
    private JobOpportunityRepositoryInterface $jobOpportunityRepositoryInterface;
    private SearchService $searchJobOpportunityService;

    public function __construct(
        JobOpportunityRepositoryInterface $jobOpportunityRepositoryInterface,
        SearchService $searchJobOpportunityService
    )
    {
        $this->jobOpportunityRepositoryInterface = $jobOpportunityRepositoryInterface;
        $this->searchJobOpportunityService = $searchJobOpportunityService;
    }
    
    public function search($data)
    {
        return $this->searchJobOpportunityService->search($data);
    }

    public function all() 
    {
        return $this->jobOpportunityRepositoryInterface->index();
    }

    public function store($data)
    {
        return $this->jobOpportunityRepositoryInterface->store($data);
    }
}