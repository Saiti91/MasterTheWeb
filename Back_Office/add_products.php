<?php
$titre = 'Add Products';
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

            //upload images
            $image = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            if ($error === 0) {
                $maxSize = 2 * 1024 * 1024;
                if ($img_size > $maxSize) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Sorry, your file is too large.
                    </div>
                    <?php
                } else {
                    $img_ex = pathinfo($image, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg", "jpeg", "png", "gif");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = '../uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            You can't upload files of this type
                        </div>
                        <?php


                    }
                }
            }


            if (!empty($name) && !empty($price) && !empty($image)) {
                require_once '../includes/connexion_bdd.php';
                $sqlState = $bdd->prepare('INSERT INTO Products(name,price/*,discount*/,image) VALUES(?,?,?)');
                $sqlState->execute([$name, $price/*, $discount*/, $image]);
                ?>

                <div class="alert alert-success" role="alert">
                    <?php echo $name ?> is added succefuly
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    name , price , image are necessary
                </div>
                <?php
            }
        }
        ?>


        <form method="POST" enctype="multipart/form-data">
            <label class="form">name</label>
            <input type="text" class="form-control custom" name="name">

            <label class="form">price</label>
            <input type="number" step="0.01" class="form-control custom" name="price" min="0">

            <label class="form">discount</label>
            <input type="range" value="0" class="form-control custom" name="discount" min="0" max="90">

            <label class="form">Image</label>
            <input type="file" class="form-control custom" name="image">

            <input type="submit" value="add products " class="btn btn-custom  my-4" name="add">


        </form>


    </div>
</main>
<footer></footer>
</body>
</html>