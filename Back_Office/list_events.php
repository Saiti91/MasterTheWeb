<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"
      type="text/css">
     <link href="style.css" rel="stylesheet">
    <title>Events</title>
</head>
<body>
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
          require_once 'include/database.php';
          $bdd = $pdo->query('SELECT * FROM events')->fetchAll(PDO::FETCH_ASSOC);
          foreach ($bdd as $events){
            ?>

            <tr>
                <td><?php echo $events['id'] ?></td>
                <td><?php echo $events['name'] ?></td>
                <td><?php echo $events['discription'] ?></td>
                <td><?php echo $events['date'] ?></td>
                <td><?php echo $events['place'] ?></td>
                <td><?php echo $events['url'] ?></td>
                <td><?php echo $events['image'] ?></td>
                <td>
                    <a href="modify_events.php?id=<?php echo $events['id'] ?>" class="btn btn-primary">Modify</a>
                    <a href="delete_events.php?id=<?php echo $events['id'] ?>" onclick="return confirm('Do you really want to delete the event');" class="btn btn-danger">Delete</a>
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


    