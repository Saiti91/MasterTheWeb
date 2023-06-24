<?php
session_start();
include '../includes/connexion_check_admin.php';
$titre = 'Modify Events';
$link = '../CSS/style_back_officeM.css';
include '../includes/header_backoffice.php'
?>
<div class="container py-2">
    <h2>Modify events</h2>
    <?php
    require_once '../includes/connexion_bdd.php';
    $id = $_GET['id'];
    $sqlState = $bdd->prepare('SELECT * FROM Event WHERE id=?');
    $sqlState->execute([$id]);
    $event = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modify'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $place = $_POST['place'];
        $url = $_POST['url'];
        $image = $_POST['image'];


        if (!empty($name) && !empty($description)) {
            $sqlState = $bdd->prepare('UPDATE  Event 
                                             SET name = ? ,
                                             description = ?,
                                             date = ?,
                                             place = ?,
                                             url = ?,
                                             image = ?
                                             WHERE id = ?;
                                                ');
            $sqlState->execute([$name, $description, $date, $place, $url, $image, $id]);
            header('location: list_events.php');
            exit;
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                the name of the artist,description and the image
            </div>
            <?php
        }

    }

    ?>

    <form method="POST">

        <input type="hidden" class="form-control" name="id" value="<?php echo $event['id'] ?>">

        <label class="form">artist name</label>
        <input type="text" class="form-control custom" name="name" value="<?php echo $event['name'] ?>">

        <label class="form">description</label>
        <textarea class="form-control custom" name="description"><?php echo $event['description'] ?></textarea>

        <label class="form">date</label>
        <input type="date" class="form-control custom" name="date" value="<?php echo $event['date'] ?>">

        <label class="form">place</label>
        <input type="text" class="form-control custom" name="place" value="<?php echo $event['place'] ?>">

        <label class="form">url</label>
        <textarea class="form-control custom" name="url" value="<?php echo $event['url'] ?>"></textarea>

        <label class="form">Image</label>
        <input type="file" class="form-control custom" name="image">

        <input type="submit" value="modify" class="btn btn-custom my-2" name="modify">


    </form>


</div>
</body>
</html>