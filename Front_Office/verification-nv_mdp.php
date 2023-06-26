<?php
session_start();
require_once '../includes/connexion_bdd.php';

if (isset($_POST['mdp'], $_POST['confirm_mdp'], $_POST['token'], $_POST['email'])) {
    $password = $_POST['mdp'];
    $confirmPassword = $_POST['confirm_mdp'];
    $token = $_POST['token'];
    $email = $_POST['email'];

    // Vérifier si le mot de passe et la confirmation du mot de passe correspondent
    if ($password !== $confirmPassword) {
        header('Location: nv_mdp.php?email=' . $email . '&token=' . $token . '&error=Passwords do not match');
        exit;
    }

    // Vérifier si le jeton est valide
    $q = 'SELECT email FROM User WHERE token = :token';
    $req = $bdd->prepare($q);
    $req->execute([':token' => $token]);
    $result = $req->fetch();


// Mettre à jour le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $q = 'UPDATE User SET password = :password  WHERE email = :email';
    $stmt = $bdd->prepare($q);
    $stmt->execute([':password' => $hashedPassword, ':email' => $email]);


// Vérifier si la mise à jour a réussi
    if ($stmt->rowCount() > 0) {
        // Mot de passe mis à jour avec succès
        header('Location: connexion.php?success=1');
        exit;
    } else {
        // Une erreur s'est produite lors de la mise à jour du mot de passe
        header('Location: nv_mdp.php?email=' . $email . '&token=' . $token . '&error=An error occurred while updating the password');
        exit;
    }
} else {
    // Rediriger vers la page de connexion si les paramètres sont manquants
    header('Location: connexion.php');
    exit;
}
?>
