<?php

class DB {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "db_pos_php_oop";

    public function connect() {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);

            echo "Connect!";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}

?>