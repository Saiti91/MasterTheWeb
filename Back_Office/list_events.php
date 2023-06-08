<?php
$titre = 'Event';
$link = '../CSS/style.css';
include '../includes/header_backoffice.php'
?>
<div class="container">
    <h2>Events</h2>
    <a href="add_events.php" class="btn-btn-primary-add">Add New Event</a>
    <table class="table table-striped table-hover">

        <thead>
        <tr>
            <th>#ID</th>
            <th>Artist name</th>
            <th>Discription</th>
            <th>Date_of_event</th>
            <th>Place</th>
            <th>url</th>
            <th>image</th>
        </tr>
        </thead>

        <tbody>
        <?php
        require_once '../includes/connexion_bdd.php';
        $bdd = $bdd->query('SELECT * FROM evenement')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($bdd as $events) {
            ?>

            <tr>
                <td><?php echo $events['id'] ?></td>
                <td><?php echo $events['name'] ?></td>
                <td><?php echo $events['description'] ?></td>
                <td><?php echo $events['date'] ?></td>
                <td><?php echo $events['place'] ?></td>
                <td><?php echo $events['url'] ?></td>
                <td><?php echo $events['image'] ?></td>
                <td>
                    <a href="modify_events.php?id=<?php echo $events['id'] ?>" class="btn btn-primary">Modify</a>
                    <a href="delete_events.php?id=<?php echo $events['id'] ?>"
                       onclick="return confirm('Do you really want to delete the event');"
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


    