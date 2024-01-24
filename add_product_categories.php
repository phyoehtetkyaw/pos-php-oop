<?php 
    include_once "includes/header.php"; 
    
    $product_categories = new ProductCategory();
    $store = $product_categories->addCategories($_POST);

    if ($store) echo "<script>location.href='product_categories.php';</script>";
?>

<h1>Add Category</h1>
<?php
    if (isset($_SESSION["add_product_categories_error"])):
        echo "<span style='color: red;'>" . $_SESSION["add_product_categories_error"] . "</span><br>";
        unset($_SESSION["add_product_categories_error"]);
    endif;
?>
<form action="" method="post">
    <label for="name">Name: </label>
    <input type="text" name="name" placeholder="Enter Name" id="name"><br>

    <?php
        if (isset($_SESSION["product_categories_name_error"])):
            echo "<span style='color: red;'>" . $_SESSION["product_categories_name_error"] . "</span><br>";
            unset($_SESSION["product_categories_name_error"]);
        endif;
    ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php include_once "includes/footer.php"; ?>