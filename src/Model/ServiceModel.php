<?php

namespace src\Model;

/**
 * Class ServiceModel
 * @package src\Model
 */
class ServiceModel
{

    private $connector;

    public function __construct()
    {
        $this->connector = DataBaseConnector::getInstance();
    }

    /**
     * Set tarif_id and payDay to service
     *
     * @param int $tariffId
     * @param string $payDay
     * @param int $serviceId
     * @param int $userId
     * @return bool
     */
    public function updateService(int $tariffId, string $payDay, int $serviceId, int $userId)
    {
        $stmt = $this->connector->prepare('UPDATE services SET tarif_id = ?, payday = STR_TO_DATE(?, \'%Y-%m-%d\') WHERE ID = ? AND user_id = ?');
        $stmt->bind_param('isii', $tariffId, $payDay, $serviceId, $userId);
        return $stmt->execute();
    }

    /**
     * Get single service
     *
     * @param $serviceId
     * @return object|\stdClass
     */
    public function findById(int $serviceId)
    {
        $stmt = $this->connector->prepare("SELECT * FROM services WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $serviceId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }
}
