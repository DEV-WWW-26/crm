<?php

namespace app\models;

use DateTime;

class Address
{
    private int $id;
    private City $city;
    private string $street;
    private string $building;
    private DateTime $created;

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
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getBuilding() : string
    {
        return $this->building;
    }

    /**
     * @param mixed $building
     */
    public function setBuilding(string $building): void
    {
        $this->building = $building;
    }

    /**
     * @return mixed
     */
    public function getCreated():DateTime
    {
        return $this->created;
    }
}
