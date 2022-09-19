<?php

namespace App\Api;

use App\Api\ApiInterface\ParadiseApiWarehouseRequestInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\ServiceInterface\ParadiseLinkGeneratorInterface;

class ParadiseApiWarehouseRequest implements ParadiseApiWarehouseRequestInterface
{
    private HttpClientInterface $client;
    private ParadiseLinkGeneratorInterface $paradiseLinkGenerator;

    public function __construct(
        HttpClientInterface $client,
        ParadiseLinkGeneratorInterface $paradiseLinkGenerator,
    )
    {
        $this->client = $client;
        $this->paradiseLinkGenerator = $paradiseLinkGenerator;
    }

    public function fetchParadiseApiWarehouseData(string $token): array
    {
        $response = $this->client->request(
            'GET',
            $this->paradiseLinkGenerator->getParadiseWarehouseUrl(),
            [
                'auth_bearer' => $token,
            ]);

        return $response->toArray();
    }

}