<?php
namespace App\Service;

use App\Config\DbConfig;
use PDO;
use PDOException;

class DbService
{

    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {

        try {
            $this->connection = new PDO('mysql:host=' . DbConfig::$server . ';dbname=' . DbConfig::$db, DbConfig::$user, DbConfig::$pass);
        } catch (PDOException $e) {
            // attempt to retry the connection after some timeout for example
        }
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        if (isset($_SESSION["connection"])) {
            $this->connection = $_SESSION["connection"];
        } else {
            $this->connect();
            $_SESSION["connection"] = $this->connection;
        }

        return $this->connection;
    }

}