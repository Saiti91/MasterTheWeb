

<?php
try { 
// tenter de se connecter
    $bdd = new PDO("mysql:host=localhost; port=8889; dbname=master_theweb; charset=utf8", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) { // sinon, capturer le message d'erreur pour ne pas qu'il affiche des infos sur la BBDD (user/pass) et on affiche un message succint
    die("La connexion à la Base De Données n\'a pas pu s\'établir pour cause de : " . $e->getMessage());
}
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
        header('location: connexion.php?success=1');
    } else {
        header('location: nv_mdp.php?email='.$email.'&message=Passwords must match');
    }
}
?>
