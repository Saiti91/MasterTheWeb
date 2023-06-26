<?php
session_start();
require_once '../includes/connexion_bdd.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);
    // Requête pour récupérer l'article avec les informations de l'utilisateur
    $query = 'SELECT Article.*, User.username
              FROM Article
              INNER JOIN User ON Artcile.User_id = User.idUser
              WHERE Article.id = ?';

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
    header('Location: read_article.php');
    exit;
}

// Traitement du like
if (isset($_POST['user_like_article']) && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $articleId = $get_id;

    // Vérifier si l'utilisateur a déjà aimé l'article
    $checkQuery = 'SELECT id FROM user_like_article WHERE user_id = ? AND article_id = ?';
    $checkStmt = $bdd->prepare($checkQuery);
    $checkStmt->execute([$userId, $articleId]);

    if ($checkStmt->rowCount() > 0) {
        // L'utilisateur a déjà aimé l'article, vous pouvez afficher un message ou effectuer une autre action
    } else {
        // Ajouter le like à la base de données
        $insertQuery = 'INSERT INTO User_like_Article (User_id, Article_id) VALUES (?, ?)';
        $insertStmt = $bdd->prepare($insertQuery);
        $insertStmt->execute([$userId, $articleId]);
    }
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
    <link rel="stylesheet" type="text/css" href="../CSS/Style_read_more_article.css"/>
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

    <?php if ($isAuthor) {
        echo '<form action="" method="POST">
            <input type="hidden" name="delete_article" value="1">
            <input type="submit" value="Delete article"
                   style="background-color: #8E0808; color: white; border:none; border-radius:10px; padding:8px;">
        </form>';
    } ?>

    <?php
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $articleId = $get_id;

        // Vérifier si l'utilisateur a déjà aimé l'article
        $checkQuery = 'SELECT * FROM User_like_Article WHERE User_id = ? AND Article_id = ?';
        $checkStmt = $bdd->prepare($checkQuery);
        $checkStmt->execute([$userId, $articleId]);

        if ($checkStmt->rowCount() > 0) {
            echo '<p>You liked this article.</p>';
        } else {
            echo '<form action="" method="POST">
            <input type="hidden" name="user_like_article" value="1">
            <input type="submit" value="Like" style="background-color: #008000; color: white; border:none; border-radius:8px; padding:6px 20px;">
        </form>';
        }
    }
    ?>

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

                        $commentInsertQuery = 'INSERT INTO Comment (text, User_id, Article_id) VALUES (?, ?, ?)';
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
        $commentsQuery = 'SELECT Comment.*, User.username
                          FROM Comment
                          INNER JOIN User ON Comment.User_id = User.idUser
                          WHERE Comment.Article_id = ?';

        $commentsStmt = $bdd->prepare($commentsQuery);
        $commentsStmt->execute([$get_id]);

        while ($comment = $commentsStmt->fetch()) { ?>
            <div class="comment">
                <span><b><?= $comment['username'] ?></b></span>
                <span><?= $comment['date'] ?></span>
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
include('../includes/footer.php');
?>
</body>
</html>
