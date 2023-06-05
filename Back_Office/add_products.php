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

    <title>Add products</title>
</head>
<body>
    <header>
    </header>
    <main>
<div class="container">
    <h2>Add products</h2>
    <?php
        if(isset($_POST['add'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];
            $image = $_POST['image'];
            























           
            

            if(!empty($name) && !empty($price) ){
                require_once 'include/database.php';
                $sqlState = $pdo->prepare('INSERT INTO products(name,price,discount,image) VALUES(?,?,?,?)');
                $sqlState->execute([$name,$price,$discount,$image]);
                ?>
                
                <div class="alert alert-success" role="alert">
                  <?php echo $name ?> is added succefuly
            </div>
            <?php
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    name , price are necessary
                </div>
                <?php
            }
        }
    ?>
      








        <form method="POST" enctype="multipart/form-data>
        <label class="form">name</label>
        <input type="text" class="form-control" name="name">
        
        <label class="form">price</label>
        <input type="number" step= "0.01" class="form-control" name="price" min="0">
        
        <label class="form">discount</label>
        <input type="range" value="0" class="form-control" name="discount" min="0" max="90">
       
        <label class="form">Image</label>
        <input type="file" class="form-control" name="image">
    
        <input type="submit" value="add products " class="btn-btn-primary my-4" name="add">
    
    
         </form>











    </div>
    </main>
    <footer></footer>
</body>
</html>