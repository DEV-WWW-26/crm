<?php

namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";

use app\models\Company;
use App\Service\DbService;

class CompanyService
{

    private $db;

    public function __construct()
    {
        $this->db = new DbService();
    }

    public function addCompany(Company $company) {
        try {

            $stmt = $this->db->getConnection()->prepare("insert into users (first_name, last_name, email, password) 
                values (?, ?, ?, md5(?))");
            $stmt->bind_param("ssss", $user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword());
            $stmt->execute();
            Alert::ok('Registered successfully');
        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }
    }
}
