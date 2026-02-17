<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/AuthService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/DbService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/User.php";

use App\Model\User;
use App\Service\AuthService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true); // true for associative array
    if ($data) {
        $authService = new AuthService();
        $user = new User(htmlspecialchars($data['firstName']), htmlspecialchars($data['lastName']), htmlspecialchars($data['email']),
            htmlspecialchars($data['password']));
        $authService->loginUser($user);
    } else {
        echo "Error: Invalid data received.";
    }
} else {
    header('HTTP/1.0 403 Forbidden');
    echo "You are not allowed to access this page directly.";
}