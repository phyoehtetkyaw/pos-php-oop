<?php 
    include_once "includes/header.php"; 
    include_once "includes/sidebar.php"; 
    
    $product_categories = new ProductCategory();
    $store = $product_categories->addCategories($_POST);
    
    if (isset($_POST["submit-1"]) && $store) echo "<script>location.href='product_categories.php';</script>";
?>

<div class="content-body">
    <!-- row -->	
    <div class="page-titles">
        <ol class="breadcrumb">
            <li><h5 class="bc-title">Add Product Categories</h5></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Home </a>
            </li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Product Categories</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product Categories</a></li>
        </ol>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1 col-sm-12">

                <?php include_once "includes/message-alerts/product_categories.php"; ?>
                
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Product Categories</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control form-control-sm" name="name" placeholder="Enter Name">
                                        
                                        <?php
                                            if (isset($_SESSION["product_categories_name_error"])):
                                                echo "<div class='invalid-feedback'>".$_SESSION["product_categories_name_error"]."</div>";
                                                unset($_SESSION["product_categories_name_error"]);
                                            endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="product_categories.php" class="btn btn-light btn-sm">Back</a>
                                    <button type="submit" name="submit-1" class="btn btn-success btn-sm">Save & Exit</button>
                                    <button type="submit" name="submit-2" class="btn btn-primary btn-sm">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>