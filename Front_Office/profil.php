<?php
session_start();
include '../includes/connexion_check.php';
$link = '';
$titre = 'Profil';
include '../includes/header_index.php';
include '../includes/connexion_bdd.php';
//connexion check
//if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
//    header('location: connexion.php');
//    exit;
//}
?>

    <div class="container">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <!--avatar-->
                
                <!--Ligne haute-->
                <div>
                    <h3 class="">Cheveux</h3>
                    <img class=" col-1" src="../asset/assetAvatar/cheveux1.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class="col-1" src="../asset/assetAvatar/cheveux2.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class="col-1" src="../asset/assetAvatar/cheveux3.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class="col-1" src="../asset/assetAvatar/cheveux4.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class="col-1" src="../asset/assetAvatar/cheveux5.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class="col-1" src="../asset/assetAvatar/cheveux6.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                </div>

                <!--Ligne 1-->
                <!--moustache-->
                <div class="pt-1">
                    <h3 class="">Moustaches</h3>
                    <img class=" col-1" src="../asset/assetAvatar/moustache1.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class="col-1" src="../asset/assetAvatar/moustache2.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                </div>
                <div class="pt-1">
                    <h3 class="">Visages</h3>
                    <img class=" col-1" src="../asset/assetAvatar/visage1.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class="col-1" src="../asset/assetAvatar/visage2.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                </div>
                <div class="pt-1">
                    <h3 class="">Barbes</h3>
                    <img class=" col-1" src="../asset/assetAvatar/barbe1.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class="col-1" src="../asset/assetAvatar/barbe2.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <!--visage-->
                </div>
                <div class="pt-1">
                    <h3 class="">Bouches</h3>
                    <img class="  col-1" src="../asset/assetAvatar/bouche1.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class=" col-1" src="../asset/assetAvatar/bouche2.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                </div>
                <div class="pt-1">
                    <h3 class="">Yeux</h3>
                    <img class="  col-1" src="../asset/assetAvatar/oeil4.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class=" col-1" src="../asset/assetAvatar/oeil2.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                    <img class=" col-1" src="../asset/assetAvatar/oeil3.png" width="50px" height="50px"
                         style="border: white solid 1px" alt="">
                </div>
            </div>
        </div>
    </div>
<?php
$q = 'SELECT name,firstname,birthdate,username,email,image,bio,avatar FROM User WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['email']]);
$donnee = $req->fetchAll(PDO::FETCH_ASSOC);

foreach ($donnee as $item => $value) {
    echo '<div style="margin-top: 100px" class="container">
    <form action="verification_modif_profilUser.php" method="POST" enctype="multipart/form-data">
        <div class="row">
        <div class="col-5">
        <div class="row">
            <div class="offset-1 pb-3">
                <label class="form">Username</label>
                <input type="text" class="form-control custom" name="username" value="' . ($value['username']) . '">
            </div>
            </div>
             <div class="row">
            <div class="offset-1 pb-3">
                <label class="form">Name</label>
                <input type="text" class="form-control custom" name="name" value="' . ($value['name']) . '">
            </div>
        </div>
        <div class="row">
       
            <div class="offset-1 pb-3">
                <label class="form">First Name</label>
                <input type="text" class="form-control custom" name="firstname" value="' . ($value['firstname']) . '">
            </div>
            </div>
             <div class="row">
            <div class="offset-1 pb-3">
                <label class="form">Password</label>
                <input type="text" class="form-control custom" name="password">
            </div>
        </div>
        <div class="row">
            <div class="offset-1 pb-3">
                <label class="form">Email</label>
                <input type="text" class="form-control custom" name="email" value="' . ($value['email']) . '">
            </div>
        </div>
        <div class="row">
            <div class="offset-1 pb-3">
                <label class="form">Biographie</label>
                <input type="text" class="form-control custom" name="bio" value="' . ($value['bio']) . '">
            </div>
        </div>
        <div class="row">
            <div class="offset-1 pb-3">
                <label class="form">Profil Picture</label>
                <img src="' . ($value['image']) . '" alt="Image de Profil">
            </div>
            </div>
             <div class="row">
            <div class="offset-1 pb-3">
                <label class="form">Profil Picture</label>
                <input type="image" class="form-control custom" name="Image" accept="image/png,image/jpg,image/jpeg,image/gif">
            </div>
        </div>
        
        <input type="submit" value="Modify" class="btn btn-default btn-custom offset-1 my-4">
        </div>
       
        
            </div>
    </form>';
}


?>