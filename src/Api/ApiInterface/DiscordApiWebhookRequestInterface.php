<?php

namespace App\Api\ApiInterface;

interface DiscordApiWebhookRequestInterface
{
    public function postDiscordWebhookData(string $discordWebhookUrl, array $data);
}