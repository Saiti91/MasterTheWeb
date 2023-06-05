<?php
session_start();
?>


<!DOCTYPE html>
<html>4
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>New password</title>
	


	 <style>
	 
        /* code CSS ici pour la page new password */
		
		
       *{
		   padding:0;
		  
	  box-sizing:border-box;
	  font-family:'Raleway',sans-serif,bold;
  color:white;
  }
  
  
   body{ background-color:black;}
   
   main{ 
   width: 100%;
   min-height: 100vh;
   overflow:hidden;
   padding:2rem;
   display:flex;
   align-items:center;
   justify-content:center;}
   
   
   
   .box1{
	  position:relative;
	 width:100%;
	 width:500px;
	 height:500px;
	 background-color:#121317;
	 border-radius:20px;
 }
  
  
  
  
		 .inner-box{
	 position:absolute;
	 width:calc(100% - 4.1rem);
	 height:calc(100% - 4.1rem); 
	 
	 
	/*calculer la hauteur et la largeur grace à la fonction calc 100% de la largeur/hauteur (100%*hauteur/largeur-4.1rem )*/
	/* 4.1 rem est calculé par rapport à la taille de la racine qui par defaut est de 16px */
	/* 4.1rem equivaut à environ 65.6px 4.1rem*16px=65.6px*100 410% de la taille de la racine */
	 
	 
	 top: 50%;
	 left: 50%;
	 transform: translate(-50%,-50%);
	 
	 /* top:50% l'élement sera positionné à 50% de la hauteur de la box en partant du haut*/
	 /* left: 50% signifie que l'élément sera positionné à 50% de la largeur de son conteneur en partant de la gauche*/
	 /*transforme: translate(-50%,-50%) cette propriété m'a permis de déplacer l'élement de -50 de sa propre largeur*/
	 /*vers la gauche et 50 de sa hauteur vers le haut se qui m'a permis de corriger le positionneemnt de l'element*/
	 /* centré horizontelment et verticalment dans la box*/
   }
  
  
 
   .sign-in{
	   display:flex;
	   
	   justify-content:center;
	   height:100%;
	   width:100%;
	
	   
   }
   

  
 
     form{ 
	 max-width:400px;
	 width:100%;
	 margin: 0 auto;
	 height:100%;
	 display:flex;
	 flex-direction:column;
	 justify-content:space-evenly;
	 
	 }
 
    .head1 h1{
	 font-size:2.1rem;
	 font-weight:600;
	 display:flex;
	 align-item:center;
	 justify-content:center;
 }
 
  
  .input{
	 position: relative;
     height: 37 px;
	 margin-bottom:2rem; 
	 color:white;
  }
  
  
  form .input-field{
	  width:100%;
	  padding:12px 15px;
	  font-size:18px;
	  border: none;
	  border-radius:20px;  
	  background-color:rgba(102, 102, 102, 0.5);
   }
   
   
   .sign-btn{
	  display: inline-block;
	  width:50%;
	  height:40px;
	  background-color:#8E0808;
	  color:white;
	  border:none;
	  cursor: pointer;
	  border-radius:20px;
	  font-size:18px;
	  margin-bottom:2rem;
     /* margin-left:4rem;*/ 
   }

	    .sign-btn:hover {
    opacity: 0.8;
  }
	  
	   
	   

  @media (max-width: 850px){
	  .box1{
		  height: auto;
		  max-width:550px;
		  overflow:hidden;
	  }
	  
	  .inner-box{
		  position : static;
		  transform:none;
		  width:revert;
		  height: revert;  
		  padding:2rem;
	  }
	  
	  .sign-in{
		  position:revert;
		  width:100%;
		  height:auto;
	  }
	  
  form{
	  max-width: revert;
	  padding:1.5rem 2.5rem 2rem;
  }
  
  
  
  .head1{
  color:#8E0808;}
	  
  
  }
  
   
   
   
   
    </style>
   
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