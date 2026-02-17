<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/DbService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/CompanyService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Company.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use app\models\Company;
use app\services\CompanyService;

$companyService = new CompanyService();
$user = new User($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
$company = new Company();

$companyService->addCompany($company);

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';