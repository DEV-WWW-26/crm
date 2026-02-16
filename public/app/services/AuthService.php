<?php
namespace App\Service;

include_once __DIR__."/DbService.php";

use App\Model\User;

class AuthService {

    private $db;

    /**
     * @param $db
     */
    public function __construct()
    {
        $this->db = new DbService();
    }

    public function isAnyLogged() {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {

            return false;
        }

        return true;
    }

    public function registerUser(User $user) {
        try {
            $stmt = $this->db->getConnection()->prepare("insert into users (first_name, last_name, email, password) values (?, ?, ?, ?)");
            $stmt->bind_param("sss", $user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword());
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }
}