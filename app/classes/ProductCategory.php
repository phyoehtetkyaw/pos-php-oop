<?php

class ProductCategory {

    private $con;

    public function __construct() {
        try {
            $db = new DB();
            $this->con = $db->connect();
        } catch (PDOException $e) {
            die("ERROR IN CONNECTION!<br>" . $e->getMessage());
        }
    }

    public function getCategories() : iterable {
        try {
            $sql = "SELECT `name`, `slug` FROM `tbl_product_categories` WHERE `deleted_at` IS NULL ORDER BY `id` DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $res;
        } catch (PDOException $e) {
            die("Product Categories: get categories error!<br>" . $e->getMessage());
        }
    }

    public function addCategories(array $request) : bool {
        try {
            if (isset($request["submit"])):
                
                $validation_result = $this->validate($request);

                if(count($validation_result) > 0):
                    $this->setValidationMessage($validation_result);
                    return false;
                else:

                    $name = htmlspecialchars($request["name"]);
                    $slug = App::slugify($name);
                    $created_at = date("Y-m-d H:i:s", time());

                    $sql = "INSERT INTO `tbl_product_categories` (`name`, `slug`, `created_at`) VALUES (:name, :slug, :created_at)";
                    $stmt = $this->con->prepare($sql);
                    $stmt->bindParam("name", $name, PDO::PARAM_STR);
                    $stmt->bindParam("slug", $slug, PDO::PARAM_STR);
                    $stmt->bindParam("created_at", $created_at, PDO::PARAM_STR);
                    $stmt->execute();

                    return true;
                endif;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            die("Product Categories: add categories error!<br>" . $e->getMessage());
        }
    }

    private function validate(array $request) : array {
        try {

            $validation_messages = [];

            if (!isset($request["name"]) || $request["name"] == ""):
                $validation_messages["product_categories_name_error"] = "Name is required!";
            endif;

            return $validation_messages;

        } catch (Exception $e) {
            die("Product Cateogries: validation error<br>" . $e->getMessage());
        }
    }

    private function setValidationMessage(array $messages) : void {
        try {
            foreach ($messages as $key => $value):
                $_SESSION[$key] = $value;
            endforeach;
        } catch (Exception $e) {
            die("Product Cateogries: set validation message error!<br>" . $e->getMessage());
        }
    }

    public function validateParams(array $params) : void {
        try {
            if (!isset($params["slug"]) || $params["slug"] == "" || !$this->getCategoryBySlug($params["slug"])):
                echo "<script>location.href='product_categories.php';</script>";
            endif;
        } catch (Exception $e) {
            die("Product Cateogries: validate params error!<br>" . $e->getMessage());
        }
    }

    public function getCategoryBySlug(string $slug) : object|bool {
        try {
            $sql = "SELECT `name`, `slug` FROM `tbl_product_categories` WHERE `slug`=:slug";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("slug", $slug, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_OBJ);

            return $res;
        } catch (PDOException $e) {
            die("Product Cateogries: get category by slug error!<br>" . $e->getMessage());
        }
    }
}

?>