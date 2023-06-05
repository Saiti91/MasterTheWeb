<?php $titre = 'User Management';
include '../includes/header_backoffice.php'; ?>

<main>
    <h1>Users Management</h1>

    <?php
    //include 'includes/Bdd_load.php';
    try {
        $bdd = new PDO('mysql:host=localhost;port=3306;dbname=masterthewebpa', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }

    if (!isset($_POST['date']) || empty($_POST['date'])) {
        $_POST['date'] = date("Y/m/d", strtotime("-3 Months"));
    }
    if (!isset($_POST['suser']) || empty($_POST['suser'])) {
        $_POST['suser'] = "";
    }
    ?>

    <form class="container pb-4" action="User_Management.php" method="post">
        <div class="row">
            <div class="col-4">
                <label class="form-label" for="buy_date" id="1"> Date d'inscription : </label>
                <select class="form-select" name="date" id="buy_date">
                    <option value="<?php echo date("Y/m/d", strtotime("-3 Months")); ?>" <?php echo $_POST['date'] == date("Y/m/d", strtotime("-3 Months")) ? 'selected' : ''; ?> >
                        les 3 derniers mois
                    </option>
                    <option value="<?php echo date("Y/m/d", strtotime("-6 Months")); ?>" <?php echo $_POST['date'] == date("Y/m/d", strtotime("-6 Months")) ? 'selected' : ''; ?> >
                        les 6 derniers mois
                    </option>
                    <option value="<?php echo date("Y/m/d", strtotime("-9 Months")); ?>" <?php echo $_POST['date'] == date("Y/m/d", strtotime("-9 Months")) ? 'selected' : ''; ?> >
                        les 9 derniers mois
                    </option>
                    <option value="<?php echo date("Y/m/d", strtotime("-12 Months")); ?>" <?php echo $_POST['date'] == date("Y/m/d", strtotime("-12 Months")) ? 'selected' : ''; ?> >
                        l'année dernière
                    </option>
                </select>
            </div>
            <div class="col-4">
                <label class="form-label" for="suser">Utilisateurs :</label>
                <input class="form-control" type="search" name="suser" id="suser"
                       value="<?php echo !empty($_POST['suser']) ? $_POST['suser'] : ''; ?>">
            </div>
            <div style="padding-top: 31px" class="col-1">
                <input class="btn btn-default bg-light" type="submit" value="Filtrer">
            </div>
        </div>
    </form>

    <table class="table table-success table-striped">
        <?php

        if (empty($_POST['suser'])) {
            $_POST['suser'] = '%';
        } elseif (!empty($_POST['suser'])) {
            $_POST['suser'] .= '%';
        }
        $q = 'SELECT idUser,inscription,pseudo,email,Status FROM user WHERE inscription>= :time AND pseudo LIKE :pseudo';
        $req = $bdd->prepare($q);
        $req->execute(['time' => $_POST['date'], 'pseudo' => $_POST['suser']]);
        $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <tr>
            <th class="text-center">User ID</th>
            <th class="text-center">Date inscription</th>
            <th class="text-center">Pseudo</th>
            <th class="text-center">E-mail</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr>
        <?php
        foreach ($donnees as $index => $value) {
            echo '<tr>';
            foreach ($value as $i => $valeur) {
                echo '<td class="text-center">' . $valeur . '</td>';
            }
            echo '<td>
                    <form class="p-0 m-2 " method="post" action="User_Management.php">
                    <button type="submit" class="btn btn-primary" value="' . $value['idUser'] . '" name="mail" id="mail">Mail</button> 
                    <button type="submit" class="btn btn-danger" value="' . $value['idUser'] . '" name="exclude" id="exclude">Exclure</button>
                    </form>
                </td>';
            echo '</tr>';
        }
        if (empty($_POST['exclude'])) {
            $_POST['exclude'] = 0;
        } elseif ($_POST['exclude'] != 0) {
            $q = 'DELETE * FROM user WHERE idUser = :user ';
            $req = $bdd->prepare($q);
            $req->execute(['user' => $_POST['exclude']]);
            $_POST['exclude'] = 0;
        }
        ?>
    </table>
</main>
<footer>
    <!--    --><?php //
    //        include 'includes/footer.php';
    //    ?>
</footer>
</body>
</html>
