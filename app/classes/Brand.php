<?php

class Brand {

    private $con;

    public function __construct() {
        try {
            $db = new DB();
            $this->con = $db->connect();
        } catch (PDOException $e) {
            die("ERROR IN CONNECTION!<br>" . $e->getMessage());
        }
    }

    public function getBrands() : iterable {
        try {
            $sql = "SELECT `id`, `name`, `slug` FROM `tbl_brands` WHERE `deleted_at` IS NULL ORDER BY `id` DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $res;
        } catch (PDOException $e) {
            die("Brands: get brands error!<br>" . $e->getMessage());
        }
    }

    public function addBrands(array $request) : bool {
        try {
            if (isset($request["submit-1"]) || isset($request["submit-2"])):
                
                $validation_result = $this->validate($request);

                if(count($validation_result) > 0):
                    $this->setValidationMessage($validation_result);
                    return false;
                else:

                    $name = htmlspecialchars($request["name"]);
                    $slug = App::slugify($name);
                    $created_at = date("Y-m-d H:i:s", time());

                    $sql = "INSERT INTO `tbl_brands` (`name`, `slug`, `created_at`) VALUES (:name, :slug, :created_at)";
                    $stmt = $this->con->prepare($sql);
                    $stmt->bindParam("name", $name, PDO::PARAM_STR);
                    $stmt->bindParam("slug", $slug, PDO::PARAM_STR);
                    $stmt->bindParam("created_at", $created_at, PDO::PARAM_STR);
                    $stmt->execute();
                    
                    $_SESSION["brands_name"] = $name;

                    return true;
                endif;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            $_SESSION["add_brands_error"] = $e->getMessage();
            return false;
        }
    }

    private function validate(array $request) : array {
        try {

            $validation_messages = [];

            if (!isset($request["name"]) || $request["name"] == ""):
                $validation_messages["brands_name_error"] = "Name is required!";
            endif;

            return $validation_messages;

        } catch (Exception $e) {
            die("Brands: validation error<br>" . $e->getMessage());
        }
    }

    private function setValidationMessage(array $messages) : void {
        try {
            foreach ($messages as $key => $value):
                $_SESSION[$key] = $value;
            endforeach;
        } catch (Exception $e) {
            die("Brands: set validation message error!<br>" . $e->getMessage());
        }
    }

    public function validateParams(array $params) : void {
        try {
            if (!isset($params["slug"]) || $params["slug"] == "" || !$this->getBrandBySlug($params["slug"])):
                echo "<script>location.href='brands.php';</script>";
            endif;
        } catch (Exception $e) {
            die("Brands: validate params error!<br>" . $e->getMessage());
        }
    }

    public function getBrandBySlug(string $slug) : object|bool {
        try {
            $sql = "SELECT `name`, `slug` FROM `tbl_brands` WHERE `slug`=:slug";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("slug", $slug, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_OBJ);

            return $res;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function editBrands(array $request, string $slug) : bool {
        try {
            if (isset($request["submit"])):
                
                $validation_result = $this->validate($request);

                if(count($validation_result) > 0):
                    $this->setValidationMessage($validation_result);
                    return false;
                else:
                    $name = htmlspecialchars($request["name"]);
                    $new_slug = App::slugify($name);
                    $updated_at = date("Y-m-d H:i:s", time());
                    
                    $sql = "UPDATE `tbl_brands` SET `name`=:name, `slug`=:new_slug, `updated_at`=:updated_at WHERE `slug`=:slug";
                    $stmt = $this->con->prepare($sql);
                    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                    $stmt->bindParam(":new_slug", $new_slug, PDO::PARAM_STR);
                    $stmt->bindParam(":updated_at", $updated_at, PDO::PARAM_STR);
                    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                    $stmt->execute();

                    return true;
                endif;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            $_SESSION["edit_brands_error"] = $e->getMessage();
            return false;
        }
    }

    public function deleteBrands(string $slug) : bool {
        try {
            $deleted_at = date("Y-m-d H:i:s", time());
            $sql = "UPDATE `tbl_brands` SET `deleted_at`=:deleted_at WHERE `slug`=:slug";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("deleted_at", $deleted_at, PDO::PARAM_STR);
            $stmt->bindParam("slug", $slug, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>