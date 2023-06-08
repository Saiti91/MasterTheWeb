<?php
$link = '';
$titre = 'Modify Event';
include '../includes/header_backoffice.php'
?>
<div class="container py-2">
    <h4>Modify events</h4>
    <?php
    require_once '../includes/connexion_bdd.php';
    $id = $_GET['id'];
    $sqlState = $bdd->prepare('SELECT * FROM events WHERE id=?');
    $sqlState->execute([$id]);
    $event = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modify'])) {
        $name = $_POST['name'];
        $discription = $_POST['discription'];
        $date = $_POST['date'];
        $place = $_POST['place'];
        $url = $_POST['url'];
        $image = $_POST['image'];


        if (!empty($name) && !empty($discription)) {
            $sqlState = $pdo->prepare('UPDATE  events 
                                             SET name = ? ,
                                             description = ?,
                                             date = ?,
                                             place = ?,
                                             url = ?,
                                             image = ?
                                             WHERE id = ?;
                                                ');
            $sqlState->execute([$name, $discription, $date, $place, $url, $image, $id]);
            header('location: list_events.php');
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

        <input type="hidden" class="form-control" name="id" value="<?php echo $event['id'] ?>">

        <label class="form-label">artist name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $event['name'] ?>">

        <label class="form-label">Discription</label>
        <textarea class="form-control" name="discription"><?php echo $event['discription'] ?></textarea>

        <label class="form-label">date</label>
        <input type="date" class="form-control" name="date" value="<?php echo $event['date'] ?>">

        <label class="form-label">place</label>
        <input type="text" class="form-control" name="place" value="<?php echo $event['place'] ?>">

        <label class="form-label">url</label>
        <textarea class="form-control" name="url" value="<?php echo $event['url'] ?>"></textarea>

        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image">

        <input type="submit" value="modify" class="btn btn-primary my-2" name="modify">


    </form>


</div>
</body>
</html>