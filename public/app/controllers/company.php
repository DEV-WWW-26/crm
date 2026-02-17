<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/DbService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/CompanyService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Company.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Address.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/City.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use app\models\Address;
use app\models\Category;
use app\models\City;
use app\models\Company;
use app\services\CompanyService;

$companyService = new CompanyService();
$city = new City($_POST["city"]);
$address = new Address($city, $_POST["street"], $_POST["building"]);
$category = new Category($_POST["category"]);
$company = new Company($address, $category, $_POST["title"], $_POST["email"], $_POST["phone"]);

$companyService->addCompany($company);

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';