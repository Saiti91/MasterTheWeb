<?php
$link = '../CSS/style.css';
$titre = 'Products List';
include '../includes/header_backoffice.php'
?>
<div class="container">
    <h2>Products</h2>
    <a href="add_products.php" class="btn-btn-primary-add">Add New Product</a>
    <table class="table">

        <thead>
        <tr>-
            <th>#ID</th>
            <th>Product name</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Date_of_publication</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
        require_once '../includes/connexion_bdd.php';
        $bdd = $pdo->query('SELECT * FROM products')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($bdd as $products) {
            ?>

            <tr>
                <td><?php echo $products['id'] ?></td>
                <td><?php echo $products['name'] ?></td>
                <td><?php echo $products['price'] ?>€</td>
                <td><?php echo $products['discount'] ?>%</td>
                <td><?php echo $products['date_of_publication'] ?></td>
                <td><?php echo $products['image'] ?></td>
                <td>
                    <a href="modify_product.php?id=<?php echo $products['id'] ?>" class="btn btn-primary">Modify</a>
                    <a href="delete_product.php?id=<?php echo $products['id'] ?>"
                       onclick="return confirm('Do you really want to delete <?php echo $products['name'] ?>');"
                       class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>


</body>
</html>


    