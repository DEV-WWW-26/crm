<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/CategoryService.php";

use app\services\CategoryService;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $categoryService = new CategoryService();
    echo $categoryService->getCategories();
} else {
    header('HTTP/1.0 403 Forbidden');
    echo "You are not allowed to access this page directly.";
}