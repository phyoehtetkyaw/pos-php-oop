<?php

require_once "DB.php";

class ProductCategory {

    private $con;

    public function __construct() {
        try {
            $db = new DB();
            $this->con = $db->connect();
        } catch (PDOException $e) {
            die("ERROR IN CONNECTION!");
        }
    }

    public function getAll() : iterable{
        try {
            $sql = "SELECT * FROM `tbl_product_categories` WHERE `deleted_at` IS NULL ORDER BY `id` DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $res;
        } catch (Exception $e) {
            die("Product Categories getAll function error!");
        }
    }
}

?>