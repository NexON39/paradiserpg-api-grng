<?php

namespace App\UserConfig\UserConfigInterface;

interface UserConfigInterface
{
    public function getUserLogin(): string;

    public function getUserPassword(): string;
}