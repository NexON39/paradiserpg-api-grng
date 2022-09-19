<?php

namespace App\Service\ServiceInterface;

interface DiscordLinkGeneratorInterface
{
    public function getDiscordExportInfoUrl(): string;

    public function getDiscordMagazineInfoUrl(): string;

    public function getDiscordMagazineExpiryInfoUrl(): string;
}