<?php 
    include_once "includes/header.php"; 
    
    $product_categories = new ProductCategory();
    $product_categories->validateParams($_GET);
    $data = $product_categories->getCategoryBySlug($_GET["slug"]);

    $store = $product_categories->editCategories($_POST, $_GET["slug"]);
    if ($store) echo "<script>location.href='product_categories.php';</script>";
?>

<h1>Edit Category</h1>
<?php
    if (isset($_SESSION["edit_product_categories_error"])):
        echo "<span style='color: red;'>" . $_SESSION["edit_product_categories_error"] . "</span><br>";
        unset($_SESSION["edit_product_categories_error"]);
    endif;
?>
<form action="" method="post">
    <label for="name">Name: </label>
    <input type="text" name="name" placeholder="Enter Name" id="name" value="<?= $data->name; ?>"><br>

    <?php
        if (isset($_SESSION["product_categories_name_error"])):
            echo "<span style='color: red;'>" . $_SESSION["product_categories_name_error"] . "</span><br>";
            unset($_SESSION["product_categories_name_error"]);
        endif;
    ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php include_once "includes/footer.php"; ?>