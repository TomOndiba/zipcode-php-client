<?php

namespace Codenexus\Zipcode;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

class ApiClient
{
    protected $key;

    protected $httpClient;

    protected $requestFactory;

    const ZIPCODE_URI = 'https://www.zipcodeapi.com/rest/';

    public function __construct(HttpClient $httpClient = null, RequestFactory $requestFactory = null)
    {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
        $this->key = getenv('ZIPCODE_APP_KEY');
    }

    public function zipCodeDistance($zip1, $zip2, $format = 'json', $units = 'mile')
    {
        $request = $this->requestFactory->createRequest('GET', self::ZIPCODE_URI . "$this->key/distance.$format/$zip1/$zip2/$units");
        $response = $this->httpClient->sendRequest($request);

        return $response;
    }

    public function findZipCodesByRadius($zip, $distance = 10, $format = 'json', $units = 'mile')
    {
        $request = $this->requestFactory->createRequest('GET', self::ZIPCODE_URI . "$this->key/radius.$format/$zip/$distance/$units");
        $response = $this->httpClient->sendRequest($request);

        return $response;
    }

    public function findCloseZipCodes(array $zipcodes, $distance = 10, $format = 'json', $units = 'mile')
    {
        $zips = implode(",", $zipcodes);
        $request = $this->requestFactory->createRequest('GET', self::ZIPCODE_URI . "$this->key/match-close.$format/$zips/$distance/$units");
        $response = $this->httpClient->sendRequest($request);

        return $response;
    }

    public function zipCodeToLocation($zip, $format = 'json', $units = 'degrees')
    {
        $request = $this->requestFactory->createRequest('GET', self::ZIPCODE_URI . "$this->key/info.$format/$zip/$units");
        $response = $this->httpClient->sendRequest($request);

        return $response;
    }

    public function zipCodesToLocation(array $zipcodes, $format = 'json', $units = 'degrees')
    {
        $zips = implode(",", $zipcodes);
        $request = $this->requestFactory->createRequest('GET', self::ZIPCODE_URI . "$this->key/multi-info.$format/$zips/$distance/$units");
        $response = $this->httpClient->sendRequest($request);

        return $response;
    }

    public function locationToZipCodes($city, $state, $format = 'json')
    {
        $request = $this->requestFactory->createRequest('GET', self::ZIPCODE_URI . "$this->key/city-zips.$format/$city/$state");
        $response = $this->httpClient->sendRequest($request);

        return $response;
    }
}
