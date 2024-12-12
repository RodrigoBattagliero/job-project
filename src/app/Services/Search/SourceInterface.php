<?php

namespace App\Services\Search;

interface SourceInterface
{
    public function getResults(array $searchData);
}
