<?php

namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/MeetingReport.php";

use app\models\MeetingReport;
use app\services\DbService;

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
        try {
            $stmt = $this->dbService->getConnection()->prepare("insert into meeting_reports (company_id, status_id,
                             type_id, user_id, title, description, scheduled) values (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiisss", $meeting->getCompanyId(), $meeting->getStatusId(), $meeting->getTypeId(),
            $meeting->getUserId(), $meeting->getTitle(), $meeting->getDescription(), $meeting->getScheduled()->format('Y-m-d H:i:s'));
            $stmt->execute();

            Alert::ok('The meeting report saved successfully');

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->dbService->closeConnection();
        }
    }

    public function getAllReports(): ?string {
        try {
            // todo move queries to static strings
            $res = $this->dbService->getConnection()->query("select * from meeting_reports_view");
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
}