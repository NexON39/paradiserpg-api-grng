<?php

namespace App\Api\ApiInterface;

interface ParadiseApiWarehouseRequestInterface
{
    public function fetchParadiseApiWarehouseData(string $token): array;
}