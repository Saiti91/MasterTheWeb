<?php

require_once 'connexionDb.php';
if (isset($_POST['email'])) {
	$email = htmlspecialchars($_POST['email']);
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        header('location:forgot-mdp.php?message=Invalid Email');
        exit;
    } else {
        $q = 'SELECT id,username,fistname,date_of_birth FROM users WHERE email = ?';
        $req = $bdd->prepare($q);
        $req->execute([$_POST['email']]);
        $results = $req->fetchAll();
        if (empty($results)) {
            header('location:forgot-mdp.php?message=Email does not exist !');
            exit;
        } else {
            include("mailTest2.php");
        }
    }
}