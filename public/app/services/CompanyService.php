<?php

namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/AddressService.php";
include_once __DIR__ . "/Alert.php";

use app\models\Company;
use App\Service\DbService;

class CompanyService
{

    private $dbService;
    private $addressService;

    public function __construct()
    {
        $this->dbService = new DbService();
        $this->addressService = new AddressService();
    }

    public function addCompany(Company $company)
    {
        try {
            $addressId = $this->addressService->registerAddress($company->getAddress());

            if ($addressId == 0) {

               throw new \Exception('Couldn\'t get address ID, address adding error');
            }

            $stmt = $this->dbService->getConnection()->prepare("insert into companies (address_id, category_id, title, email,
                       phone) values (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $addressId, $company->getCategoryId(), $company->getTitle(), $company->getEmail(),
                $company->getPhone());
            $stmt->execute();

            Alert::ok('The company registered successfully');

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->dbService->closeConnection();
        }
    }

    public function getCompanies() {
        try {
            // todo move queries to static strings
            $res = $this->db->getConnection()->query("select id, title from companies");
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
}
