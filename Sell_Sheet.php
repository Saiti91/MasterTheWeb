<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sells Sheet</title>
</head>
<body>
    <header>

    </header>
    <main>
        <h1>Sells Sheet</h1>
        <?php

            //include 'includes/Bdd_load.php';
            try{
                $bdd = new PDO('mysql:host=localhost;port=8889;dbname=masterthewebtest','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }
            catch(Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        function date(){
            if($_POST['date']="les 3 derniers mois")
            {
                $_POST['date']=strtotime("-3 Months");
            }
            if($_POST['date']="les 6 derniers mois")
            {
                $_POST['date']=strtotime("-6 Months");
            }
            if($_POST['date']="les 9 derniers mois")
            {
                $_POST['date']=strtotime("-9 Months");
            }
            else
            {
                $_POST['date']=strtotime("-12 Months");
            }
        }

        ?>
            <form action="Sell_Sheet.php" method="post">
                <select name="date" id="buy_date">

                    <option>les 3 derniers mois</option>
                    <option>les 6 derniers mois</option>
                    <option>les 9 derniers mois</option>
                    <option>l'année derniere</option>
                </select>

                <select name="user" id="user">

                    <option>Tous les utilisateurs</option>
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
                <input type="submit"  value="Filtrer">
            </form>
            <table>
            <?php

                $q='SELECT commande_id,Time,Article,Status, client_id FROM Commande';
                $req = $bdd-> prepare($q);
                $req->execute();
                $donnees = $req->fetchAll();


                date();
                if(!empty($_POST['date']) && !empty($_POST['user']) && !empty($_POST['produit']) ){
                    $q='SELECT commande_id,Time,Article,Status, client_id FROM Commande WHERE Time>=? AND Article = ? ORDER BY commande_id DESC ';
                    $req = $bdd-> prepare($q);
                    $req->execute([$_POST['date'],$_POST['produit']]);
                    $donnees = $req->fetchAll();
                }

                foreach($donnees As $index => $value){

                    echo '<tr>';
                    echo '<td> '.$donnees[$index]['commande_id'].' </td>';
                    echo '<td> '.$donnees[$index]['Time'].' </td>';
                    echo '<td> '.$donnees[$index]['Article'].' </td>';
                    echo '<td> '.$donnees[$index]['Status'].' </td>';
                    echo '<td> '.$donnees[$index]['client-id'].' </td>'; 
                    echo '</tr>';

                }
            ?>
</table>
    </main>
    <footer>

    </footer>
</body>
</html>