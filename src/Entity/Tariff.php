<?php

namespace src\Entity;

class Tariff implements \JsonSerializable
{
    private $ID;
    private $title;
    private $link;
    private $speed;
    private $pay_period;
    private $tarif_group_id;
    private $price;
    private $new_payday;

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getPayPeriod()
    {
        return $this->pay_period;
    }

    /**
     * @param mixed $pay_period
     */
    public function setPayPeriod($pay_period): void
    {
        $this->pay_period = $pay_period;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed): void
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getTarifGroupId()
    {
        return $this->tarif_group_id;
    }

    /**
     * @param mixed $tarif_group_id
     */
    public function setTarifGroupId($tarif_group_id): void
    {
        $this->tarif_group_id = $tarif_group_id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getNewPayday()
    {
        return $this->new_payday;
    }

    /**
     * @param mixed $new_payday
     */
    public function setNewPayday($new_payday): void
    {
        $this->new_payday = $new_payday;
    }

    /**
     * @param string $format
     * @return string
     * @throws \Exception
     */
    public function calcNewPayDay($format = 'UP')
    {
        $dateTime = new \DateTime();
        $dateTime->setTimestamp(date('U', strtotime('today')));
        $dateTime->modify('+' . $this->pay_period . ' day');
        return $dateTime->format($format);
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
