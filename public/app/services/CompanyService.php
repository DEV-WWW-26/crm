<?php

namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/AddressService.php";
include_once __DIR__ . "/Alert.php";

use app\models\Company;
use app\services\DbService;

class CompanyService
{

    private $dbService;
    private $addressService;

    public function __construct()
    {
        $this->dbService = new DbService();
        $this->addressService = new AddressService();
    }

    public function addCompany(Company $company): void
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

    public function getCompanies(): ?string
    {
        try {
            // todo move queries to static strings
            $res = $this->dbService->getConnection()->query("select id, title from companies");
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

    public function getCompanyById(int $id): ?string
    {
        try {
            $stmt = $this->dbService->getConnection()->prepare('
            select c.title, c.email, c.phone, c3.city, a.street, a.building, c2.category from companies c
                left join categories c2 on c2.id = c.category_id 
                left join address a on a.id = c.address_id 
                left join cities c3 on c3.id = a.city_id 
            where 
                c.id = ?');
            if ($stmt) {
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }

                    return json_encode($data, JSON_UNESCAPED_UNICODE);
                }
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
