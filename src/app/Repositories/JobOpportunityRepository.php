<?php

namespace App\Repositories;

use App\Interfaces\JobOpportunityRepositoryInterface;
use App\Models\JobOpportunity;

class JobOpportunityRepository implements JobOpportunityRepositoryInterface
{
    public function index() 
    {
        return JobOpportunity::all();
    }

    public function store(array $data) 
    {
        return JobOpportunity::create($data);
    }
}
