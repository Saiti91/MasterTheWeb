<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"
      type="text/css">
       <link href="style.css" rel="stylesheet">




    <title>Products Liste</title>
</head>
<body>
<div class="container">
    <h2>Products</h2>
    <a href="add_products.php" class="btn-btn-primary-add">Add New Product</a>
    <table class="table">

    <thead>
            <tr>-
                <th>#ID</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Date_of_publication</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
         <?php
          require_once 'include/database.php';
          $bdd = $pdo->query('SELECT * FROM products')->fetchAll(PDO::FETCH_ASSOC);
          foreach ($bdd as $products){
            ?>

            <tr>
                <td><?php echo $products['id'] ?></td>
                <td><?php echo $products['name'] ?></td>
                <td><?php echo $products['price'] ?>€</td>
                <td><?php echo $products['discount'] ?>%</td>
                <td><?php echo $products['date_of_publication'] ?></td>
                <td><?php echo $products['image'] ?></td>
                <td>
                    <a href="modify_product.php?id=<?php echo $products['id'] ?>" class="btn btn-primary">Modify</a>
                    <a href="delete_product.php?id=<?php echo $products['id'] ?>" onclick="return confirm('Do you really want to delete <?php echo $products['name'] ?>');" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>






















        
        






















</body>
</html>


    