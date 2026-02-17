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

    public function addCompany(Company $company) {
        try {
            $addressId = $this->addressService->registerAddress($company->getAddress());
            $stmt = $this->dbService->getConnection()->prepare("insert into companies (address_id, category_id, title, email,
                       phone) values (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $addressId, $company->getCategory(), $company->getTitle(), $company->getEmail(),);
            $stmt->execute();
            Alert::ok('Registered successfully');
        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->dbService->closeConnection();
        }
    }
}
