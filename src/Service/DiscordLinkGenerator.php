<?php

namespace App\Service;

use App\Service\ServiceInterface\DiscordLinkGeneratorInterface;

class DiscordLinkGenerator implements DiscordLinkGeneratorInterface
{
    private const DISCORD_EXPORT_INFO_URL = 'https://discord.com/api/webhooks/1017160687505641562/Lp_hx5tdXw1V0jjQ0FgSybjO9RPJz0mnYbiSQY1dQr-s7nbe0X99sL17becGB50oBM4k';

    private const DISCORD_MAGAZINE_INFO_URL = 'https://discord.com/api/webhooks/1017160693113430187/06Xyo3RKuJf1gAAQu5c4OzHbSZxEz_NO5PHqPQpANdFSM9-2VwuEq9NeyaQs5NWSK-We';

    private const DISCORD_MAGAZINE_EXPIRY_INFO_URL = 'https://discord.com/api/webhooks/1017160681281290301/t0EF6HyZPDp5UbM-bvrkjXxSkoWi7lwZ5ZMKxcqGJMNLoMp0WjCM2CQSPs4pQSUIXtgD';

    public function getDiscordExportInfoUrl(): string
    {
        return self::DISCORD_EXPORT_INFO_URL;
    }

    public function getDiscordMagazineInfoUrl(): string
    {
        return self::DISCORD_MAGAZINE_INFO_URL;
    }

    public function getDiscordMagazineExpiryInfoUrl(): string
    {
        return self::DISCORD_MAGAZINE_EXPIRY_INFO_URL;
    }
}