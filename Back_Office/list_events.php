<?php
session_start();
include '../includes/connexion_check_admin.php';
$titre = 'Events';
$link = '../CSS/style_back_officeM.css';
include '../includes/header_backoffice.php'
?>
<main>
    <div class="container pt-5">
        <div class="d-md-flex justify-content-between align-items-center my-5">
            <h2 class="mb-3 mb-md-0">Event</h2>

            <div class="order-md-2 mt-3 mt-md-0">
                <a href="add_events.php" class="btn btn-custom">Add New Event</a>
            </div>
        </div>
        <table class="table table-success table-striped">

            <thead>
            <tr>
                <th>#ID</th>
                <th>Artist name</th>
                <th>description</th>
                <th>Date_of_event</th>
                <th>Place</th>
                <th>Url</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            require_once '../includes/connexion_bdd.php';
            $bdd = $bdd->query('SELECT * FROM Event')->fetchAll(PDO::FETCH_ASSOC);
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
                        <a href="modify_events.php?id=<?php echo $events['id'] ?>" class="btn btn-info">Modify</a>
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

</main>

</body>
</html>


    