<?php

namespace App\Config;

use config\db\EnvironmentVarsEnum as env;

include_once __DIR__ . "/EnvironmentEnum.php";

class DbConfig
{
    private $server;
    private $user;
    private $pass;
    private $db;

    public function __construct()
    {
        $db = getenv(env::db->value);
        if ($db) {

        } else {
            $this->printEvError(env::db->value);
        }
        $user = getenv(env::user->value);
        if ($user) {

        } else {
            $this->printEvError(env::user->value);
        }
        $pass = getenv(env::pass->value);
        if ($pass) {

        } else {
            $this->printEvError(env::pass->value);
        }
    }

    private function printEvError($var)
    {
        echo $var . ' environment variable not set or not accessible via getenv().\n';
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }
}
