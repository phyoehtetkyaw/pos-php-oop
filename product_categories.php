<?php 
    include_once "includes/header.php";

    $product_categories = new ProductCategory();
    $data = $product_categories->getCategories();
?>

<h1>Product Categories</h1>
<a href="add_product_categories.php">Add</a>

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
                    <a href="edit_product_categories.php?slug=<?= $item->slug; ?>">Edit</a>
                    <a href="delete_product_categories.php?slug=<?= $item->slug ?>">Delete</a>
                </td>
            </tr>
        <?php
            endforeach;
        ?>
    </tbody>
</table>

<?php include_once "includes/footer.php"; ?>