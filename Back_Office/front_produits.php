<?php
session_start();
require_once 'include/database.php';
$id = $_GET['id'];
$sqlState = $pdo->prepare("SELECT * FROM products WHERE id=?");
$sqlState->execute([$id]);
$produits = $sqlState->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"
      type="text/css">
    <title>products</title>
</head>
<body>
<div class="container py-2">
    <div class="container">
    <div class="row">
        <?php
           foreach ($products as $product) {


       ?>

<div class="card" mb-3 col-mb-4 style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php  echo $products->name ?></h5>
    <p class="card-text"><?php  echo $products->price ?></p>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
 
<?php
           }
?>
</div>
</div>
</div>
</body>
</html>