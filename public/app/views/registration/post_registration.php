<?php

use App\Services\AuthService;
use models\User;

require '../../services/AuthService.php';
require '../../services/DbService.php';

$authService = new AuthService();
$user = new User($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
$authService->registerUser($user);
