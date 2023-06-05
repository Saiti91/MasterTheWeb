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
    <title>Add events</title>
    
</head>
<body>
<div class="container">

  <h2>Add New event</h2>
    <?php
        if(isset($_POST['add'])){
            $name = $_POST['name'];
            $discription = $_POST['discription'];
            $date = $_POST['date'];
            $place = $_POST['place'];
            $url = $_POST['url'];
            $image = $_POST['image'];
            

            if(!empty($name) && !empty($discription)){
                require_once 'include/database.php';
                $res = $pdo->prepare('INSERT INTO events(name,date,place,discription,url,image) VALUES(?,?,?,?,?,?)');
                $res->execute([$name,$date,$place,$discription,$url,$image]);
                ?>
                
                <div class="alert alert-success" role="alert">
                  The event is added succefuly
            </div>
            <?php
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    the name of the artist and the discription are necessary
                </div>
                <?php
            }
        }
    ?>

<form method="POST">
        <label class="form">artist name</label>
        <input type="text" class="form-control" name="name">
        
        <label class="form">Discription</label>
        <textarea class="form-control" name="discription"></textarea>
        
        <label class="form">date of the event</label>
        <input type="date"  class="form-control" name="date">

        <label class="form">place</label>
        <input type="text" class="form-control" name="place">

        <label class="form">url</label>
        <textarea class="form-control" name="url"></textarea>
        
        <label class="form">Image</label>
        <input type="file" class="form-control" name="image">
    
        <input type="submit" value="add event" class="btn-btn-primary my-2" name="add">
    
    
         </form>
</div>
</body>
</html>