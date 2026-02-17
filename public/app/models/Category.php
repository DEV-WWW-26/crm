<?php

namespace app\models;

class Category
{
    private int $id;
    private string $category;

    /**
     * @param $category
     */
    public function __construct(string $category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getId(): int
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
}
