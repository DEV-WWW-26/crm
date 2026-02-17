<?php

namespace app\models;

class City
{
    private int $id;
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}
