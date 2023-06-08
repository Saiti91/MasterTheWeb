<?php
require_once '../includes/connexion_bdd.php';

$articles = $bdd->query('SELECT Article.*, User.username
          FROM Article
          INNER JOIN User ON Article.User_id = User.id
          ORDER BY Article.date_of_publ DESC, Article.Category_id');


// if (isset($_GET['search']) && !empty($_GET['search'])) {
// $search = htmlspecialchars($_GET['search']);
// $query = 'SELECT id, title, user_id, date_of_publ, category, image FROM article WHERE title LIKE "%' . $search . '%"  OR body LIKE "%' . $search . '%" ORDER BY id DESC';}	  

// $result = $bdd->query($query);

// if (!$result) {
// die("Erreur dans la requête : " . $bdd->errorInfo()[2] enlever se truc si garde pas la fonction recherche!!!!!!!!);
// }
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

        .text-custom {
            color: #8E0808;
        }

        .text {
            color: white;
        }


        .card-img-top {
            height: 350px;
            object-fit: cover;

        }

        .btn-custom {
            background-color: #8E0808;
            color: #fff;
        }


        .card {
            background-color: #121317;
            color: #fff;

        }

        .card,
        .card-img-top {
            border-radius: 20px;
        }

        .card-body {
            overflow: hidden;
        }

        .bg-custom {
            background-color: #121317;
            width: 100px;
        }

        .card-text {
            color: #D9D9D9;
        }

        .custom-h2 {
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 10px;
            background-color: #121317;
            font-size: 16px;
            color: white;
            width: 150px;
        }

        .container {
            margin: 50px;
        }


        @media (max-width: 850px) {
            .row .col-md-4 {
                margin-bottom: 50px;
                display: flex;
                justify-content: center;

            }
        }


    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row">


        <div class="d-md-flex justify-content-between align-items-center my-5">
            <h1 class="mb-3 mb-md-0 text ">Drive into the musical univers : Discover our <br> <span class="text-custom"> inspiring </span>
                articles !</h1>
            <div class="order-md-2 mt-3 mt-md-0">
                <a href="article_post.php" class="btn btn-sm btn-custom ">Add New Article</a>
            </div>
        </div>

        <section id="classical" class="mt-5 mb-5">
            <h2 class="mb-5 p-2 custom-h2">Classical</h2>
            <div class="row">
                <?php while ($article = $articles->fetch()) { ?>
                    <?php if ($article['category'] == 'Classical') { ?>
                        <div class="col-md-4">
                            <div class="card mb-5" style="width: 20rem;">
                                <img src="uploads/<?= $article['image'] ?>" class="card-img-top " alt="Article Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $article['title'] ?></h5>
                                    <p class="card-text"
                                       style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?= $article['body'] ?>
                                    </p>


                                    <p class="card-text">Published
                                        on: <?= date('Y-m-d', strtotime($article['date_of_publ'])) ?></p>
                                    <p class="card-text">By: <?= $article['username'] ?></p>
                                    <a href="article_read_more.php?id=<?= $article['id'] ?>"
                                       class="btn btn-custom mt-3 mb-3">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>

        <section id="Country" class="mt-5 mb-5">
            <h2 class="mb-5 p-2 custom-h2 ">Country</h2>
            <div class="row">
                <?php $articles->execute(); ?>
                <?php while ($article = $articles->fetch()) { ?>
                    <?php if ($article['category'] == 'Country') { ?>
                        <div class="col-md-4">
                            <div class="card mb-5" style="width: 20rem;">
                                <img src="uploads/<?= $article['image'] ?>" class="card-img-top" alt="Article Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $article['title'] ?></h5>
                                    <p class="card-text"
                                       style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?= $article['body'] ?>
                                    </p>

                                    <p class="card-text">Published
                                        on: <?= date('Y-m-d', strtotime($article['date_of_publ'])) ?></p>
                                    <p class="card-text">By: <?= $article['username'] ?></p>
                                    <a href="article_read_more.php?id=<?= $article['id'] ?>"
                                       class="btn btn-custom mt-3 mb-3">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>

        <section id="Pop" class="mt-5">
            <h2 class="mb-5 p-2 custom-h2">Pop</h2>
            <div class="row">
                <?php $articles->execute(); ?>
                <?php while ($article = $articles->fetch()) { ?>
                    <?php if ($article['category'] == 'Pop') { ?>
                        <div class="col-md-4">
                            <div class="card mb-5" style="width: 20rem;">
                                <img src="uploads/<?= $article['image'] ?>" class="card-img-top" alt="Article Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $article['title'] ?></h5>
                                    <p class="card-text"
                                       style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?= $article['body'] ?>
                                    </p>

                                    <p class="card-text">Published
                                        on: <?= date('Y-m-d', strtotime($article['date_of_publ'])) ?></p>
                                    <p class="card-text">By: <?= $article['username'] ?></p>
                                    <a href="article_read_more.php?id=<?= $article['id'] ?>"
                                       class="btn btn-custom mt-3 mb-3">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>

        <section id="Jazz" class="mt-5">
            <h2 class="mb-5 p-2 custom-h2">Jazz</h2>
            <div class="row">
                <?php $articles->execute(); ?>
                <?php while ($article = $articles->fetch()) { ?>
                    <?php if ($article['category'] == 'Jazz') { ?>
                        <div class="col-md-4">
                            <div class="card mb-5" style="width: 20rem;">
                                <img src="uploads/<?= $article['image'] ?>" class="card-img-top " alt="Article Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $article['title'] ?></h5>
                                    <p class="card-text"
                                       style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?= $article['body'] ?>
                                    </p>

                                    <p class="card-text">Published
                                        on: <?= date('Y-m-d', strtotime($article['date_of_publ'])) ?></p>
                                    <p class="card-text">By: <?= $article['username'] ?></p>
                                    <a href="article_read_more.php?id=<?= $article['id'] ?>"
                                       class="btn btn-custom mt-3 mb-3">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>

        <section id="Rock" class="mt-5">
            <h2 class="mb-5 p-2 custom-h2">Rock</h2>
            <div class="row">
                <?php $articles->execute(); ?>
                <?php while ($article = $articles->fetch()) { ?>
                    <?php if ($article['category'] == 'Rock') { ?>
                        <div class="col-md-4">
                            <div class="card mb-5" style="width: 20rem;">
                                <img src="uploads/<?= $article['image'] ?>" class="card-img-top " alt="Article Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $article['title'] ?></h5>
                                    <p class="card-text"
                                       style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?= $article['body'] ?>
                                    </p>

                                    <p class="card-text">Published
                                        on: <?= date('Y-m-d', strtotime($article['date_of_publ'])) ?></p>

                                    <p class="card-text">By: <?= $article['username'] ?></p>
                                    <a href="article_read_more.php?id=<?= $article['id'] ?>"
                                       class="btn btn-custom mt-3 mb-3">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>

        <?php
        include('footer.php');
        ?>


        3
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>