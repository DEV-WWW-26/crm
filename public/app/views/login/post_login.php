<?php
include_once $_SERVER['DOCUMENT_ROOT']."/app/services/AuthService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/app/services/DbService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/app/services/Alert.php";
include_once $_SERVER['DOCUMENT_ROOT']."/app/models/User.php";

include $_SERVER['DOCUMENT_ROOT'].'/app/views/header.html';

use App\Model\User;
use App\Service\AuthService;
use app\services\Alert;

$authService = new AuthService();
$user = new User($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
try {
    $authService->registerUser($user);
} catch (Exception $ex) {
    Alert::err($ex->getMessage());
}

include $_SERVER['DOCUMENT_ROOT'].'/app/views/footer.html';