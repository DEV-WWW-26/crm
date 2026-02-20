<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/AuthService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/NavigatorService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/User.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use App\Model\User;
use app\services\AuthService;
use app\services\NavigatorService;

$authService = new AuthService();
$user = new User('fake', 'fake', $_POST["email"], $_POST["password"]);
$authService->loginUser($user);

$navigatorService = new NavigatorService();
$navigatorService->goHome();

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';