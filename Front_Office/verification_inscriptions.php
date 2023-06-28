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

$email = trim($_POST['email']);
$email = htmlspecialchars($email);

$mdp = trim($_POST['mdp']);
$mdp = htmlspecialchars($mdp);

$username = trim($_POST['username']);
$username = htmlspecialchars($username);

$name = trim($_POST['name']);
$name = htmlspecialchars($name);

$date_of_birth = trim($_POST['date_of_birth']);
$date_of_birth = htmlspecialchars($date_of_birth);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('location: inscription.php?message=Invalid Email');
    exit;
}

if (strlen($mdp) < 6 || strlen($mdp) > 20) {
    header('location: inscription.php?message=The password must be between 6 and 20 characters!');
    exit;
}

if ($mdp != $_POST['mdp-confirm']) {
    header('location: inscription.php?message=Passwords do not match!');
    exit;
}

if (isset($name) && !empty($name)) {
    setcookie('name', $name, time() + 3600);
}
if (isset($username) && !empty($username)) {
    setcookie('username', $username, time() + 3600);
}
if (isset($date_of_birth) && !empty($date_of_birth)) {
    setcookie('date_of_birth', $date_of_birth, time() + 3600);
}
if (isset($email) && !empty($email)) {
    setcookie('email', $email, time() + 3600);
}

include '../includes/connexion_bdd.php';

$q = 'SELECT idUser, username, firstname, birthdate FROM User WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$email]);
$results = $req->fetchAll();

if (!empty($results)) {
    header('location:inscription.php?message=Email already used!');
    exit;
}

$token = ''; // Valeur par défaut pour le champ 'token'

$q = 'INSERT INTO User (username, firstname, birthdate, email, password, token) VALUES(?, ?, ?, ?, ?, ?)';
$req = $bdd->prepare($q);
$hashedPassword = password_hash($mdp, PASSWORD_DEFAULT); // Hachage du mot de passe avec bcrypt
$results = $req->execute([
    htmlspecialchars($username),
    htmlspecialchars($name),
    htmlspecialchars($date_of_birth),
    htmlspecialchars($email),
    $hashedPassword,
    $token
]);

if (!$results) {
    // Redirection avec un message d'erreur
    header('location: inscription.php?message=Connection error!');
    exit;
} else {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'patate.O2switch.net';
        $mail->SMTPAuth = true;
        if ($mail->SMTPAuth) {
            $mail->SMTPSecure = 'ssl';
            $mail->Username = 'derradji.ines@bessah.com';
            $mail->Password = 'P@ssword2023';
        }
        $mail->Port = 465;

        $mail->setFrom('derradji.ines@bessah.com', 'HOLOMUSIC');

        $q = 'SELECT * FROM User WHERE email = ?';
        $req = $bdd->prepare($q);
        $req->execute([$email]);
        $results = $req->fetchAll();

        foreach ($results as $row) {
            $email = strval($row['email']);
            $mail->addAddress($email);
        }

        $mail->isHTML(true);
        $mail->Subject = 'WELCOME TO HOLOMUSIC!';
        $mail->Body = 'Hi there!<br>
        Thank you for subscribing.<br>
        Stay updated with our latest <b>articles, news,</b> and insights about the music industry.';
        $mail->AltBody = 'News';

        $mail->send();

        header('location:connexion.php?message=Account created successfully!');
        exit;

    } catch (Exception $e) {
        header('Location: inscription.php?success=2');
        exit;
    }
}

?>
