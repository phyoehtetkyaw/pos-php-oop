<?php 
    include_once "includes/header.php";

    $product_categories = new ProductCategory();
    $data = $product_categories->getAll();
?>
<h1>Product Categories</h1>
<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Options</th>
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
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                </td>
            </tr>
        <?php
            endforeach;
        ?>
    </tbody>
</table>

<?php include_once "includes/footer.php"; ?>