<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/MeetingService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/AuthService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/NavigatorService.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/MeetingReport.php";

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';

use app\models\MeetingReport;
use app\services\MeetingService;
use app\services\AuthService;
use app\services\NavigatorService;

$authService = new AuthService();
$userId = $authService->getLoggedUserId();

$meeting = new MeetingReport();
$meeting->setUserId($userId);
$meeting->setCompanyId($_POST["companies"]);
$meeting->setStatusId($_POST["status"]);
$meeting->setTypeId($_POST["type"]);
$meeting->setDescription($_POST["details"]);
$meeting->setTitle($_POST["title"]);
$meeting->setScheduled(new DateTime($_POST["datetime"]));

$meetingService = new MeetingService();
$meetingService->saveReport($meeting);

$navigatorService = new NavigatorService();
$navigatorService->goHome();

include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
