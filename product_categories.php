<?php 
    include_once "includes/header.php";
    include_once "includes/sidebar.php"; 

    $product_categories = new ProductCategory();
    $data = $product_categories->getCategories();
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->	
    <div class="page-titles">
        <ol class="breadcrumb">
            <li><h5 class="bc-title">Product Categories</h5></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Home </a>
            </li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Categories</a></li>
        </ol>
        <a class="text-primary fs-13" href="add_product_categories.php">+ Add New</a>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table id="example" class="display table" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($data as $item):
                            ?>
                                <tr>
                                    <td><?= $i; $i++;?></td>
                                    <td><?= $item->name; ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="edit_product_categories.php?slug=<?= $item->slug; ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            <a href="delete_product_categories.php?slug=<?= $item->slug ?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Option</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    

<?php include_once "includes/footer.php"; ?>