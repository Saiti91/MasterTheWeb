<?php
session_start();
require_once '../includes/connexion_bdd.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);
    // relier les deux tables
    $query = 'SELECT Article.*, User.username
          FROM Article
          INNER JOIN User ON Article.User_id = User.id
          WHERE Article.id = ?';


    $article = $bdd->prepare($query);
    $article->execute(array($get_id));

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
        die('This article does not exist !');
    }

} else {
    die('Article ID is not specified!');
}

// Traitement de la suppression de l'article
if ($isAuthor && isset($_POST['delete_article'])) {
    // Supprimer l'article de la base de données
    $deleteQuery = 'DELETE FROM Article WHERE id = ?';
    $deleteStmt = $bdd->prepare($deleteQuery);
    $deleteStmt->execute(array($get_id));
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

    <title>Read Article</title>
    <style>
        body {
            background-color: black;
        }


        .container {
            border: none;
            border-radius: 10px;
            background-color: #121317;
            color: white;
        }


        form {
            margin-top: 20px;

        }


        img {
            border: none;
            border-radius: 25px;
        }


    </style>
</head>
<body>


<div class="container mt-5 p-5 ">
    <div class="clearfix">
        <h1 class="mb-5 mt-3 custom-h1 "><?= $title ?></h1>
        <img src="uploads/<?= $article['image'] ?>" class="col-md-6 float-md-end mb-3 ms-md-3" alt="Article Image">
        <p class="mb-5 mt-3 "><?= $body ?></p>
        <span> <?= $username ?></span>
        <span> <?= $pubdate ?></span>
    </div>


    <?php if ($isAuthor) { ?>
        <form action="" method="POST">
            <input type="hidden" name="delete_article" value="<?= isset($get_id) ? $get_id : '' ?>">
            <input type="submit" value="Delete Article"
                   style="background-color: #8E0808; color: white; border:none; border-radius:10px; padding:8px;">
        </form>
    <?php } ?>
</div>


<div class="container mt-5 mb-5 p-5">
    <div class="clearfix">
        <h1 class="mb-5 mt-3 custom-h1">Commentaire</h1>
        <!-- Autre contenu ici -->
    </div>
</div>


<?php
include('footer.php');
?>


</body>
</html>
 
