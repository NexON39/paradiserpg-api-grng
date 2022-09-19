<?php

namespace App\Service;

use App\Service\ServiceInterface\VehicleListGeneratorInterface;

class VehicleListGenerator implements VehicleListGeneratorInterface
{
    private const VEHICLE_LIST = [
        603 => [
            'name' => 'Phoenix',
            'min_sell_price' => 80000,
        ],
        400 => [
            'name' => 'Landstalker',
            'min_sell_price' => null,
        ],
        567 => [
            'name' => 'Savanna',
            'min_sell_price' => null,
        ],
        536 => [
            'name' => 'Blade',
            'min_sell_price' => null,
        ],
        475 => [
            'name' => 'Sabre',
            'min_sell_price' => null,
        ],
        579 => [
            'name' => 'Huntley',
            'min_sell_price' => 200000,
        ],
        477 => [
            'name' => 'ZR-350',
            'min_sell_price' => 350000,
        ],
        565 => [
            'name' => 'Flash',
            'min_sell_price' => 390000,
        ],
        506 => [
            'name' => 'Super GT',
            'min_sell_price' => 500000,
        ],
        558 => [
            'name' => 'Uranus',
            'min_sell_price' => 580000,
        ],
        559 => [
            'name' => 'Jester',
            'min_sell_price' => 700000,
        ],
        480 => [
            'name' => 'Comet',
            'min_sell_price' => 780000,
        ],
        434 => [
            'name' => 'Hotknife',
            'min_sell_price' => 860000,
        ],
        562 => [
            'name' => 'Elegy',
            'min_sell_price' => 860000,
        ],
        560 => [
            'name' => 'Sultan',
            'min_sell_price' => 950000,
        ],
        415 => [
            'name' => 'Cheetah',
            'min_sell_price' => 1100000,
        ],
        429 => [
            'name' => 'Banshee',
            'min_sell_price' => 1100000,
        ],
        2002 => [
            'name' => 'Soprano',
            'min_sell_price' => 1400000,
        ],
        604 => [
            'name' => 'Torero',
            'min_sell_price' => 2050000,
        ],
        411 => [
            'name' => 'Infernus',
            'min_sell_price' => 1800000,
        ],
        541 => [
            'name' => 'Bullet',
            'min_sell_price' => 1900000,
        ],
        451 => [
            'name' => 'Turismo',
            'min_sell_price' => 2100000,
        ],
        420 => [
            'name' => 'Wraith',
            'min_sell_price' => 5600000,
        ],
        502 => [
            'name' => 'Diablo',
            'min_sell_price' => 4000000,
        ],
        2005 => [
            'name' => 'Reaper',
            'min_sell_price' => 13500000,
        ],
        503 => [
            'name' => 'Venom',
            'min_sell_price' => 6800000,
        ],
        2004 => [
            'name' => 'Fusion',
            'min_sell_price' => 10000000,
        ],
        2001 => [
            'name' => 'Titan',
            'min_sell_price' => 1300000,
        ],
        438 => [
            'name' => 'Hammerhead',
            'min_sell_price' => 2500000,
        ],
        494 => [
            'name' => 'Rattler',
            'min_sell_price' => 5000000,
        ],
        555 => [
            'name' => 'Windsor',
            'min_sell_price' => null,
        ],
        605 => [
            'name' => 'Walnus',
            'min_sell_price' => 1000000,
        ],
    ];

    public static function vehicleValidate(int $vehicleId): bool
    {
        if (array_key_exists($vehicleId, self::VEHICLE_LIST)) {
            return true;
        }

        return false;
    }

    public function getVehicleName(int $vehicleId): string
    {
        if (self::vehicleValidate($vehicleId)) {
            return (string) self::VEHICLE_LIST[$vehicleId]['name'];
        }

        return (string) $vehicleId;
    }

    public function getVehiclePrice(int $vehicleId): string
    {
        if (self::vehicleValidate($vehicleId)) {
            return (string) self::VEHICLE_LIST[$vehicleId]['min_sell_price'];
        }

        return (string) null;
    }
}
