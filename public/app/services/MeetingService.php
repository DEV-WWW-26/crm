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

    public function loadMeetingStatuses(): ?string
    {
        try {
            // todo move queries to static strings
            $res = $this->dbService->getConnection()->query("select id, name from meeting_status");
            $data = array();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $data[] = $row;
                }

                return json_encode($data, JSON_UNESCAPED_UNICODE);
            }

            return null;

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->dbService->closeConnection();
        }

        return null;
    }

    public function loadMeetingTypes(): ?string
    {
        try {
            // todo move queries to static strings
            $res = $this->dbService->getConnection()->query("select id, name from meeting_types");
            $data = array();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $data[] = $row;
                }

                return json_encode($data, JSON_UNESCAPED_UNICODE);
            }

            return null;

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->dbService->closeConnection();
        }

        return null;
    }

    public function saveReport(MeetingReport $meeting): void
    {
    }
}