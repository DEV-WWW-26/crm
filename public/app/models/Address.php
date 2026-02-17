<?php

namespace app\models;

class Address
{
    private $id;
    private $city;
    private $street;
    private $building;
    private $created;

    /**
     * @param $city
     * @param $street
     * @param $building
     */
    public function __construct(City $city, $street, $building)
    {
        $this->city = $city;
        $this->street = $street;
        $this->building = $building;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function setCity(City $city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param mixed $building
     */
    public function setBuilding($building): void
    {
        $this->building = $building;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }
}
