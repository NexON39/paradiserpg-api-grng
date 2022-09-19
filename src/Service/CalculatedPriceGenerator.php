<?php

namespace App\Service;

use App\Service\ServiceInterface\CalculatedPriceGeneratorInterface;

class CalculatedPriceGenerator implements CalculatedPriceGeneratorInterface
{
    public function getCalculatedPriceByPercent(int $price, int $percent): string
    {
        return (string)($price/100)*$percent;
    }
}