<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/AuthService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/DbService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/User.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use App\Model\User;
use App\Service\AuthService;

$authService = new AuthService();
$user = new User('fake', 'fake', $_POST["email"], $_POST["password"]);
$authService->loginUser($user);

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';