<?php

namespace App\Interfaces;

interface JobOpportunityRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function search(array $data);
}
