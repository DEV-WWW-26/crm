<?php

namespace app\services;

class SystemService
{
    public function displayAllErrors(): void
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    public function printPostVar($var): void
    {
        print_r($_POST);
    }

    public function startSession(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
