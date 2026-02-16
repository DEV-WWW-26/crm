<?php
namespace App\Service;

include_once $_SERVER['DOCUMENT_ROOT']."/app/config/db/DbConfig.php";

use App\Config\DbConfig;
use PDO;
use PDOException;

class DbService
{

    private $connection;
    private $config;

    public function __construct()
    {
        $this->config = new DbConfig();
        $this->connect();
    }

    public function connect()
    {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=' . $this->config->getDb(),
                $this->config->getUser(), $this->config->getPass());
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