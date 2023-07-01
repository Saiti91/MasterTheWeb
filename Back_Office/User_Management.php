<?php
session_start();
include '../includes/connexion_check_admin.php';
$link = '../CSS/style_s.css';
$script = '../JS/search_user_management.js';
$titre = 'User Management';
include '../includes/header_backoffice.php'; ?>

<main class="bg-black text-light">
    <div class="container pt-5 ">
        <div class="row">
            <h1 class="col-4">Users Management</h1>
            <div style="padding-top: 31px" class="offset-7 col-1">
                <a href="add_user.php" class="btn rounded-pill btn-custom">+</a>
            </div>
        </div>
        <?php
        include '../includes/connexion_bdd.php';
        ?>

        <form class="container pb-4" method="post">
            <div class="row">
                <!--                <div class="col-4">-->
                <!--                    <label class="form-label" for="buy_date" id="1"> Date d'inscription : </label>-->
                <!--                    <select class="form-select" name="date" id="buy_date">-->
                <!--                        <option value="-->
                <?php //echo date("Y/m/d", strtotime("-3 Months")); ?><!--" -->
                <?php //echo $_POST['date'] == date("Y/m/d", strtotime("-3 Months")) ? 'selected' : ''; ?><!-- >-->
                <!--                            les 3 derniers mois-->
                <!--                        </option>-->
                <!--                        <option value="-->
                <?php //echo date("Y/m/d", strtotime("-6 Months")); ?><!--" -->
                <?php //echo $_POST['date'] == date("Y/m/d", strtotime("-6 Months")) ? 'selected' : ''; ?><!-- >-->
                <!--                            les 6 derniers mois-->
                <!--                        </option>-->
                <!--                        <option value="-->
                <?php //echo date("Y/m/d", strtotime("-9 Months")); ?><!--" -->
                <?php //echo $_POST['date'] == date("Y/m/d", strtotime("-9 Months")) ? 'selected' : ''; ?><!-- >-->
                <!--                            les 9 derniers mois-->
                <!--                        </option>-->
                <!--                        <option value="-->
                <?php //echo date("Y/m/d", strtotime("-12 Months")); ?><!--" -->
                <?php //echo $_POST['date'] == date("Y/m/d", strtotime("-12 Months")) ? 'selected' : ''; ?><!-- >-->
                <!--                            l'année dernière-->
                <!--                        </option>-->
                <!--                    </select>-->
                <!--                </div>-->
                <div class="col-4">
                    <label class="form-label" for="suser">Utilisateurs :</label>
                    <input class="form-control" type="search" name="suser" id="suser"
                           value="<?php echo !empty($_POST['suser']) ? $_POST['suser'] : ''; ?>">
                </div>
                <div style="padding-top: 31px" class="col-1">
                    <input class="btn btn-default btn-custom" id="subRUser" type="submit" value="Filtrer">
                </div>
            </div>
        </form>


        <table class="table text-center table-bordered table-success table-striped">
            <thead>
            <tr>
                <th class="text-center">User ID</th>
                <th class="text-center">Date inscription</th>
                <th class="text-center">Pseudo</th>
                <th class="text-center">E-mail</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody id="searchResults">
            </tbody>
        </table>
    </div>
</main>
<footer>
</footer>
</body>
</html>
