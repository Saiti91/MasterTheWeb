<?php
$link = '../CSS/style_back_officeM.css';
$titre = 'Add Events';
include '../includes/header_backoffice.php' ?>
<div class="container">

    <h2>Add New event</h2>
    <?php
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $discription = $_POST['discription'];
        $date = $_POST['date'];
        $place = $_POST['place'];
        $url = $_POST['url'];
        $image = $_POST['image'];


        if (!empty($name) && !empty($discription)) {
            require_once '../includes/connexion_bdd.php';
            $res = $bdd->prepare('INSERT INTO evenement(name,Horodatage,place,description,url,image) VALUES(?,?,?,?,?,?)');
            $res->execute([$name, $date, $place, $discription, $url, $image]);
            ?>

            <div class="alert alert-success" role="alert">
                The event is added succefuly
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                the name of the artist and the discription are necessary
            </div>
            <?php
        }
    }
    ?>

    <form method="POST">
        <label class="form">artist name</label>
        <input type="text" class="form-control" name="name">

        <label class="form">Discription</label>
        <textarea class="form-control" name="discription"></textarea>

        <label class="form">date of the event</label>
        <input type="date" class="form-control" name="date">

        <label class="form">place</label>
        <input type="text" class="form-control" name="place">

        <label class="form">url</label>
        <textarea class="form-control" name="url"></textarea>

        <label class="form">Image</label>
        <input type="file" class="form-control" name="image">

        <input type="submit" value="add event" class="btn-btn-primary my-2" name="add">


    </form>
</div>
</body>
</html>