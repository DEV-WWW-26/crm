<?php
include_once $_SERVER['DOCUMENT_ROOT']."/app/services/AuthService.php";

use App\Service\AuthService;

include 'app/views/header.html';

if (session_status() === PHP_SESSION_ACTIVE) {
    // Session is active
} else {
    session_start();
}


$authService = new AuthService();
if (!$authService->isAnyLogged()) {
    include('app/views/welcome.php');
} else {
    include('app/views/navigation.html');
}

include 'app/views/footer.html';
