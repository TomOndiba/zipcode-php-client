<?php

namespace Codenexus\Zipcode;

use GuzzleHttp\Client;

class Zipcode
{
    protected $client;

    protected $key;

    public function __construct()
    {
        $this->client = $this->createHttpClient();
        $this->key = env('ZIPCODE_APP_KEY');
    }

    public function zipCodeDistance($zip1, $zip2, $format = 'json', $units = 'mile')
    {
        $path = "$this->key/distance.$format/$zip1/$zip2/$units";
        $response = $this->sendRequest($path);

        return $response->getBody();
    }

    public function findZipCodesByRadius($zip, $distance = 10, $format = 'json', $units = 'mile')
    {
        $path = "$this->key/radius.$format/$zip/$distance/$units";
        $response = $this->sendRequest($path);

        return $response->getBody();
    }

    public function findCloseZipCodes(array $zipcodes, $distance = 10, $format = 'json', $units = 'mile')
    {
        $zips = implode(",", $zipcodes);
        $path = "$this->key/match-close.$format/$zips/$distance/$units";
        $response = $this->sendRequest($path);

        return $response->getBody();
    }

    public function zipCodeToLocation($zip, $format = 'json', $units = 'degrees')
    {
        $path = "$this->key/info.$format/$zip/$units";
        $response = $this->sendRequest($path);

        return $response->getBody();
    }

    public function zipCodesToLocation(array $zipcodes, $format = 'json', $units = 'degrees')
    {
        $zips = implode(",", $zipcodes);
        $path = "$this->key/multi-info.$format/$zips/$distance/$units";
        $response = $this->sendRequest($path);

        return $response->getBody();
    }

    public function locationToZipCodes($city, $state, $format = 'json')
    {
        $path = "$this->key/city-zips.$format/$city/$state";
        $response = $this->sendRequest($path);

        return $response->getBody();
    }

    protected function createHttpClient()
    {
        $client = new Client(['base_uri' => 'https://www.zipcodeapi.com/rest/']);

        return $client;
    }

    protected function sendRequest($path)
    {
        $response = $this->client->request('GET', $path);

        return $response;
    }

}
