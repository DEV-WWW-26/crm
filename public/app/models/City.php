<?php

namespace app\models;

class City
{
    private $id;
    private $city;

    /**
     * @param $city
     */
    public function __construct($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }
}