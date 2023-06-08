<?php
$titre = 'Add Product';
$link = '../CSS/style_back_officeM.css';
include '../includes/header_backoffice.php'
?>
<main>
    <div class="container">
        <h2>Add products</h2>
        <?php
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];
            $image = $_POST['image'];


            if (!empty($name) && !empty($price)) {
                require_once '../includes/connexion_bdd.php';
                $sqlState = $bdd->prepare('INSERT INTO products(nom,price,discount,image) VALUES(?,?,?,?)');
                $sqlState->execute([$name, $price, $discount, $image]);
                ?>

                <div class="alert alert-success" role="alert">
                    <?php echo $name ?> is added succefuly
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    name , price are necessary
                </div>
                <?php
            }
        }
        ?>


        <form method="POST" enctype="multipart/form-data>
        <label class=" form
        ">name</label>
        <input type="text" class="form-control" name="name">

        <label class="form">price</label>
        <input type="number" step="0.01" class="form-control" name="price" min="0">

        <label class="form">discount</label>
        <input type="range" value="0" class="form-control" name="discount" min="0" max="90">

        <label class="form">Image</label>
        <input type="file" class="form-control" name="image">

        <input type="submit" value="add products " class="btn-btn-primary my-4" name="add">


        </form>


    </div>
</main>
<footer></footer>
</body>
</html>