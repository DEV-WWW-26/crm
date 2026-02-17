<?php

namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Category.php";

use app\models\Category;
use app\services\DbService;

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

                return json_encode($data, JSON_UNESCAPED_UNICODE);
            }

            return null;

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }

        return null;
    }

    public function getById(int $id) : ?Category{
        try {
            // todo move queries to static strings
            $res = $this->db->getConnection()->query("select id, category from categories where id = $id");
            $c = new Category();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $c->setId($row['id']);
                    $c->setCategory($row['category']);
                }

                return $c;
            }

            return null;

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }

        return null;
    }
}
