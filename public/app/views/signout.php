<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/AuthService.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use app\services\AuthService;

$authService = new AuthService();
$authService->logoutUser();

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
