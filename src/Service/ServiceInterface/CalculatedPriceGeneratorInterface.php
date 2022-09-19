<?php

namespace App\Service\ServiceInterface;

interface CalculatedPriceGeneratorInterface
{
    public function getCalculatedPriceByPercent(int $price, int $percent): string;
}