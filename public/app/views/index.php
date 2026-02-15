<?php

use app\services\AuthService;

include 'app/views/header.html';

session_start();

$authService = new AuthService();
if (!$authService->isAnyLogged()) {
    include('app/views/welcome.php');
} else {
    include('app/views/navigation.html');
}

include 'app/views/footer.html';