<?php

namespace App\Service;

include_once $_SERVER['DOCUMENT_ROOT'] . "/app/config/db/DbConfig.php";

use App\Config\DbConfig;
use mysqli;

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
            // $user = $this->config->getUser();
            $user = $this->config->getUser() . '@%';
            echo '<p>User: ' . $user . '</p>';
            echo '<p>Server: ' . $this->config->getServer() . '</p>';
            echo '<p>Db: ' . $this->config->getDb() . '</p>';
            echo '<p>pass: ' . $this->config->getPass() . '</p>';
            $this->connection = new mysqli($this->config->getServer(), $this->config->getUser(), $this->config->getPass(), $this->config->getDb());
        } catch (\Exception $e) {
            exit("An error occurred on creating DB connection: " . $e->getMessage());
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