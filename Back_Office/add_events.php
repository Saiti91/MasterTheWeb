<?php
$titre = 'Add Events';
$link = '../CSS/style_back_officeM.css';
include '../includes/header_backoffice.php'
?>

<div class="container">
    <h2>Add New event</h2>
    <?php
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $place = $_POST['place'];
        $url = $_POST['url'];
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
                    Sorry, your file is too large
                </div>
                <?php
            } else {
                $img_ex = pathinfo($image, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png", "gif");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'uploads/' . $new_img_name;
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
        if (!empty($name) && !empty($description) && !empty($image)) {
            require_once '../includes/connexion_bdd.php';
            $res = $bdd->prepare('INSERT INTO Events(name,date,place,description,url,image) VALUES(?,?,?,?,?,?)');
            $res->execute([$name, $date, $place, $description, $url, $image]);
            ?>

            <div class="alert alert-success" role="alert">
                The event is added succefuly
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                the name of the artist, the description, image are necessary
            </div>
            <?php
        }
    }
    ?>
    <form method="POST" enctype="multipart/form-data">
        <label class="form">artist name</label>
        <input type="text" class="form-control custom" name="name">
        <label class="form">description</label>
        <textarea class="form-control custom" name="description"></textarea>
        <label class="form">date of the event</label>
        <input type="date" class="form-control custom" name="date">
        <label class="form">place</label>
        <input type="text" class="form-control custom" value=" " name="place">
        <label class="form">url</label>
        <textarea class="form-control custom" value=" " name="url"></textarea>
        <label class="form">Image</label>
        <input type="file" class="form-control custom" name="image">
        <input type="submit" value="add event" class="btn btn-custom my-2" name="add">
    </form>
</div>
</body>
</html>