<?php

session_start();
require_once 'connexion_bdd.php';

// verifier si le user est connecté 
if (!isset($_SESSION['user_id'])) {
	 // rediriger le user si il n'est pas connecte vers la page de connexion pour qu'il puisse poster son article 
    header('Location: connexion.php?message=You must log in to your account in order to post your article ! ');
	exit;
}

// rediriger vers connexion.php ou rester dans la meme page ?


require 'C:\MAMP\htdocs\PHPMailer\src\Exception.php';
require 'C:\MAMP\htdocs\PHPMailer\src\PHPMailer.php';
require 'C:\MAMP\htdocs\PHPMailer\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



if (isset($_POST['title'])&& isset($_POST['body']) && isset($_FILES['image'])) {
    if (!empty($_POST['title']) && !empty($_POST['body'])) {
        $title = htmlspecialchars($_POST['title']);
        $body = htmlspecialchars($_POST['body']);
        $userId = $_SESSION['user_id'];
		$category = $_POST['category'];
		
		
		$img_name = $_FILES['image']['name'];
		$img_size = $_FILES['image']['size'];
	    $tmp_name = $_FILES['image']['tmp_name'];
	    $error= $_FILES['image']['error'];
		
		if($error === 0){
			$maxSize = 2 * 1024 *1024;
			if($img_size > 	$maxSize ) {
			$message = "Sorry, your file is too large. ";
            header("Location:article_post.php?error=$message");		
            exit;			
		}else{
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);
			$allowed_exs = array("jpg" , "jpeg" , "png" , "gif");
			
			if(in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file( $tmp_name, $img_upload_path);
			}else{
				$message = "You can't upload files of this type";
				header("Location: index.php?error=$message");
				exit;
			}
		}
	}
		
        $articleInsertQuery = 'INSERT INTO article (title, body, date_of_publ, user_id, category, image) VALUES (?, ?, NOW(), ?, ?,?)';
        $articleInsertStmt = $bdd->prepare($articleInsertQuery);
        $articleInsertStmt->execute(array($title, $body, $userId, $category, $new_img_name));

// Récupérer la liste des abonnés à la newsletter
        $newsletterQuery = 'SELECT email FROM newsletter';
        $newsletterStmt = $bdd->prepare($newsletterQuery);
        $newsletterStmt->execute();
        $subscribers = $newsletterStmt->fetchAll(PDO::FETCH_COLUMN);

        if ($subscribers) {
// Envoyer la newsletter à tous les abonnés
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'patate.O2switch.net';
                $mail->SMTPAuth   = true;
                if ($mail->SMTPAuth) {
                    $mail->SMTPSecure = 'ssl';
                    $mail->Username   = 'derradji.ines@bessah.com';
                    $mail->Password   = 'P@ssword2023';
                }
                $mail->Port = 465;

                $mail->setFrom('derradji.ines@bessah.com', 'HOLOMUSIC');

                foreach ($subscribers as $subscriber) {
                    $email = strval($subscriber);
                    $mail->addAddress($email);
                }

                $mail->isHTML(true);
                $mail->Subject = 'New article published!';
                $mail->Body    = ' Dear subscriber,<br>
                We are excited to share that a new article has just been published !!! <br>
				Stay informed and inspired by visiting our website and checking out the new article today!
				';
      
                $mail->AltBody = 'News';

                 $mail->send();
            } catch (Exception $e) {
                // Gérer les erreurs d'envoi de l'e-mail
            }
        }
        $message = 'Your article has been successfully posted!';
    }else {
        $message = 'You must fill all fields!';
    }
	
	
}



// le user pour supprimer tous d'un coup si il le souhaite lors de la redaction d'article 

// Traitement de la suppression d'article
if (isset($_POST['delete_article'])) {
    $articleId = $_POST['delete_article'];
    // Effectuer la suppression de l'article correspondant en utilisant l'ID de l'article
    $deleteQuery = 'DELETE FROM article WHERE id = ?';
    $deleteStmt = $bdd->prepare($deleteQuery);
    $deleteStmt->execute(array($articleId));
    $message = 'Article deleted successfully!';
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Publication</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel= "stylesheet" href="stylef.css">

<style>
    .btn-custom {
        background-color: #8E0808;
        color: #fff;
    }
	
	.btn-custom:hover {
      opacity: 0.8;
	   color: #fff;
	   
    }

	 .form-select {
        margin-bottom: 1rem;
    }

    .custom-select {
        background-color: #121317;
        color:#D9D9D9;
        border-radius: 18px;
        padding: 0.375rem 0.75rem;
		border:none;
    }
	.article_container {
        margin: 50px;
    }
	
	h1 {color:#fff;}
	body{background-color:black;}

	.form-control{
		  background-color: #121317;
		  border:none;	
	}
	
	.custom-alert{
		width: 400px;
		margin:0 auto;
		background-color:#D9D9D9;
		color: black;
	}
	
	.form-control{
		
	}


 
	  
	  
	
	
</style>

</head>

<body>



    <div class="article_container">
	   
	   
	   <h1 class="d-flex justify-content-between my-4">Create New Topic</h1>

     <form action="article_post.php" method="POST" enctype="multipart/form-data">
    <div class="form_element my-4">
        <input type="text" class="form-control" name="title" placeholder="Title">
    </div>
    
    <div class="form_element my-4">
        <textarea type="text" class="form-control" name="body" placeholder="Content"></textarea>
    </div>
    
    <div class="form_element my-4">
        <select name="category" class="form-select custom-select">
            <option value="Classical">Classical</option>
            <option value="Country">Country</option>
            <option value="Pop">Pop</option>
            <option value="Jazz">Jazz</option>
            <option value="Rock">Rock</option>
        </select>
    </div>
    
    <div class="form_element my-4 ">
        <input class="form-control" type="file" name="image">
    </div>
				<div class="form_element d-flex justify-content-center">
                <input type="submit" value="Add article" class="btn btn-custom  mx-3 ">
				<input type="submit" value="Delete article" class="btn btn-custom  mx-3">
				</div>
        </form>
		
    </div>
	
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	 
   <?php
   if (isset ($_GET['error'])){
   echo'<div class="alert alert-success custom-alert  alert-dismissible fade show">'.$_GET['error'].'
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
   }
   	?>
   <?php
   if (isset($message)) {
    echo '<div class="alert alert-success custom-alert  alert-dismissible fade show">' . $message . '
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
    ?>
	
	<?php
    include('footer.php');
    ?>

	
</body>
</html>

           
					
					
					
					
					
		