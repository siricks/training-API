<?php

namespace src\Entity;

/**
 * Class TariffsResponse
 * @package src\Entity
 */
class TariffsResponse implements \JsonSerializable
{
    /**
     * Response results
     */
    const STATUS_OK = 'ok';
    const STATUS_ERROR = 'error';

    private $result;
    private $tarifs;

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result): void
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getTarifs()
    {
        return $this->tarifs;
    }

    /**
     * @param mixed $tarifs
     */
    public function setTarifs($tarifs): void
    {
        $this->tarifs = $tarifs;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        $vars = array_filter(get_object_vars($this));

        return $vars;
    }
}

