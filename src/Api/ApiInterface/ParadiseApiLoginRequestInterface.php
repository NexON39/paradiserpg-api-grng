<?php

namespace App\Api\ApiInterface;

interface ParadiseApiLoginRequestInterface
{
    public function fetchParadiseApiUserToken(): string;
}