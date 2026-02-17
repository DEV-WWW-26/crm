<?php

namespace App\Model;

include_once __DIR__ . "/Base.php";

use app\models\Base;

class User extends Base {
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     */
    public function __construct(string $firstName, string $lastName, string $email, string $password)
    {
        parent::__construct();

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword() : string
    {
        return $this->password;
    }
}
