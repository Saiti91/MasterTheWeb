<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'C:\MAMP\htdocs\Projet Annuel\MasterTheWeb\PHP_Mailer\src\Exception.php';
require 'C:\MAMP\htdocs\Projet Annuel\MasterTheWeb\PHP_Mailer\src\PHPMailer.php';
require 'C:\MAMP\htdocs\Projet Annuel\MasterTheWeb\PHP_Mailer\src\SMTP.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();  // Send using SMTP
    $mail->Host = 'patate.O2switch.net';  // Set the SMTP server to send through
    $mail->SMTPAuth = true;  // Enable SMTP authentication

    if ($mail->SMTPAuth) {
        $mail->SMTPSecure = 'ssl';  // Protocole de sécurisation des échanges avec le SMTP
        $mail->Username = 'derradji.ines@bessah.com';  // Adresse email à utiliser
        $mail->Password = 'P@ssword2023';  // Mot de passe de l'adresse email à utiliser
    }

    $mail->Port = 465;

    $mail->setFrom('derradji.ines@bessah.com', 'HOLOMUSIC');

    require_once '../includes/connexion_bdd.php';
    $q = 'SELECT idUser, email, username, firstname, birthdate FROM User WHERE email = ?';
    $req = $bdd->prepare($q);
    $req->execute([$email]);

    if ($req->rowCount() > 0) {
        $results = $req->fetchAll();

        foreach ($results as $row) {
            $email = $_POST['email'];
            $token = bin2hex(random_bytes(16));

            // Stocker le jeton dans la base de données pour cet utilisateur
            $stmt = $bdd->prepare("UPDATE User SET token = :token WHERE email = :email");
            $stmt->execute([
                "token" => $token,
                "email" => $email
            ]);

            // Construire l'URL de réinitialisation en utilisant le jeton
            $resetUrl = 'http://localhost/Projet Annuel/MasterTheWeb/Front_Office/nv_mdp.php?email=' . $email . '&token=' . $token;

            $mail->addAddress($email);
        }
    }

    $mail->isHTML(true);
    $mail->Subject = 'Reset Password Link';
    $mail->Body = 'Hi, Here is the link to reset your password!<br>
        Click the link below: <br>
        <b><a href="' . $resetUrl . '" target="_blank">New password</a></b>';
    $mail->AltBody = 'Reset your password';

    $mail->send();

    header('location:forgot-mdp.php?success=1');
    exit;

} catch (Exception $e) {
    header('location:forgot-mdp.php?success=2');
    exit;
}

?>
