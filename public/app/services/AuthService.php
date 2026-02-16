<?php

namespace App\Service;

include_once __DIR__."/DbService.php";
include_once __DIR__."/Alert.php";

use App\Model\User;
use app\services\Alert;

class AuthService
{

    private $db;

    /**
     * @param $db
     */
    public function __construct()
    {
        $this->db = new DbService();
    }

    public function isAnyLogged(): bool
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {

            return false;
        }

        return true;
    }

    public function registerUser(User $user): void
    {
        try {
            $stmt = $this->db->getConnection()->prepare("insert into users (first_name, last_name, email, password) values (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword());
            $stmt->execute();
        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        }
    }

    public function loginUser(User $user): void {
        try {
            $stmt = $this->db->getConnection()->prepare("select * from users u WHERE u.email  = ? AND u.password = ?");
            $stmt->bind_param("ss", $user->getEmail(), $user->getPassword());
            if ($stmt->execute()) {
                $_SERVER['PHP_AUTH_USER'] = $user->getEmail();
                Alert::ok("Login successful!");
            } else {
                Alert::err("Login failed");
            }
        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        }
    }
}

?>