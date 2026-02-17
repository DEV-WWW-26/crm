<?php

use app\services\AuthService;

include_once $_SERVER['DOCUMENT_ROOT']."/app/services/AuthService.php";

include 'app/views/header.html';

if (session_status() === PHP_SESSION_ACTIVE) {
    // Session is active
} else {
    session_start();
}

$authService = new AuthService();
if (!$authService->isLogged()) {
    include('app/views/welcome.php');
} else {
    include('app/views/navigation.html');
}

include 'app/views/footer.html';
