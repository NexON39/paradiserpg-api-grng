<?php

namespace App\Service\ServiceInterface;

interface ParadiseLinkGeneratorInterface
{
    public function getParadiseLoginUrl(): string;

    public function getParadiseWarehouseUrl(): string;
}