<?php

namespace App\Services\Search;

class JobOpportunityService
{
    private $sources;
    private $searchData;

    public function __construct(array $sources, array $searchData)
    {
        $this->sources = $sources;
        $this->searchData = $searchData; 
    }

    public function search()
    {
        $result = [];
        foreach ($this->sources as $source) {
            $result[] = $source->getResults($this->searchData);
        }

        return $result;
    }
}
