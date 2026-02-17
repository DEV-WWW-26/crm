<?php
namespace app\models;

include_once __DIR__ . "/Base.php";

class Category extends Base
{
    private string $category;

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
}
