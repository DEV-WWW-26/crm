<?php

namespace App\Config;

class DbConfig {
    private $server;
    private $user;
    private $pass;
    private $db;

    public function __construct()
    {
        $server = getenv(EnvVars::host);
        if ($server) {

        } else {
            printEvError(EnvVars::host);
        }
        $db = getenv(EnvVars::db);
        if ($db) {

        } else {
            printEvError(EnvVars::db);
        }
        $user = getenv(EnvVars::user);
        if ($user) {

        } else {
            printEvError(EnvVars::user);
        }
        $pass = getenv(EnvVars::pass);
        if ($pass) {

        } else {
            printEvError(EnvVars::pass);
        }
    }

    private function printEvError($var) {
        echo $var.' environment variable not set or not accessible via getenv().\n';
    }

}