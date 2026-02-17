<?php

namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";

use App\Service\DbService;

class CategoryService
{

    private $db;

    /**
     * @param $db
     */
    public function __construct()
    {
        $this->db = new DbService();
    }

    public function getCategories()
    {
        try {
            // todo move queries to static strings
            $res = $this->db->getConnection()->query("select id, category from categories");
            $data = array();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            return json_encode($data, JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }

        return null;
    }
}