<?php
session_start();
include '../includes/connexion_check.php';
$link = '../CSS/Style_read_article.css';
$titre = 'Articles';
include '../includes/header_index.php';
require_once '../includes/connexion_bdd.php';

$articles = $bdd->query('SELECT Article.*, User.username
          FROM Article
          INNER JOIN User ON Article.User_id = User.idUser
          ORDER BY Article.date_of_publ DESC');
?>
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
    </div>
    <?php
    include('../includes/footer.php');
    ?>

