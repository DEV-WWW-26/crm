<?php
namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/City.php";

use app\models\Address;
use app\models\City;
use App\Service\DbService;

class AddressService
{
    private $db;

    public function __construct()
    {
        $this->db = new DbService();
    }

    public function registerAddress(Address $address): int {
        try {
            // todo move queries to static strings

            $cityId = 0;

            try {
                $stmt = $this->db->getConnection()->prepare("insert into cities (city) values (?)");
                $stmt->bind_param("s", $address->getCity()->getName());
                $stmt->execute();

                $cityId = $this->db->getConnection()->insert_id;

            } catch (\Exception $e) {
                if (str_contains($e->getMessage(), 'Duplicate entry')) {
                    $city = $this->getCityByName($address->getCity()->getName());
                    $cityId = $city->getId();
                }
            } finally {
                $stmt->close();
            }

            $stmt = $this->db->getConnection()->prepare("insert into address (city_id, street, building) values (?, ?, ?)");
            $stmt->bind_param("iss", $cityId, $address->getStreet(), $address->getBuilding());
            $stmt->execute();

            Alert::ok('Address registered successfully');

            return $this->db->getConnection()->insert_id;

        } catch (\Exception $e) {
            Alert::err($e->getMessage());
        } finally {
            $stmt->close();
        }

        return 0;
    }

    public function getCityById(int $id) : ?City{
        try {
            // todo move queries to static strings
            $res = $this->db->getConnection()->query("select id, city from cities where id = $id");
            $c = new City();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $c->setId($row['id']);
                    $c->setName($row['city']);
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

    public function getCityByName(string $name) : ?City{
        try {
            // todo move queries to static strings
            $res = $this->db->getConnection()->query("select id, city from cities where city = '$name'");
            $c = new City();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $c->setId($row['id']);
                    $c->setName($row['city']);
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