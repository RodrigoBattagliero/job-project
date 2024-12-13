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

    public function search(array $data)
    {
        $filters = [];

        if (isset($data['title'])) {
            $filters[] = ['title', 'like', '%'.$data['title'].'%'];
        }

        if (isset($data['country'])) {
            $filters[] =  ['country', 'like', '%'.$data['country'].'%'];
        }

        if (isset($data['min_salary'])) {
            $filters[] =  ['salary', '>', $data['min_salary']];
        }

        if (isset($data['max_salary'])) {
            $filters[] =  ['salary', '<', $data['max_salary']];
        }

        return JobOpportunity::where($filters)->get()->toArray();
    }
}
