<?php

namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";

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
            // todo move queries to static strings
            $stmt = $this->db->getConnection()->prepare("insert into users (first_name, last_name, email, password) 
                values (?, ?, ?, md5(?))");
            $stmt->bind_param("ssss", $user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword());
            $stmt->execute();
            Alert::ok('Registered successfully');
        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }
    }

    public function loginUser(User $user): void
    {
        try {
            $stmt = $this->db->getConnection()->prepare("select * from users u WHERE u.email  = ? AND u.password = md5(?)");
            $stmt->bind_param("ss", $user->getEmail(), $user->getPassword());
            if ($stmt->execute()) {
                $stmt->store_result();
                $num_rows = $stmt->num_rows;
                // $num_rows = mysqli_stmt_num_rows($stmt);
                if ($num_rows > 0) {
                    $this->setLogged($user->getEmail());
                    Alert::ok("Login successful!");
                } else {
                    Alert::err("Login failed");
                }
            } else {
                Alert::err("Login failed");
            }
        } catch (\Exception $e) { // todo determine where catch Exception (views/locally)
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }
    }

    private function setLogged(string $email): void
    {
        setcookie('logged', 'ok', time() + (86400 * 1), "/"); // 1 day
        setcookie('email', $email, time() + (86400 * 1), "/"); // 1 day
    }

    public function isLogged(): bool
    {
        if (isset($_COOKIE["logged"])) {
            if ($_COOKIE["logged"] == "ok") {

                return true;
            }
        } else {

            return false;
        }

        return false;
    }

    private function getLoggedUserEmail(): ?string
    {
        if (isset($_COOKIE["email"])) {

            return $_COOKIE["email"];
        }

        return null;
    }

    public function getLoggedUserId(): ?int
    {
        try {
            $email = $this->getLoggedUserEmail();
            // todo move queries to static strings
            $res = $this->db->getConnection()->query("select id from users where email = $email");
            $id = 0;
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $id = $row['id'];
                }

                return $id;
            }

            return null;

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }

        return null;
    }


    public function logoutUser(): void
    {
        setcookie('logged', 'no', 1, "/");
        Alert::ok('Logged out successfully');
    }
}

?>