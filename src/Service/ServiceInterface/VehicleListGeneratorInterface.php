<?php

namespace App\Service\ServiceInterface;

interface VehicleListGeneratorInterface
{
    public static function vehicleValidate(int $vehicleId): bool;

    public function getVehicleName(int $vehicleId): string;

    public function getVehiclePrice(int $vehicleId): string;
}