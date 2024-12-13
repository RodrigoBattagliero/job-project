<?php

namespace App\Services\Search;

use Illuminate\Support\Facades\Http;

class SourceJobbery implements SourceInterface
{
    public function getResults(array $searchData)
    {
        $params = $this->formatParams($searchData);
        $response = $this->getResponse($params);
        $formatResponse = $this->formatResponse($response);
        
        return $formatResponse;
    }

    public function formatParams(array $inputParams) 
    {
        $params = [];
        if (isset($inputParams['title'])) {
            $params['name'] = $inputParams['title'];
        }

        if (isset($inputParams['country'])) {
            $params['country'] = $inputParams['country'];
        }

        if (isset($inputParams['min_salary'])) {
            $params['min_salary'] = $inputParams['min_salary'];
        }

        if (isset($inputParams['max_salary'])) {
            $params['max_salary'] = $inputParams['max_salary'];
        }    
        return $params;
    }

    public function getResponse(array $params) 
    {        
        try {
            $url = $this->getFullUrl();
            $response = Http::get($url,$params);
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

    public function formatResponse($jsonString)
    {
        $response = [];
        $arrayData = \json_decode($jsonString);

        foreach ($arrayData as $country => $countryArray) {
            foreach ($countryArray as $info) {
                $job = [];
                $job['title'] = $info[0];
                $job['salary'] = $info[1];
                $job['skills'] = $this->fromXml($info[2]);
                $job['country'] = $country;
                $job['description'] = '';

                $response[] = $job;
            }
        }
        

        return $response;
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