<?php
session_start();
?>


<!DOCTYPE html>
<html>4
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="Style_nv_mdp.css"/>
	 <title>New password</title>
	


	 
   
</head>
<body>



		<main>
		
		
		
		

		<div class="box1">
		
		
		  <div class="inner-box">
		  
		 
		  <div class="formulaire">
		  <form action="verification-nv_mdp.php" method="POST" class="sign-in">
		     
			 
		 	 <div class="head1">
		     <h1>Your new password</h1>
			 <p>Please enter your new password.</p>
		     </div>
		  
		   <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?> "> 

		   
		   <div class="input">
             <input type="password" name="mdp" placeholder="Password" class="input-field">
		   </div> 
		   
		   <div class="head1">
			 <p>Confirm your password.</p>
		     </div>
		    <div class="input">
             <input type="password" name="newmdp" placeholder="Password" class="input-field">
		   </div> 
		 
		  
             <input type="submit" value="Submit" class="sign-btn">
			 
			 <?php

            if(isset($_GET['message']) && !empty($_GET['message'])){
                echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
            }
			
			?>
			
			
			
			<div class="head1">
						
			<?php
			  $successParam = htmlspecialchars($_GET['success'] ?? null);
			if ($successParam === '1') {
				echo 'Password reset successful';
			} elseif ($successParam === '2') {
				echo 'An error occurred.<br>Please try again ';
			}		
			?>
			
          </div>
   
   
  
			</div> 
         </form>
		 
		</div>
		</div>

		
		</main>
		
</body>
</html>
