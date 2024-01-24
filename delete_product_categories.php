<?php 
    include_once "includes/header.php"; 
    
    $product_categories = new ProductCategory();
    $product_categories->validateParams($_GET);
    $data = $product_categories->getCategoryBySlug($_GET["slug"]);

    $store = $product_categories->deleteCategories($_GET["slug"]);
    if ($store) echo "<script>location.href='product_categories.php';</script>";
?>