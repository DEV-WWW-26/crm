<?php
namespace app\models;

class Address extends Base
{
    private City $city;
    private string $street;
    private string $building;

    /**
     * @param $city
     * @param $street
     * @param $building
     */
    public function __construct(City $city, string $street, string $building)
    {
        parent::__construct();

        $this->city = $city;
        $this->street = $street;
        $this->building = $building;
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
}
