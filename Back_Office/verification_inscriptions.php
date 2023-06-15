<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\MAMP\htdocs\PHPMailer\src\Exception.php';
require 'C:\MAMP\htdocs\PHPMailer\src\PHPMailer.php';
require 'C:\MAMP\htdocs\PHPMailer\src\SMTP.php';

if (
  !isset($_POST['email']) || empty($_POST['email']) ||
  !isset($_POST['mdp']) || empty($_POST['mdp']) ||
  !isset($_POST['username']) || empty($_POST['username']) ||
  !isset($_POST['name']) || empty($_POST['name']) ||
  !isset($_POST['date_of_birth']) || empty($_POST['date_of_birth'])
) {
  header('location: inscription.php?message=You must fill all fields!');
  exit;
}



if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    header('location: inscription.php?message=Invalid Email');
    exit;
}

if(strlen($_POST['mdp']) < 6 || strlen($_POST['mdp']) > 20){
    header('location: inscription.php?message=The password must be between 6 and 20 characters!'); 
    exit;	
}

if ($_POST['mdp'] != $_POST['mdp-confirm']) {
  header('location: inscription.php?message=Passwords do not match!'); 
  exit;
}

if(isset($_POST['name']) && !empty($_POST['name'])){
    setcookie('name',$_POST['name'],time()+ 24*3600);
}
if(isset($_POST['username']) && !empty($_POST['username'])){
    setcookie('username',$_POST['username'],time()+ 24*3600);
}
if(isset($_POST['date_of_birth']) && !empty($_POST['date_of_birth'])){
    setcookie('date_of_birth',$_POST['date_of_birth'],time()+ 24*3600);
}
if(isset($_POST['email']) && !empty($_POST['email'])){
    setcookie('email',$_POST['email'],time()+ 24*3600);
}

try{
$bdd = new PDO('mysql:host=localhost;port=8889;dbname=master_theweb','root','root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(Exception $e){
die($e->getMessage());
}

$q = 'SELECT id,username,name,date_of_birth FROM users WHERE email = ?';
$req = $bdd -> prepare($q);
$req->execute([$_POST['email'] ]);
 $results = $req->fetchAll();
 
 if(!empty($results)){
 
 header('location:inscription.php?message=Email already used !');
 exit;
 }

$q = 'INSERT INTO users (username,name,date_of_birth,email,mdp) VALUES(?,?,?,?,?)'; //Requete
$req = $bdd->prepare($q); //Préparation de la requete
$results=$req->execute([
			 htmlspecialchars($_POST['username']),
			   htmlspecialchars($_POST['name']),
			  htmlspecialchars($_POST['date_of_birth']), 
			  htmlspecialchars($_POST['email']),
               hash('sha256',( $_POST['mdp'] ))
            ]);

if(!$results){
	// rediraction avec message erreur
	header('location:inscription.php?message=Connexion error !');
	exit;	
}else{


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
	
	$q = 'SELECT * FROM users WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['email']]);
$results = $req->fetchAll();

    foreach ($results as $row) {
        $email = strval($row['email']);
        $mail->addAddress($email);
    }

    $mail->isHTML(true);
    $mail->Subject = 'WELCOME TO HOLOMUSIC !';
    $mail->Body    = 'Hi there!<br>
    Thank you for subscribing .<br>
    Stay updated with our latest <b>articles, news,</b> and insights about the music industry.';
    $mail->AltBody = 'News';

    $mail->send();

   
header('location:connexion.php?message=account created successfully !');
exit;

} catch (Exception $e) {
    header('Location: inscription.php?success=2');
    exit;
}

}
?>