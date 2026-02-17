<?php
namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";

use app\models\Address;
use App\Service\DbService;

class AddressService
{
    private $db;

    public function __construct()
    {
        $this->db = new DbService();
    }

    public function registerAddress(Address $address): void {
        try {
            // todo move queries to static strings
            $stmt = $this->db->getConnection()->prepare("insert into cities (city) values (?)");
            $stmt->bind_param("s", $address->getCity()->getName());
            $stmt->execute();

            $cityId = $this->db->getConnection()->insert_id;

            $stmt = $this->db->getConnection()->prepare("insert into addres (city_id, street, building) values (?, ?, ?)");
            $stmt->bind_param("iss", $cityId, $address->getStreet(), $address->getBuilding());
            $stmt->execute();

            Alert::ok('Address registered successfully');

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $this->db->closeConnection();
        }
    }
}