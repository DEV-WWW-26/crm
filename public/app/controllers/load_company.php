<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/CompanyService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/SystemService.php";

use app\services\CompanyService;
use app\services\SystemService;

// $systemService = new SystemService();
// $systemService->displayAllErrors();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $companyService = new CompanyService();
    echo $companyService->getCompanyById(intval($_GET["id"]));
} else {
    header('HTTP/1.0 403 Forbidden');
    echo "You are not allowed to access this page directly.";
}
