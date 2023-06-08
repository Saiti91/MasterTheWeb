<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'C:\MAMP\htdocs\PHPMailer\src\Exception.php';
require 'C:\MAMP\htdocs\PHPMailer\src\PHPMailer.php';
require 'C:\MAMP\htdocs\PHPMailer\src\SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'patate.O2switch.net';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    if ($mail->SMTPAuth) {
        $mail->SMTPSecure = 'ssl';               //Protocole de sécurisation des échanges avec le SMTP
        $mail->Username = 'derradji.ines@bessah.com';   //Adresse email à utiliser
        $mail->Password = 'P@ssword2023';         //Mot de passe de l'adresse email à utiliser
    }
    $mail->Port = 465;


    $mail->setFrom('derradji.ines@bessah.com', 'HOLOMUSIC');

    require_once '../includes/connexion_bdd.php';
    $q = 'SELECT id,email,username,fistname, date_of_birth FROM users WHERE email=?';
    $req = $bdd->prepare($q);
    $req->execute([$_POST['email']]);
    if ($req->rowCount() > 0) {
        $results = $req->fetchAll();

        foreach ($results as $row) {
            $email = strval($row['email']);
            $username = strval($row['username']);
            $mail->addAddress($email, $username);
        }
    }

    //piece joint images ou autres 
    //$mail->addAttachment('/var/tmp/file.tar.gz');         
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    


    $mail->isHTML(true);
    $mail->Subject = 'Reset Password Link';
    $mail->Body = 'Hi, Here the link to Reset your password!<br>
	Click the link below: <br>
	<b><a href="http://localhost:8888/PA HOLOMUSIC/nv_mdp.php/nv_mdp.php?email=' . $email . '"target="_blank" >New password</a>
    </b>';


    // une session id pour recuperer l'emai??


    $mail->AltBody = 'Reset your password';

    $mail->send();

    header('location: ../fFront_Office/forgot-mdp.php?success=1');
    exit;

} catch (Exception $e) {

    header('location: ../fFront_Office/forgot-mdp.php?success=2');
    exit;

}


?>

	
		
		