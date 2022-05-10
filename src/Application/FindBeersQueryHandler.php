<?php

namespace App\Application;

use Carbon\CarbonImmutable;
use GuzzleHttp\Client;
use App\Application\FindBeersQuery;

class FindBeersQueryHandler
{

    public function __construct(string $food)
    {
        $this->food = $food;
    }

    public function handleFindBeersQuery(FindBeersQuery $query): string
    {
        dd($query);
        $client = new Client([
            'base_uri' => 'https://api.punkapi.com/v2/',
        ]);
          
        $response = $client->request('GET', '/beers');
        $body = $response->getBody();
        $arr_body = json_decode($body);
        return $arr_body;
    }
}