<?php
$titre = 'Products';
$link = '../CSS/style_back_officeM.css';
include '../includes/header_backoffice.php'
?>
<main>
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center my-5">
            <h2 class="mb-3 mb-md-0>Products">Products</h2>
            <div class="order-md-2 mt-3 mt-md-0">
                <a href="add_products.php" class="btn btn-custom">Add New Product</a>
            </div>
        </div>


        <table class="table table-striped table-hover">
            <thead>
            <tr>-
                <th>#ID</th>
                <th>Product name</th>
                <th>Price</th>
                <!--            <th>Discount</th>-->
                <!--            <th>Date_of_publication</th>-->
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            require_once '../includes/connexion_bdd.php';
            $bdd = $bdd->query('SELECT * FROM Products')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($bdd as $products) {
                ?>

                <tr>
                    <td><?php echo $products['id'] ?></td>
                    <td><?php echo $products['name'] ?></td>
                    <td><?php echo $products['price'] ?>€</td>
                    <!--                <td>--><?php //echo $products['discount'] ?><!--%</td>-->
                    <!--                <td>--><?php //echo $products['date_of_publication'] ?><!--</td>-->
                    <td><?php echo $products['image'] ?></td>
                    <td>
                        <a href="modify_product.php?id=<?php echo $products['id'] ?>" class="btn btn-info">Modify</a>
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

</main>

</body>
</html>


    