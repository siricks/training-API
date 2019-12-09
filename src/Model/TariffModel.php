<?php

namespace src\Model;

use src\Entity\Tariff;

/**
 * Class TariffModel
 * @package src\Model
 */
class TariffModel
{

    private $connector;

    public function __construct()
    {
        $this->connector = DataBaseConnector::getInstance();
    }

    /**
     * Find single by userId and service Id
     *
     * @param int $userId
     * @param int $serviceId
     *
     * @return Tariff | \stdClass
     */
    public function findOneByUserIdAndServiceId(int $userId, int $serviceId)
    {
        $stmt = $this->connector->prepare("SELECT t.* FROM tarifs t LEFT JOIN services s ON t.ID = s.tarif_id WHERE s.user_id = ? AND s.id = ?");
        $stmt->bind_param("ii", $userId, $serviceId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object(Tariff::class);
    }

    /**
     * Find tariffs by groupId
     *
     * @param int $groupId
     * @return array
     */
    public function findByGroupId(int $groupId)
    {
        $stmt = $this->connector->prepare("SELECT t.* FROM tarifs t WHERE t.tarif_group_id = ?");
        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_object(Tariff::class)) {
            $row->setNewPayday($row->calcNewPayDay());
            $results[] = $row;
        }
        return $results;
    }

    /**
     * Find single by ID
     *
     * @param $tariffId
     * @return object|\stdClass
     */
    public function findById(int $tariffId)
    {
        $stmt = $this->connector->prepare("SELECT * FROM tarifs WHERE ID = ? LIMIT 1");
        $stmt->bind_param("i", $tariffId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object(Tariff::class);
    }

}
