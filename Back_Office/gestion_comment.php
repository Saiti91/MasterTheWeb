<?php
session_start();

// Vérifier si c'est l'admin qui est connecté pour avoir accès à la page
$isAdmin = true; // Remplacez par logique de vérification de l'administrateur

if (!$isAdmin) {
    echo "Accès refusé.";
    exit;
}

try {
    $bdd = new PDO('mysql:host=localhost;port=8889;dbname=master_theweb', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die($e->getMessage());
}
if (isset($_GET['recent'])) {
    $threeMonthsAgo = date('Y-m-d', strtotime('-3 months'));
    $query = 'SELECT comment.id, comment.user_id, comment.date_of_publ, comment.article_id, article.title, users.username
              FROM comment 
              JOIN article ON comment.article_id = article.id 
              JOIN users ON comment.user_id = users.id
              WHERE comment.date_of_publ >= "' . $threeMonthsAgo . '" 
              ORDER BY comment.id DESC';
} else {
    $query = 'SELECT comment.id, comment.user_id, comment.date_of_publ, comment.article_id, article.title, users.username
              FROM comment 
              JOIN article ON comment.article_id = article.id 
              JOIN users ON comment.user_id = users.id
              ORDER BY comment.id DESC';
}


$result = $bdd->query($query);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);

    // Vérifier si le commentaire existe avant de supprimer
    $checkQuery = 'SELECT id FROM comment WHERE id = ?';
    $checkStmt = $bdd->prepare($checkQuery);
    $checkStmt->execute([$get_id]);
    $commentExists = $checkStmt->rowCount() > 0;

    if ($commentExists) {
        // Supprimer le commentaire correspondant à l'ID
        $deleteQuery = 'DELETE FROM comment WHERE id = ?';
        $deleteStmt = $bdd->prepare($deleteQuery);
        $deleteStmt->execute([$get_id]);
        $message = "Comment deleted successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style_gestion_article.css"/>
    <title>Comment Management</title>
</head>
<body>
<div class="container">
    <header></header>
    <div class="d-md-flex justify-content-between align-items-center my-5">
        <h1 class="mb-3 mb-md-0">Comment</h1>
        <div class="order-md-1">
            <form method="GET" action="" class="row align-items-center">
                <div class="col-auto">
                    <button class="btn custom-button" type="submit" name="recent" value="1">Recent Comment</button>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered table-striped table-white">
        <thead>
        <tr>
            <th>Id</th>
            <th>User id</th>
			 <th>Username</th>
            <th>Date of Publication</th>
            <th>Article Title</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo isset($row["user_id"]) ? $row["user_id"] : ""; ?></td>
					<td><?php echo isset($row["username"]) ? $row["username"] : ""; ?></td>

                    <td><?php echo isset($row["date_of_publ"]) ? $row["date_of_publ"] : ""; ?></td>
                    <td><?php echo isset($row["title"]) ? $row["title"] : ""; ?></td>
                    <td>
                        <a href="article_read_more.php?id=<?php echo $row["article_id"]; ?>" class="btn btn-info">Read more</a>
                        <a href="gestion_comment.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5">No comments found.</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<?php
if (isset($message)) {
    echo '<div class="alert alert-success custom-alert alert-dismissible fade show">' . $message . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
?>
</body>
</html>
