<?php

namespace app\services;

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
        $this->connect();

        return $this->connection;
    }

    public function closeConnection()
    {
        $this->connection->close();
    }

}