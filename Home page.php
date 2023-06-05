

<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
	<link rel="stylesheet" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
	<link rel= "stylesheet" href="style.css">
	 
  </head>
 
  
  
   
  
  
  
  
  
  
  <body>
 
  
  
  <?php include('include/header.php') ?>
  
  
 
  <section class="bn">banniére</section>
  
  
  
  <section class="products" id="products">
  <div class="heading">
  <h2>Category we have</h2>
  </div>

  <div class="category">
  
  <div id="c">
   <a href="article.php#classical" class="btn rounded-pill">Classical</a>
   </div>
   
   <div id="c">
   <a href="article.php#country" class="btn rounded-pill">Country</a>
   </div>
   
   <div id="c">
   <a href="article.php#jazz" class="btn rounded-pill">Jazz</a>
   </div>
   
   <div id="c">
   <a href="article.php#pop" class="btn rounded-pill">Pop</a>
   </div>
   
   <div id="c">
   <a href="article.php#metal" class="btn rounded-pill">Rock</a>
   </div>
   
  </div>
  
  
  
  
  
  
  
  
  
  
  
  <div class="products-container">
	  <div class="box">
	  
	  <img class="image" src="asset\Dua lip.jpg" alt="image">
	  <p id="d">july 2002</p>
	  <h2 id="title">Dua lipa the star of the moment.</h2>
	  <p id="description">The star who is making a hit right now with her best hit of the century released in 2022 this summer.</p>
		  <div class="content">
		   <a href="article.php"target="_blank" class="btn  rounded-pill">Read More</a>
		   </div>
	   </div>
	   
	     <div class="box">
	  <img  class="image" src="asset\bg mendes.jpg" alt="image">
	  <p id="d">jun 2022</p>
	  <h2 id="title">Shawn Mendes the new born.</h2>
	  <p id="description">The star who is making a hit right now with her best hit of the century released in 2022 this summer.</p>
		  <div class="content">
		   <a href="article.php"target="_blank" class="btn  rounded-pill">Read More</a>
		   </div>
	   </div>
	   
	     <div class="box">
	  <img class="image" src="asset\Angèle.jpg" alt="image">
	  <p id="d">october 2023</p>
	  <h2 id="title">Angel the French star of the moment</h2>
	  <p id="description">The star who is making a hit right now with her best hit of the century released in 2022 this summer.</p>
		  <div class="content">
		   <a href="article.php"target="_blank" class="btn  rounded-pill">Read More</a>
		   </div>
	   </div>

	     <div class="box">
	  <img class="image" src="asset\marilyne5.jpg" alt="image">
	  <p id="d">Mai 2022</p>
	  <h2 id="title">Marilyn Monroe: The Woman Behind the Myth" </h2>
	  <p id="description">Marilyn Monroe was an actress remains an emblematic figure of popular culture, the unforgatable star.</p>
		  <div class="content">
		   <a href="article.php"target="_blank" class="btn  rounded-pill">Read More</a>
		   </div>
	   </div>
	    <div class="box">
	  <img class="image" src="asset\Elvis Presley.jpg" alt="image">
	  <p id="d">september 2023</p>
	  <h2 id="title">Elvis Presley: The Man, the Music, the Legend</h2>
	  <p id="description">Elvis became a cultural phenomenon, revolutionizing popular music and rock and roll artists. </p>
		  <div class="content">
		   <a href="article.php"target="_blank" class="btn  rounded-pill">Read More</a>
		   </div>
	   </div>
	    <div class="box">
	  <img class="image" src="asset\Madonna (illuminati symbolism).jpg" alt="image">
	  <p id="d">july 2022</p>
	  <h2 id="title">Madonna</h2>
	  <p id="description">Madonna is an American singer, songwriter, actress, and businesswoman who has achieved massive success throughout her career.</p>
		  <div class="content">
		   <a href="article.php"target="_blank" class="btn  rounded-pill">Read More</a>
		   </div>
	   </div>
	   
	   
	   
	   
   </div>
   
   </section> 
   <section class="end-products">
   <p>Visit our Articles page to explore more <br>captivating content and dive deeper into our collection of articles.</p>
   <a href="article.php" class="btn">See more</a>
   </section>
   
   <section class="store">
   </section>
   
   
   
   
   
   
   <section class="suscribe">
   <div class="S">
   <p>Interested to get notified ? 
  <br> Suscribe and get <span>the most</span> piping <span>hot news</span> of the week, 
  emailed straight to your inbox.</p>
  <a href="inscriptionnewsletter.php" class="btn2">Suscribe</a>
   </div>
   </section>
   
   <?php session_start();

require_once 'connexion_bdd.php';
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['email'])) {
    // Afficher le nom de l'utilisateur connecté ou toute autre information pertinente

    echo 'Bonjour, ' . $_SESSION['email'];

    // Ajouter le lien ou le bouton de déconnexion
    echo '<a href="deconnexion.php">Déconnexion</a>';
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('location: connexion.php');
    exit;
}

   ?>
   
   
   
   <?php include('includes\footer.php'); ?>
   
   

  </body>
  </html>
  
  

