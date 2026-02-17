<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/DbService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Company.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use App\Model\User;
use App\Service\AuthService;

$authService = new AuthService();
$user = new User($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
$authService->registerUser($user);

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';