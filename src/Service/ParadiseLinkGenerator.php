<?php

namespace App\Service;

use App\Service\ServiceInterface\ParadiseLinkGeneratorInterface;

class ParadiseLinkGenerator implements ParadiseLinkGeneratorInterface
{
    private const PARADISE_LOGIN_URL = 'https://ucp.paradise-rpg.pl/api/login';

    private const PARADISE_WAREHOUSE_URL = 'https://ucp.paradise-rpg.pl/api/group/976/warehouses';

    public function getParadiseLoginUrl(): string
    {
        return self::PARADISE_LOGIN_URL;
    }

    public function getParadiseWarehouseUrl(): string
    {
        return self::PARADISE_WAREHOUSE_URL;
    }
}