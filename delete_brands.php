<?php 
    include_once "includes/header.php"; 
    
    $brands = new Brand();
    $brands->validateParams($_GET);
    $data = $brands->getBrandBySlug($_GET["slug"]);

    $store = $brands->deleteBrands($_GET["slug"]);
    if ($store) echo "<script>location.href='brands.php';</script>";
?>