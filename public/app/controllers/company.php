<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/CompanyService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/NavigatorService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/SystemService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Company.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Address.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/City.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use app\models\Address;
use app\models\City;
use app\models\Company;
use app\services\CompanyService;
use app\services\NavigatorService;
use app\services\SystemService;


$systemService = new SystemService();
/*$systemService->printPostVar($_POST);
$systemService->displayAllErrors();*/

$companyService = new CompanyService();
$city = new City();
$city->setName($_POST["city"]);
$address = new Address($city, $_POST["street"], $_POST["building"]);
$company = new Company($address, $_POST["categories"], $_POST["title"], $_POST["email"], $_POST["phone"]);
$companyService->addCompany($company);

$navigatorService = new NavigatorService();

$navigatorService->goHome();

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
