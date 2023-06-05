<?php include 'includes/header_index.php'; ?>
<main>
    <section>
        <div id="slider">
            <div class="img">
                <img src="asset/concert1.webp" alt="concert1" id="slide"/>
            </div>
            <div id="precedent" onclick="ChangeSlide(-1)">&lt;</div>
            <div id="suivant" onclick="ChangeSlide(1)">&gt;</div>
        </div>
        <a href="evenement.html" id="lien-evenement">See more</a>
    </section>

    <section class="products" id="products">
        <div class="heading">
            <h2>Category we have</h2>
        </div>

        <div class="category">
            <div id="c">
                <a href="article.html#classical" class="btn rounded-pill">Classical</a>
            </div>

            <div id="c">
                <a href="article.html#country" class="btn rounded-pill">Country</a>
            </div>

            <div id="c">
                <a href="article.html#jazz" class="btn rounded-pill">Jazz</a>
            </div>

            <div id="c">
                <a href="article.html#pop" class="btn rounded-pill">Pop</a>
            </div>

            <div id="c">
                <a href="article.html#metal" class="btn rounded-pill">Rock</a>
            </div>
        </div>

        <div class="products-container">
            <div class="box">
                <img class="image" src="asset\Dua lip.jpg" alt="image"/>
                <p id="d">july 2002</p>
                <h2 id="title">Dua lipa the star of the moment.</h2>
                <p id="description">
                    The star who is making a hit right now with her best hit of the
                    century released in 2022 this summer.
                </p>
                <div class="content">
                    <a href="article.html" target="_blank" class="btn rounded-pill"
                    >Read More</a
                    >
                </div>
            </div>

            <div class="box">
                <img class="image" src="asset\bg mendes.jpg" alt="image"/>
                <p id="d">jun 2022</p>
                <h2 id="title">Shawn Mendes the new born.</h2>
                <p id="description">
                    The star who is making a hit right now with her best hit of the
                    century released in 2022 this summer.
                </p>
                <div class="content">
                    <a href="article.html" target="_blank" class="btn rounded-pill"
                    >Read More</a
                    >
                </div>
            </div>

            <div class="box">
                <img class="image" src="asset\Angèle.jpg" alt="image"/>
                <p id="d">october 2023</p>
                <h2 id="title">Angel the French star of the moment</h2>
                <p id="description">
                    The star who is making a hit right now with her best hit of the
                    century released in 2022 this summer.
                </p>
                <div class="content">
                    <a href="article.html" target="_blank" class="btn rounded-pill"
                    >Read More</a
                    >
                </div>
            </div>

            <div class="box">
                <img class="image" src="asset\marilyne5.jpg" alt="image"/>
                <p id="d">Mai 2022</p>
                <h2 id="title">Marilyn Monroe: The Woman Behind the Myth"</h2>
                <p id="description">
                    Marilyn Monroe was an actress remains an emblematic figure of
                    popular culture, the unforgatable star.
                </p>
                <div class="content">
                    <a href="article.html" target="_blank" class="btn rounded-pill"
                    >Read More</a
                    >
                </div>
            </div>
            <div class="box">
                <img class="image" src="asset\Elvis Presley.jpg" alt="image"/>
                <p id="d">september 2023</p>
                <h2 id="title">Elvis Presley: The Man, the Music, the Legend</h2>
                <p id="description">
                    Elvis became a cultural phenomenon, revolutionizing popular music
                    and rock and roll artists.
                </p>
                <div class="content">
                    <a href="article.html" target="_blank" class="btn rounded-pill"
                    >Read More</a
                    >
                </div>
            </div>
            <div class="box">
                <img
                        class="image"
                        src="asset\Madonna (illuminati symbolism).jpg"
                        alt="image"
                />
                <p id="d">july 2022</p>
                <h2 id="title">Madonna</h2>
                <p id="description">
                    Madonna is an American singer, songwriter, actress, and
                    businesswoman who has achieved massive success throughout her
                    career.
                </p>
                <div class="content">
                    <a href="article.html" target="_blank" class="btn rounded-pill"
                    >Read More</a
                    >
                </div>
            </div>
        </div>
    </section>
    <section class="end-products">
        <p>
            Visit our Articles page to explore more <br/>captivating content and
            dive deeper into our collection of articles.
        </p>
        <a href="article.html" class="btn">See more</a>
    </section>

    <section>
        <h1 id="titre">Visit Our Store</h1>
        <section class="produits">
            <div class="card">
                <div class="card-image img-1"></div>
                <h2>The Weekend Sweat<br/>31.99 €</h2>
                <a href="shop.html">Buy now</a>
            </div>

            <div class="card">
                <div class="card-image img-2"></div>
                <h2>Ariana Phone Case <br/>18.90 €</h2>
                <a href="shop.html">Buy now</a>
            </div>

            <div class="card">
                <div class="card-image img-3"></div>
                <h2>Shawn Mendes Cap<br/>25.99 €</h2>

                <a href="shop.html">Buy now</a>
            </div>
        </section>

        <a href="shop.html" id="acheter">Shop at our store</a>
    </section>

    <section class="suscribe">
        <div class="S">
            <p>
                Interested to get notified ? <br/>
                Suscribe and get <span>the most</span> piping
                <span>hot news</span> of the week, emailed straight to your inbox.
            </p>
            <a href="newsletter.html" class="btn2">Suscribe</a>
        </div>
    </section>
</main>

<footer>
    <div class="footer-content">
        <h3>Holomusic</h3>
        <p>
            Unleash Your Imagination: <br/>Explore the Cutting-Edge World of
            HoloMusic Articles!
        </p>
    </div>
    <hr/>

    <div class="footer-bottom">
        <p>Copyright &copy; 2023 HOLOMUSIC</p>
    </div>
</footer>
</body>
</html>
