<?php

namespace App\Controller;

use GuzzleHttp\Client;
use App\Application\FindBeersQuery;
use App\Domain\Beer;
use GuzzleHttp\Promise\Is;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BeerController extends AbstractController
{
    /**
     * @Route("/beer", name="app_beer")
     */
    public function index(Request $request): JsonResponse
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
               'description' => $arr_beer['description']
            ];
            array_push($beers,$beer);
        }
        return new JsonResponse(
            $beers,
            JsonResponse::HTTP_OK
        );
    }

}
