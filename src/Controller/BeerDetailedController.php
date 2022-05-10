<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BeerDetailedController extends AbstractController
{
    /**
     * @Route("/beer-detailed", name="app_beer_detailed")
     */
    public function index(Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        $client = new Client([
            'base_uri' => 'https://api.punkapi.com'
        ]);
        $response = $client->request('GET', '/v2/beers');
        if (isset($parameters['food']) && !empty($parameters['food'])){
        $food = $parameters['food'];
        $response = $client->request('GET', '/v2/beers',[
            'query' => [
                'food' => $food
            ]
            ]);
        }
        $body = $response->getBody();
        $arr_body = json_decode($body,true);
        $beers=[];
        foreach ($arr_body as $arr_beer){
            $beer = [
               'id' => $arr_beer['id'],
               'name' => $arr_beer['name'],
               'description' => $arr_beer['description'],
               'image' => $arr_beer['image_url'],
               'tagLine' => $arr_beer['tagline'],
               'firstBrewed' => $arr_beer['first_brewed']
            ];
            array_push($beers,$beer);
        }
        return new JsonResponse(
            $beers,
            JsonResponse::HTTP_OK
        );
    }
}
