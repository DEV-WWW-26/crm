<?php

use app\services\AuthService;
use app\services\SystemService;

include_once $_SERVER['DOCUMENT_ROOT']."/app/services/AuthService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/app/services/SystemService.php";

include 'app/views/header.html';

$authService = new AuthService();
$systemService = new SystemService();
$systemService->displayAllErrors();
$systemService->startSession();

if (!$authService->isLogged()) {
    include('app/views/welcome.php');
} else {
    include('app/views/navigation.html');
}

include 'app/views/footer.html';
