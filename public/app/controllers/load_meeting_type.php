<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/services/MeetingService.php";

use app\services\MeetingService;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $meetingService = new MeetingService();
    echo $meetingService->loadMeetingTypes();
} else {
    header('HTTP/1.0 403 Forbidden');
    echo "You are not allowed to access this page directly.";
}