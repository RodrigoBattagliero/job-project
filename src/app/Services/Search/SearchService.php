<?php

namespace App\Services\Search;

use App\Interfaces\JobOpportunityRepositoryInterface;

class SearchService
{
    private JobOpportunityRepositoryInterface $jobOpportunityRepository;
    private ExternalSourceInterface $externalSource;

    public function __construct(
        JobOpportunityRepositoryInterface $jobOpportunityRepository,
        AvatureSource $externalSource,
    )
    {
        $this->jobOpportunityRepository = $jobOpportunityRepository;
        $this->externalSource = $externalSource; 
    }

    public function search(array $searchData)
    {
        $jibberyData = $this->externalSource->getResults($searchData);
        $localData = $this->jobOpportunityRepository->search($searchData);

        $mergeData = \array_merge(
            $localData,
            $jibberyData,
        );
        
        return $mergeData;
    }
}
