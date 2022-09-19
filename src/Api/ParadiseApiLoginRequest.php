<?php

namespace App\Api;

use App\Api\ApiInterface\ParadiseApiLoginRequestInterface;
use App\UserConfig\UserConfigInterface\UserConfigInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\ServiceInterface\ParadiseLinkGeneratorInterface;

class ParadiseApiLoginRequest implements ParadiseApiLoginRequestInterface
{
    private UserConfigInterface $userConfig;
    private HttpClientInterface $client;
    private ParadiseLinkGeneratorInterface $paradiseLinkGenerator;

    public function __construct(
        UserConfigInterface $userConfig,
        HttpClientInterface $client,
        ParadiseLinkGeneratorInterface $paradiseLinkGenerator
    )
    {
        $this->userConfig = $userConfig;
        $this->client = $client;
        $this->paradiseLinkGenerator = $paradiseLinkGenerator;
    }

    public function fetchParadiseApiUserToken(): string
    {
        $response = $this->client->request(
            'POST',
            $this->paradiseLinkGenerator->getParadiseLoginUrl(),
            [
                'headers' => ['Content-Type: application/x-www-form-urlencoded'],
                'body' => [
                    'login' => $this->userConfig->getUserLogin(),
                    'password' => $this->userConfig->getUserPassword(),
                ],
            ]);

        $content = $response->toArray();

        return $content['token'];
    }

}