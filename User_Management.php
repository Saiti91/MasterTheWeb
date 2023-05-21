<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
</head>
<body>
<header>

</header>
<main>
    <h1>Users Management</h1>

        <?php
        //include 'includes/Bdd_load.php';
        try{
            $bdd = new PDO('mysql:host=localhost;port=8889;dbname=masterthewebtest','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        catch(Exception $e){
            die('Erreur: '.$e->getMessage());
        }

        ?>
    <form action="User_Management.php" method="post">

        <select name="date" id="buy_date">
            <option value="">Choisissez une option</option>
            <option value="">les 3 derniers mois</option>
            <option value="les 6 derniers mois">les 6 derniers mois</option>
            <option value="les 9 derniers mois">les 9 derniers mois</option>
            <option value="l'année derniere">l'année derniere</option>
        </select>

        <select name="user" id="user">
            <option value="Tous les utilisateurs">Tous les utilisateurs</option>
            <option></option>
            <option></option>
            <option></option>
        </select>
        <select name="produit" id="produit">
            <option>Casquette</option>
            <option>T-shirts</option>
            <option>Tasses</option>
            <option>Echarpes</option>
        </select>
        <input type="submit" value="Filtrer">
    </form>
    <table>
        <?php
//
//        $q='SELECT * FROM users ORDER BY inscription_date DESC';
//        $req = $bdd-> prepare($q);
//        $req->execute();
//        $donnees = $req->fetchAll();

//        if($_POST['date']=="les 3 derniers mois")
//        {
//            $_POST['date']=date("Y-m-d",strtotime("-3 Months"));
//        }
//        else if($_POST['date']=="les 6 derniers mois")
//        {
//            $_POST['date']=date("Y-m-d",strtotime("-6 Months"));
//        }
//        else if($_POST['date']=="les 9 derniers mois")
//        {
//            $_POST['date']=date("Y-m-d",strtotime("-9 Months"));
//        }
//        else if($_POST['date']=="l'année derniere")
//        {
//            $_POST['date']=date("Y-m-d",strtotime("-12 Months"));
//        }
//        else
//        {
//            $_POST['date']=date("Y-m-d",1);
//        }

        $q='SELECT * FROM users';
        //WHERE inscription_date > ? ORDER BY inscription_date DESC
        $req = $bdd-> prepare($q);
        $req->execute();//date("Y-m-d"));
        $donnees = $req->fetchAll();

        foreach ($donnees As $index => $value){
            echo '<tr>';
                for($i=0;$i<count($value);$i++){
                    echo '<td>'.$value[$i].'</td>';
                }
            echo '</tr>';
        }
        ?>
    </table>
</main>
<footer>

</footer>
</body>
</html>
