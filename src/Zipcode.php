<?php

namespace Codenexus\Zipcode;

use GuzzleHttp\Client;

class Zipcode
{
    protected $client;

    public function __construct()
    {
        $this->client = $this->createHttpClient();
    }

    public function distance($zip1, $zip2, $format = 'json', $units = 'mile')
    {
        //
    }

    public function find_zip_codes_by_radius($zip, $distance, $format = 'json', $units = 'mile')
    {
        //
    }

    public function find_close_zip_codes(array $zip, $distance = 10, $format = 'json', $units = 'mile')
    {
        //
    }

    public function zip_code_to_location($zip, $format = 'json', $units = 'degrees')
    {
        //
    }

    public function zip_codes_to_location($zip1, $zip2, $format = 'json', $units = 'degrees')
    {
        //
    }

    public function location_to_zip_codes($city, $state, $format = 'json')
    {

    }

    protected function createHttpClient()
    {
        $client = new Client(['base_uri' => 'https://www.zipcodeapi.com/rest/']);

        return $client;
    }

}
