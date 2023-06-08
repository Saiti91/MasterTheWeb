<?php
$titre = 'Modify products';
$link = '../CSS/style_back_officeM.css';
include '../includes/header_backoffice.php'
?>
<div class="container py-2">
    <h4>Modify products</h4>
    <?php
    require_once '../includes/connexion_bdd.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('SELECT * FROM products WHERE id=?');
    $sqlState->execute([$id]);
    $product = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modify'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $image = $_POST['image'];

        if (!empty($name) && !empty($price)) {
            $sqlState = $pdo->prepare('UPDATE  products 
                                             SET name = ? ,
                                             price = ?,
                                             discount = ?,
                                             image = ?
                                            
                                             WHERE id = ?;
                                                ');
            $sqlState->execute([$name, $price, $discount, $image, $id]);
            header('location: product_list.php');
            exit;
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                the name of the product and the price are necessary
            </div>
            <?php
        }

    }

    ?>

    <form method="POST">

        <input type="hidden" class="form-control" name="id" value="<?php echo $product['id'] ?>">

        <label class="form-label">name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $product['name'] ?>">

        <label class="form-label">Price</label>
        <input type="number" step="0.1" class="form-control" name="price" min="0"
               value="<?php echo $product['price'] ?>">

        <label class="form-label">Discount</label>
        <input type="range" class="form-control" name="discount" min="0" max="90"
               value="<?php echo $product['discount'] ?>">

        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image">

        <input type="submit" value="modify" class="btn btn-custom my-2" name="modify">


    </form>


</div>
</body>
</html>