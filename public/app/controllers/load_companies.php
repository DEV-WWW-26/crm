<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/CompanyService.php";

use app\services\CompanyService;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $companyService = new CompanyService();
    echo $companyService->getCompanies();
} else {
    header('HTTP/1.0 403 Forbidden');
    echo "You are not allowed to access this page directly.";
}