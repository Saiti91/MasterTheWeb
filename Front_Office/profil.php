<?php
//session_start();
$_SESSION['email'] = 'vellastephane91@gmail.com';
$link = '';
$titre = 'Profil';
include '../includes/header_index.php';
include '../includes/connexion_bdd.php';
//connexion check
//if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
//    header('location: connexion.php');
//    exit;
//}
$q = 'SELECT name,firstname,birthdate,username,email,image,bio,avatar FROM User WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['email']]);
$donnee = $req->fetchAll(PDO::FETCH_ASSOC);

foreach ($donnee as $item => $value) {
    echo '<div style="margin-top: 100px" class="container">
    <form action="verification_modif_profilUser.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="offset-1 col-4 pb-3">
                <label class="form">Username</label>
                <input type="text" class="form-control custom" name="username" value="' . ($value['username']) . '">
            </div>

            <div class="offset-1 col-4 pb-3">
                <label class="form">Name</label>
                <input type="text" class="form-control custom" name="name" value="' . ($value['name']) . '">
            </div>
        </div>
        <div class="row">
            <div class="offset-1 col-4 pb-3">
                <label class="form">First Name</label>
                <input type="text" class="form-control custom" name="firstname" value="' . ($value['firstname']) . '">
            </div>

            <div class="offset-1 col-4 pb-3">
                <label class="form">Password</label>
                <input type="text" class="form-control custom" name="password">
            </div>
        </div>
        <div class="row">
            <div class="offset-1 col-4 pb-3">
                <label class="form">Email</label>
                <input type="text" class="form-control custom" name="email" value="' . ($value['email']) . '">
            </div>
        </div>
        <div class="row">
            <div class=" col-12 pb-3">
                <label class="form">Biographie</label>
                <input type="text" class="form-control custom" name="bio" value="' . ($value['bio']) . '">
            </div>
        </div>
        <div class="row">
            <div class="offset-1 col-4 pb-3">
                <label class="form">Profil Picture</label>
                <img src="' . ($value['image']) . '" alt="Image de Profil">
            </div>

            <div class="offset-1 col-4 pb-3">
                <label class="form">Profil Picture</label>
                <input type="image" class="form-control custom" name="Image" accept="image/png,image/jpg,image/jpeg,image/gif">
            </div>
        </div>
        <input type="submit" value="Modify" class="btn btn-default btn-custom offset-9  my-4">
    </form>';
}


?>