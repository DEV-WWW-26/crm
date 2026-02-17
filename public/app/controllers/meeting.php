<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/CompanyService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Company.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Address.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/City.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use app\models\Address;
use app\models\City;
use app\models\Company;
use app\services\CompanyService;

/*print_r($_POST);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$companyService = new CompanyService();
$city = new City();
$city->setName($_POST["city"]);
$address = new Address($city, $_POST["street"], $_POST["building"]);
$company = new Company($address, $_POST["categories"], $_POST["title"], $_POST["email"], $_POST["phone"]);
$companyService->addCompany($company);

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
