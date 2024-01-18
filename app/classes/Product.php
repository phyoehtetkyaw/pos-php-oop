<?php

require_once "DB.php";

class Product {

    private $con;

    public function __construct() {
        try {
            $db = new DB();
            $this->con = $db->connect();
        } catch (PDOException $e) {
            die("ERROR IN CONNECTION!");
        }
    }
}

?>