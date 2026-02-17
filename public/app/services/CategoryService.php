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
            $res = $this->db->getConnection()->query("select * from categories");
            $data = array();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            $json_output = json_encode($data);

            echo $json_output;

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }
    }
}