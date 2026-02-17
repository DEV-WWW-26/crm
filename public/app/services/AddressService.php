<?php
namespace app\services;

include_once __DIR__ . "/DbService.php";
include_once __DIR__ . "/Alert.php";

use App\Service\DbService;

class AddressService
{
    private $db;

    public function __construct()
    {
        $this->db = new DbService();
    }


}