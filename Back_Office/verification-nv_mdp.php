<?php
include "../includes/connexion_bdd.php";
//j'attache ma connexion à la BDD

if (isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['email']) && !empty($_POST['email'])) { // si le formulaire me renvoie ces deux variables je commence le traitement sinon je vais au else de la ligne 20
    $password = htmlspecialchars(($_POST['mdp']));
    /* echo 'password : ' . $password . '<br>'; */
    $newPassword = htmlspecialchars($_POST['newmdp']);
    /* echo 'New password : ' . $newPassword . '<br>'; */
    $email = trim($_POST['email']);
    /* echo 'email : ' . $email . '<br>'; */
    if ($password == $newPassword) {
        $password = hash('sha256', $password);
        /* echo '"password" est le même que "newPassword"<br>'; */
        $resetPassword = $bdd->prepare(" UPDATE users SET mdp = :mdp WHERE email = :email");
        $resetPassword->execute(array("mdp" => $password,
            "email" => $email)); // on modifie le PWD de la bdd par le nouveau PWD entré
        /* echo 'le nouveau mot de passe à été changé<br>'; */
        header('location: ../Front_Office/connexion.php?success=1');
    } else {
        header('location: ../Front_Office/nv_mdp.php?email=' . $email . '&message=Passwords must match');
    }
}
?>
