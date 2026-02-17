<?php

namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/MeetingReport.php";

use app\models\MeetingReport;
use App\Service\DbService;

class MeetingService
{

    private $dbService;

    public function __construct()
    {
        $this->dbService = new DbService();
    }

    public function saveReport(MeetingReport $meeting): int
    {
        return 0;
    }
}