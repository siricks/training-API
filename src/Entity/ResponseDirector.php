<?php


namespace src\Entity;

use src\Entity\TariffsResponse;

/**
 * Class ResponseDirector
 * @package src\Entity
 */
class ResponseDirector
{
    /**
     * Build response to get tariff
     *
     * @param Tariff $currentTariff
     * @param array $tariffs
     * @return false|string
     */
    public function buildGetTariffResponse(Tariff $currentTariff, array $tariffs)
    {
        $response = new TariffsResponse();

        if ($currentTariff && $tariffs) {
            $response->setTarifs(
                [
                    "title" => $currentTariff->getTitle(),
                    "link" => $currentTariff->getLink(),
                    "speed" => $currentTariff->getSpeed(),
                    'tarifs' => $tariffs
                ]
            );
            $response->setResult(TariffsResponse::STATUS_OK);
        } else {
            $response->setResult(TariffsResponse::STATUS_ERROR);
        }

        return $this->renderJsonResponse($response);
    }

    /**
     * Build response with only result
     *
     * @param $result
     * @return false|string
     */
    public function buildResponse($result)
    {
        $response = new TariffsResponse();
        $response->setResult($result);
        return $this->renderJsonResponse($response);
    }

    /**
     * @param TariffsResponse $response
     * @return false|string
     */
    private function renderJsonResponse(TariffsResponse $response)
    {
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}
