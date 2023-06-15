<?php include '../includes/header_index.php';
include '../includes/connexion_bdd.php'

?>
<main>
    <section>
        <div id="slider">
            <div class="img">
                <img src="asset/concert1.webp" alt="concert1" id="slide"/>
            </div>
            <div id="precedent" onclick="ChangeSlide(-1)">&lt;</div>
            <div id="suivant" onclick="ChangeSlide(1)">&gt;</div>
        </div>
    </section>

    <section class="products" id="products">
        <div class="heading">
            <h2>Category</h2>
        </div>

        <div class="category">
            <?php
            $q = 'SELECT name FROM Category LIMIT 4';
            $req = $bdd->prepare($q);
            $req->execute();
            $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach ($donnees as $index => $value) {
                echo '
                    <div id="c">
                        <a href="#" class="btn rounded-pill">' . $value['nom'] . '</a>
                    </div>';
            }
            ?>
        </div>

        <div class="products-container">
            <?php
            $q = 'SELECT * FROM Article LIMIT 4';
            $req = $bdd->prepare($q);
            $req->execute();
            $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach ($donnees as $index => $value) {
                echo ' 
                    <div class="box">
                    <img class="image" src="' . $value['image'] . '" alt="image"/>
                    <p id="d">' . $value['horodatage'] . '</p>
                    <h2 id="title">' . $value['titre'] . '</h2>
                    <p id="description">' . $value['text'] . '</p>
                    <div class="content">
                        <a href="#" target="_blank" class="btn rounded-pill"
                    >Read More</a
                    >
                    </div>
                    </div>';
            }
            ?>

        </div>
    </section>
    <section class="end-products">
        <p style="background: none">
            Visit our Articles page to explore more <br/>
            captivating content and dive deeper into our collection of articles.
        </p>
        <a href="article.html" class="btn btn-danger">See more</a>
    </section>

    <section>
        <h1 id="titre">Visit Our Store</h1>
        <section class="produits">
            <?php
            $q = 'SELECT * FROM Products LIMIT 3';
            $req = $bdd->prepare($q);
            $req->execute();
            $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach ($donnees as $index => $value) {
                echo '
                    <div class="card">
                    <div class="card-image img-' . ($index + 1) . '"></div>
                    <h2>' . $value['Description'] . '<br/>' . $value['prix'] . '€</h2>
                    <a href="shop.html">Buy now</a>
                    </div>
                    ';
            }
            ?>

        </section>

        <a href="shop.html" id="acheter">Shop at our store</a>
    </section>

    <section class="suscribe">
        <div class="S">
            <p style="background: none">
                Interested to get notified ? <br/>
                Suscribe and get <span>the most</span> piping
                <span>hot news</span> of the week, emailed straight to your inbox.
            </p>
            <a href="newsletter.html" class="btn2">Suscribe</a>
        </div>
    </section>
</main>

<?php include '../includes/footer.php' ?>
