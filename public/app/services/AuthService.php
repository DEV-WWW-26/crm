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
                $stmt->store_result();
                $num_rows = $stmt->num_rows; // or mysqli_stmt_num_rows($stmt)
                if ($num_rows > 0) {
                    $this->setLogged();
                    Alert::ok("Login successful!");
                } else {
                    Alert::err("Login failed");
                }
            } else {
                Alert::err("Login failed");
            }
        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        }
    }

    private function setLogged():void {
        setcookie('logged', 'ok', time() + (86400 * 1), "/"); // 1 day
    }

    public function isLogged():bool {
        if (isset($_COOKIE["logged"])) {
            if ($_COOKIE["logged"] == "ok") {

              return true;
            }
        } else {

            return false;
        }

        return false;
    }
}

?>