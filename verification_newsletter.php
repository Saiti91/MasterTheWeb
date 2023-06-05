<?php

if (!isset($_POST['email']) || empty($_POST['email'])) {
    header('Location: inscriptionnewsletter.php?message=You must enter your email!');
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: inscription.php?message=Invalid Email');
    exit;
}

try {
    $bdd = new PDO('mysql:host=localhost;port=8889;dbname=master_theweb', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die($e->getMessage());
}

$q = 'SELECT * FROM users WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['email']]);
$results = $req->fetchAll();

if (!$results) {
	// L'utilisateur n'est pas encore abonné
		// redirection avec un message d'erreur
        header('Location: inscriptionnewsletter.php?message=Create an account to receive our newsletters!');
        exit;
    }else{

   
   $q = 'INSERT INTO newsletter (email, date_of_ins) VALUES(?, NOW())'; // Requête
$req = $bdd->prepare($q); // Préparation de la requête
$results = $req->execute([
    htmlspecialchars($_POST['email'])
]);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\MAMP\htdocs\PHPMailer\src\Exception.php';
require 'C:\MAMP\htdocs\PHPMailer\src\PHPMailer.php';
require 'C:\MAMP\htdocs\PHPMailer\src\SMTP.php';

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
	
	$q = 'SELECT * FROM newsletter WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['email']]);
$results = $req->fetchAll();

    foreach ($results as $row) {
        $email = strval($row['email']);
        $mail->addAddress($email);
    }

    $mail->isHTML(true);
    $mail->Subject = 'WELCOME TO OUR NEWSLETTER!';
    $mail->Body    = 'Hi there!<br>
    Thank you for subscribing to our newsletter.<br>
    Stay updated with our latest <b>articles, news,</b> and insights about the music industry.';
    $mail->AltBody = 'News';

    $mail->send();

    header('Location: Home page.php?success=1');
    exit;
} catch (Exception $e) {
    header('Location: inscriptionnewsletter.php?success=2');
    exit;
}


header('Location: Home page.php');
exit;

?>
