<?php

namespace App\Services\Search;

interface ExternalSourceInterface
{
    public function getResults(array $searchData);
}
