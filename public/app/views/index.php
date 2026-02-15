<?php
include 'app/views/header.html';

use auth\AuthService;

session_start();

$authService = new AuthService();
if (!$authService->isAnyLogged()) {
    include('app/views/welcome.php');
} else {
    include('app/views/navigation.html');
}

include 'app/views/footer.html';