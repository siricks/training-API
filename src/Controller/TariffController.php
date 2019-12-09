<?php

namespace src\Controller;

use src\Entity\ResponseDirector;
use src\Model\ServiceModel;
use src\Model\TariffModel;
use src\Entity\TariffsResponse;

class TariffController
{
    /**
     * Get current tariff and tariffs from the group
     *
     * @param int $userId
     * @param int $serviceId
     */
    public function getTariffByUserId(int $userId, int $serviceId): void
    {
        $response = new ResponseDirector();

        try {
            $repository = new TariffModel();
            $currentTariff = $repository->findOneByUserIdAndServiceId($userId, $serviceId);
            if (!$currentTariff) {
                throw new \Exception('Tariff not found!');
            }
            $tariffs = $repository->findByGroupId($currentTariff->getTarifGroupId());
            echo $response->buildGetTariffResponse($currentTariff, $tariffs);

        } catch (\Exception $e) {
            echo $response->buildResponse(TariffsResponse::STATUS_ERROR);
        }
    }

    /**
     * Update tariff
     *
     * @param int $userId
     * @param int $serviceId
     * @param int $tariffId
     * @throws \Exception
     */
    public function updateTariffForUser(int $userId, int $serviceId, int $tariffId): void
    {
        $response = new ResponseDirector();

        try {
            $tariffRepository = new TariffModel();
            $tariff = $tariffRepository->findById($tariffId);
            if (!$tariff) {
                throw new \Exception('Tariff not found!');
            }
            $newPayday = $tariff->calcNewPayDay('Y-m-d');

            $serviceRepository = new ServiceModel();
            $service = $serviceRepository->findById($serviceId);
            if (!isset($service->ID)) {
                throw new \Exception('Service not found!');
            }

            if ($serviceRepository->updateService($serviceId, $newPayday, $tariff->getID(), $userId)) {
                echo $response->buildResponse(TariffsResponse::STATUS_OK);
            }

        } catch (\Exception $e) {
            echo $response->buildResponse(TariffsResponse::STATUS_ERROR);
        }

    }

}
