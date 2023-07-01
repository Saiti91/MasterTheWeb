<?php
session_start();
include '../includes/connexion_check.php';
$link = '';
$script = "../JS/profil_avatar.js";
$titre = 'Profil';
include '../includes/header_index.php';
include '../includes/connexion_bdd.php';
?>

    <div class="container">
        <div class="row pt-5">
            <div class="col-6 avatar">
                <!--avatar-->
                <img id="visage1" class="visage" src="../asset/assetAvatar/visage1.png"
                     style="display: block; position: absolute;
                    top:100px; left: 130px; z-index: 0; height: 600px; width: 600px" alt="">
                <img id="visage2" class="visage" src="../asset/assetAvatar/visage2.png"
                     style="display: none; position: absolute;
                    top:100px; left: 130px; z-index: 0; height: 600px; width: 600px" alt="">
                <!--cheveux-->
                <img id="cheveux1" class="cheveux " src="../asset/assetAvatar/cheveux1.png"
                     style="display: none; position: absolute;
                    top:100px; left: 130px; z-index: 2; height: 600px; width: 600px" alt="">
                <img id="cheveux2" class="cheveux" src="../asset/assetAvatar/cheveux2.png"
                     style="display: none; position: absolute;
                    top:100px; left: 130px; z-index: 2; height: 600px; width: 600px" alt="">
                <img id="cheveux3" class="cheveux" src="../asset/assetAvatar/cheveux3.png"
                     style="display: none; position: absolute;
                    top:100px; left: 130px; z-index: 2; height: 600px; width: 600px" alt="">
                <img id="cheveux4" class="cheveux" src="../asset/assetAvatar/cheveux4.png"
                     style="display: none; position: absolute;
                    top: 100px; left: 130px; z-index: 2; height: 600px; width: 600px" alt="">
                <img id="cheveux5" class="cheveux" src="../asset/assetAvatar/cheveux5.png"
                     style="display: none; position: absolute;
                    top:100px; left: 130px; z-index: 2; height: 600px; width: 600px" alt="">
                <img id="cheveux6" class="cheveux" src="../asset/assetAvatar/cheveux6.png"
                     style="display: none; position: absolute;
                    top:100px; left: 130px; z-index: 2; height: 600px; width: 600px" alt="">
                <!--oeil-->
                <img id="oeil1" class="oeil" src="../asset/assetAvatar/oeil1.png"
                     style="display: none; position: absolute;
                    top:120px; left: 130px; z-index: 3; height: 600px; width: 600px" alt="">
                <img id="oeil2" class="oeil" src="../asset/assetAvatar/oeil2.png"
                     style="display: none; position: absolute;
                    top:120px; left: 130px; z-index: 3; height: 600px; width: 600px" alt="">
                <img id="oeil3" class="oeil" src="../asset/assetAvatar/oeil3.png"
                     style="display: none; position: absolute;
                    top:120px; left: 130px; z-index: 3; height: 600px; width: 600px" alt="">
                <img id="oeil4" class="oeil" src="../asset/assetAvatar/oeil4.png"
                     style="display: none; position: absolute;
                    top:120px; left: 130px; z-index: 3; height: 600px; width: 600px" alt="">
                <!--barbes-->
                <img id="barbe2" class="barbe" src="../asset/assetAvatar/barbe2.png"
                     style="display: none; position: absolute;
                    top:110px; left: 130px; z-index: 1; height: 600px; width: 600px" alt="">
                <img id="barbe1" class="barbe" src="../asset/assetAvatar/barbe1.png"
                     style="display: none; position: absolute;
                    top:110px; left: 130px; z-index: 1; height: 600px; width: 600px" alt="">

            </div>
            <div class="col-6" id="avatar">
                <div>
                    <h3 class="">Cheveux</h3>
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/cheveux1.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/cheveux2.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/cheveux3.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/cheveux4.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/cheveux5.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/cheveux6.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                </div>

                <div class="pt-1">
                    <h3 class="">Visages</h3>
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/visage1.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/visage2.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                </div>
                <div class="pt-1">
                    <h3 class="">Barbes</h3>
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/barbe1.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/barbe2.png"
                         width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <!--visage-->
                </div>
                <div class="pt-1">
                    <h3 class="">Yeux</h3>
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/oeil4.png" width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/oeil2.png" width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
                    <img draggable="true" class="draggable col-1" src="../asset/assetAvatar/oeil3.png" width="50px"
                         height="50px"
                         style="background-color:white; border: white solid 1px" alt="">
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
    </form>
    </div>';

}


include '../includes/footer.php';
?>