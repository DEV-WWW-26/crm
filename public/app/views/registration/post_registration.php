<?php

include_once $_SERVER['DOCUMENT_ROOT']."/app/services/AuthService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/app/services/DbService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/app/models/User.php";

use App\Model\User;
use App\Service\AuthService;

$authService = new AuthService();
$user = new User($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
$authService->registerUser($user);

