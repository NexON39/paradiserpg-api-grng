<?php

namespace App\Controller;

use App\Api\ApiInterface\DiscordApiWebhookRequestInterface;
use App\Api\ApiInterface\ParadiseApiLoginRequestInterface;
use App\Api\ApiInterface\ParadiseApiWarehouseRequestInterface;
use App\Service\CalculatedPriceGenerator;
use App\Service\ServiceInterface\CalculatedPriceGeneratorInterface;
use App\Service\ServiceInterface\DiscordLinkGeneratorInterface;
use App\Service\ServiceInterface\VehicleListGeneratorInterface;
use App\Service\VehicleListGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParadiseApiFetchController extends AbstractController
{
    private ParadiseApiLoginRequestInterface $paradiseApiLoginRequest;
    private ParadiseApiWarehouseRequestInterface $paradiseApiWarehouseRequest;
    private CalculatedPriceGeneratorInterface $calculatedPriceGenerator;
    private VehicleListGeneratorInterface $vehicleListGenerator;
    private DiscordApiWebhookRequestInterface $discordApiWebhookRequest;
    private DiscordLinkGeneratorInterface $discordLinkGenerator;

    public function __construct(
        ParadiseApiLoginRequestInterface $paradiseApiLoginRequest,
        ParadiseApiWarehouseRequestInterface $paradiseApiWarehouseRequest,
        CalculatedPriceGeneratorInterface $calculatedPriceGenerator,
        VehicleListGeneratorInterface $vehicleListGenerator,
        DiscordApiWebhookRequestInterface $discordApiWebhookRequest,
        DiscordLinkGeneratorInterface $discordLinkGenerator,
    ){
        $this->paradiseApiLoginRequest = $paradiseApiLoginRequest;
        $this->paradiseApiWarehouseRequest = $paradiseApiWarehouseRequest;
        $this->calculatedPriceGenerator = $calculatedPriceGenerator;
        $this->vehicleListGenerator = $vehicleListGenerator;
        $this->discordApiWebhookRequest = $discordApiWebhookRequest;
        $this->discordLinkGenerator = $discordLinkGenerator;
    }

    #[Route('/paradise/api/fetch/warehouse/vehicles', name: 'app_paradise_api_fetch_warehouse_vehicles')]
    public function fetchMagazineCondition(): Response
    {
        $token = $this->paradiseApiLoginRequest->fetchParadiseApiUserToken();

        $warehouseCondidion = $this->paradiseApiWarehouseRequest->fetchParadiseApiWarehouseData($token);

        $alertInfo = [
            'body' => [
                'content' => 'Aktualny stan pojazdów w magazynie:'
            ]
        ];

        $this->discordApiWebhookRequest->postDiscordWebhookData($this->discordLinkGenerator->getDiscordMagazineInfoUrl(), $alertInfo);

        foreach ($warehouseCondidion['warehouse']['warehouse']['vehicles'] as $vehicle) {
            $data = [
                'json' => [
                    'embeds' => [
                        [
                            'title' => $this->vehicleListGenerator->getVehicleName($vehicle['vehicle_model']),
                            'description' => 'Aktualna cena pojazdu: ' . $vehicle['vehicle_price'] . '$' . "\n" . '3% aktualnej ceny pojazdu: ' . $this->calculatedPriceGenerator->getCalculatedPriceByPercent((int)$vehicle['vehicle_price'], 3) . '$' . "\n" . '4% aktualnej ceny pojazdu: ' . $this->calculatedPriceGenerator->getCalculatedPriceByPercent((int)$vehicle['vehicle_price'], 4) . '$',
                            'color' => 16776701
                        ]
                    ]
                ]
            ];

//            var_dump($data);
            $this->discordApiWebhookRequest->postDiscordWebhookData($this->discordLinkGenerator->getDiscordMagazineInfoUrl(), $data);

            sleep(1);
        }

        return new Response(Response::HTTP_OK);
    }

    #[Route('/paradise/api/fetch/warehouse/vehicles/export', name: 'app_paradise_api_fetch_warehouse_vehicles_export')]
    public function fetchMagazineVehiclesReadyToExport(): Response
    {
        $token = $this->paradiseApiLoginRequest->fetchParadiseApiUserToken();

        $data = $this->paradiseApiWarehouseRequest->fetchParadiseApiWarehouseData($token);

        foreach ($data['warehouse']['warehouse']['vehicles'] as $vehicle) {
            if((int)$vehicle['vehicle_price'] >= $this->vehicleListGenerator->getVehiclePrice((int)$vehicle['vehicle_model'])) {

                $alertInfo = [
                    'body' => [
                        'content' => 'Warto exportować:'
                    ]
                ];

                $this->discordApiWebhookRequest->postDiscordWebhookData($this->discordLinkGenerator->getDiscordExportInfoUrl(), $alertInfo);

                $data = [
                    'json' => [
                        'embeds' => [
                            [
                                'title' => $this->vehicleListGenerator->getVehicleName($vehicle['vehicle_model']),
                                'description' => 'Aktualna cena pojazdu: ' . $vehicle['vehicle_price'] . '$' . "\n" . '3% aktualnej ceny pojazdu: ' . $this->calculatedPriceGenerator->getCalculatedPriceByPercent((int)$vehicle['vehicle_price'], 3) . '$' . "\n" . '4% aktualnej ceny pojazdu: ' . $this->calculatedPriceGenerator->getCalculatedPriceByPercent((int)$vehicle['vehicle_price'], 4) . '$',
                                'color' => 16776701
                            ]
                        ]
                    ]
                ];

                $this->discordApiWebhookRequest->postDiscordWebhookData($this->discordLinkGenerator->getDiscordExportInfoUrl(), $data);

                sleep(1);
            }
        }

        return new Response(Response::HTTP_OK);
    }

    #[Route('/paradise/api/fetch/warehouse/expiry', name: 'app_paradise_api_fetch_warehouse_expiry')]
    public function fetchMagazineExpiry(): Response
    {
        $token = $this->paradiseApiLoginRequest->fetchParadiseApiUserToken();

        $data = $this->paradiseApiWarehouseRequest->fetchParadiseApiWarehouseData($token);

        $data = [
            'json' => [
                'embeds' => [
                    [
                        'title' => 'Data wygaśnięcia magazynu:',
                        'description' => 'Magazyn wygasa: ' . date('d-m-Y H:i:s', (int)$data['warehouse']['expires']),
                        'color' => 16776701
                    ]
                ]
            ]
        ];

        $this->discordApiWebhookRequest->postDiscordWebhookData($this->discordLinkGenerator->getDiscordMagazineExpiryInfoUrl(), $data);

        return new Response(Response::HTTP_OK);
    }
}
