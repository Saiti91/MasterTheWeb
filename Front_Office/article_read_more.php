<?php
session_start();
include '../includes/connexion_check.php';
require_once 'connexion_bdd.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);
    // Requête pour récupérer l'article avec les informations de l'utilisateur
    $query = 'SELECT article.*, users.username
              FROM article
              INNER JOIN users ON article.user_id = users.id
              WHERE article.id = ?';

    $article = $bdd->prepare($query);
    $article->execute([$get_id]);

    if ($article->rowCount() > 0) {
        $article = $article->fetch();
        $title = $article['title'];
        $body = isset($article['body']) ? $article['body'] : '';
        $pubdate = date('Y-m-d', strtotime($article['date_of_publ']));
        $username = $article['username'];

        // Vérifier si l'utilisateur est connecté et s'il est l'auteur de l'article
        $isAuthor = false;
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $article['user_id']) {
            $isAuthor = true;
        }
    } else {
        die('This article does not exist!');
    }
} else {
    die('id not specified!');
}

// Traitement de la suppression de l'article
if ($isAuthor && isset($_POST['delete_article'])) {
    // Supprimer l'article de la base de données
    $deleteQuery = 'DELETE FROM article WHERE id = ?';
    $deleteStmt = $bdd->prepare($deleteQuery);
    $deleteStmt->execute([$get_id]);
    // Rediriger vers la page des articles ou afficher un message de confirmation
    header('Location:read_article.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="stylef.css">
    <link rel="stylesheet" type="text/css" href="Style_read_more_article.css"/>
    <title>Read Article</title>
</head>
<body>

<div class="container mt-5 mb-5 p-5">
    <div class="clearfix">
        <h1 class="mb-5 mt-3 custom-h1"><?= $title ?></h1>
        <img src="uploads/<?= $article['image'] ?>" class="col-md-6 float-md-end mb-3 ms-md-3" alt="Image de l'article">
        <p class="mb-5 mt-3 "><?= $body ?></p>
        <span><?= $username ?></span>
        <span><?= $pubdate ?></span>
    </div>

    <?php if ($isAuthor) { ?>
        <form action="" method="POST">
            <input type="hidden" name="delete_article" value="1">
            <input type="submit" value="Delete article"
                   style="background-color: #8E0808; color: white; border:none; border-radius:10px; padding:8px;">
        </form>
    <?php } ?>
</div>

<div class="container mt-5 mb-5 p-5">
    <div class="clearfix">

        <h1 class="mb-5 mt-3 custom-h1">Comment</h1>

        <form action="" method="POST">
            <div class="form_element my-4">
                <textarea type="text" class="form-control" name="text" placeholder="Your Comment"></textarea>
                <input type="hidden" name="article_id" value="<?= $get_id ?>">
            </div>

            <div class="form_element d-flex justify-content-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <input type="submit" value="Add comment" class="btn btn-custom mx-3">
                <?php else: ?>
                    <input type="submit" value="Add comment" class="btn btn-custom mx-3" disabled>
                    <?php
                    $loginURL = 'connexion.php?message=' . urlencode('You must log in to your account to be able to post a comment!');
                    echo '<p class="text-danger">You must log in to your account to be able to post a comment! Click <a href="' . $loginURL . '">here</a> to log in.</p>';
                    ?>
                <?php endif; ?>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (!empty($_POST['text'])) {
                        $text = trim($_POST['text']);
                        $text = htmlspecialchars($text);
                        $userId = $_SESSION['user_id'];
                        $articleId = $get_id;

                        $commentInsertQuery = 'INSERT INTO Comment (text, user_id, article_id, date_of_publ) VALUES (?, ?, ?, NOW())';
                        $commentInsertStmt = $bdd->prepare($commentInsertQuery);
                        $commentInsertStmt->execute([$text, $userId, $articleId]);

                        $success = 'Your comment has been successfully posted!';
                    } else {
                        $message = 'You must fill the field!';
                    }
                }
                ?>
            </div>
        </form>


        <?php
        // Requête pour récupérer les commentaires associés à l'article
        $commentsQuery = 'SELECT comment.*, users.username
                          FROM comment
                          INNER JOIN users ON comment.user_id = users.id
                          WHERE comment.article_id = ?';

        $commentsStmt = $bdd->prepare($commentsQuery);
        $commentsStmt->execute([$get_id]);

        while ($comment = $commentsStmt->fetch()) { ?>
            <div class="comment">
                <span><b><?= $comment['username'] ?></b></span>
                <span><?= $comment['date_of_publ'] ?></span>
                <p><?= $comment['text'] ?></p>
            </div>
        <?php } ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


        <?php
        if (isset($message)) {
            echo '<div class="alert alert-danger custom-alert  alert-dismissible fade show">' . $message . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
        if (isset($success)) {
            echo '<div class="alert alert-success custom-alert  alert-dismissible fade show">' . $success . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }

        ?>
    </div>
</div>

<?php
include('footer.php');
?>
</body>
</html>
