<?php 
    include_once "includes/header.php"; 
    include_once "includes/sidebar.php"; 
    
    $brands = new Brand();
    $brands->validateParams($_GET);
    $data = $brands->getBrandBySlug($_GET["slug"]);

    $store = $brands->editBrands($_POST, $_GET["slug"]);
    if ($store) echo "<script>location.href='brands.php';</script>";
?>

<div class="content-body">
    <!-- row -->	
    <div class="page-titles">
        <ol class="breadcrumb">
            <li><h5 class="bc-title">Edit Brands</h5></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Home </a>
            </li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Brands</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Brands</a></li>
        </ol>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1 col-sm-12">
                <?php
                    if (isset($_SESSION["edit_brands_error"])):
                ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> <?= $_SESSION["edit_brands_error"] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                <?php
                        unset($_SESSION["edit_brands_error"]);
                    endif;
                ?>
                
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Brands</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control form-control-sm" value="<?= $data->name; ?>" name="name" placeholder="Enter Name">
                                        
                                        <?php
                                            if (isset($_SESSION["brands_name_error"])):
                                                echo "<div class='invalid-feedback'>".$_SESSION["brands_name_error"]."</div>";
                                                unset($_SESSION["brands_name_error"]);
                                            endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="brands.php" class="btn btn-light btn-sm">Back</a>
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm">Save</button>
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