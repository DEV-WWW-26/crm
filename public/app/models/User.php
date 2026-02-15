<?php

namespace App\Models;

class User {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;

    /**
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     */
    public function __construct($firstName, $lastName, $email, $password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $this->encodePassword($password);
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    private function encodePassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
