<?php

namespace App\Api;

use App\Service\ServiceInterface\DiscordLinkGeneratorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\ServiceInterface\ParadiseLinkGeneratorInterface;
use App\Api\ApiInterface\DiscordApiWebhookRequestInterface;

class DiscordApiWebhookRequest implements DiscordApiWebhookRequestInterface
{
    private HttpClientInterface $client;
    private DiscordLinkGeneratorInterface $discordLinkGenerator;

    public function __construct(
        HttpClientInterface $client,
        DiscordLinkGeneratorInterface $discordLinkGenerator,
    )
    {
        $this->client = $client;
        $this->discordLinkGenerator = $discordLinkGenerator;
    }

    public function postDiscordWebhookData(string $discordWebhookUrl, array $data)
    {
        $response = $this->client->request(
            'POST',
            $discordWebhookUrl,
            $data
        );

        return $response;

    }

}