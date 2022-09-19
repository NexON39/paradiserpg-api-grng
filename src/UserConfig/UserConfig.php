<?php

namespace App\UserConfig;

use App\UserConfig\UserConfigInterface\UserConfigInterface;

class UserConfig implements UserConfigInterface
{
    private const USER_LOGIN = 'grng_discord_bot';

    private const USER_PASSWORD = 'XxXx1337XxXx';

    public function getUserLogin(): string
    {
        return self::USER_LOGIN;
    }

    public function getUserPassword(): string
    {
        return self::USER_PASSWORD;
    }
}