<?php

namespace App\Services\Search;

use Illuminate\Support\Facades\Http;

class SourceJobbery implements SourceInterface
{
    public function getResults(array $queryParams)
    {
        $params = $this->formatQueryParams($queryParams);
        $response = $this->getResponseFromSourceData($this->getFullUrl(), $params);
        $formatResponse = $this->sourceDataToArray($response);

        return $formatResponse;
    }

    public function formatQueryParams(array $inputParams) 
    {
        $params = [];
        if (isset($inputParams['title'])) {
            $params['name'] = $inputParams['title'];
        }

        if (isset($inputParams['country'])) {
            $params['country'] = $inputParams['country'];
        }

        if (isset($inputParams['min_salary'])) {
            $params['salary_min'] = $inputParams['min_salary'];
        }

        if (isset($inputParams['max_salary'])) {
            $params['salary_max'] = $inputParams['max_salary'];
        }    
        return $params;
    }

    public function getResponseFromSourceData(string $url, array $params) 
    {        
        try {
            $response = Http::get($url, $params)->object();
        } catch (\Exception $e) {
            $response = [];
        }
        return $response;
    }

    public function getFullUrl()
    {
        return 
            config('app.external_job_sources_url.avatureexternaljobs.base') .
            ':' . config('app.external_job_sources_url.avatureexternaljobs.port') .
            '/' . config('app.external_job_sources_url.avatureexternaljobs.service')
        ;
    }

    public function sourceDataToArray($arrayData)
    {
        $response = [];
        //$arrayData = \json_decode($jsonString);
        
        foreach ($arrayData as $country => $countryArray) {
            foreach ($countryArray as $info) {
                $job = $this->sourceToArray($info, $country);
                $response[] = $job;
            }
        }
        return $response;
    }

    public function sourceToArray($info, $country)
    {
        $job = [];
        $job['title'] = $info[0];
        $job['salary'] = $info[1];
        $job['skills'] = $this->fromXml($info[2]);
        $job['country'] = $country;
        $job['description'] = '';

        return $job;
    }

    public function fromXml($xmlString) 
    {        
        $simplexml = \simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = \json_encode($simplexml);
        $array = \json_decode($json, true);
        if ($array) {
            return $array['skill'];
        } else {
            return [];
        }
    }

}