  
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>Sign in</title>
	


	 <style>
        /* code CSS ici pour la page incription à la newsletter */
		
		
       *{
		   padding:0;
		   margin0;
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
	 max-width:1020px;
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
	   position:absolute;
	   height:100%;
	   width:45%;
	   top:0;
	   left:0;
	   
   }
   
   
      .sign-up{
	  position:absolute;
	  height:100%;
	  width: 55%;
	  left:45%;
	  top:0;
	  background-color:#8E0808;
	   background-image : url("https://i.pinimg.com/564x/33/aa/c6/33aac6ca36865e2ba573a7c28913fa54.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position:center;
      border-radius:20px;
  }
  
 
     form{ 
	 max-width:300px;
	 width:100%;
	 margin: 0 auto;
	 height:100%;
	 display:flex;
	 flex-direction:column;
	 justify-content:space-evenly;
	 
	 }
 
    .head1 p{
	 font-size:1.5rem;
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
	   
	   
	   
   .sign-up {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.sign-up-btn {
  margin-top: 10px;
   border:none;
	  cursor: pointer;
	  border-radius:20px;
	  font-size:18px;
       background-color:#8E0808;
       width:35%;
       padding:10px 12px;
	   height:40px;
	   text-decoration:none;
}

	    .sign-up-btn:hover {
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
	  
	  .sign-up{
		  
		 position:revert;
		 height:auto;
		 width:100%;
		 margin-top:10px;
		 padding:3rem 2rem;
		 display:flex;
		
	  }
		  
  .sign-up-btn {
  font-size:14px;
  width:100%;
  max-width:150px;
  }
  
  
  form{
	  max-width: revert;
	  paddding:1.5rem 2.5rem 2rem;
  }
  
 
  
  
  
   
   
   
   
   
   
    </style>
   
</head>
<body>

		<main>
		
		

		<div class="box1">
		
		
		  <div class="inner-box">
		 
		  <div class="formulaire">
		  <form action="verification_newsletter.php" method="POST" class="sign-in">
		     
			 
		 	 <div class="head1">
		    <p> Join our newsletter for captivating articles, expert insights,<br>
			  and the latest trends in the music industry.</p>
		     </div>
		  
		   
		   
		   <div class="actual-form">
		   <div class="input">
             <input type="email" name="email"  placeholder="Email" class="input-field">
		   </div>
		   
			  <?php

            if(isset($_GET['message']) && !empty($_GET['message'])){
                echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
            }
   
        ?>

             <input type="submit" value="Suscribe" class="sign-btn">
			
			 
			
			</div> 
         </form>
		 
		  </div>
		  
		  
		  
		  
		  <div class="sign-up">
		  
          </div>
		  
		  
        
       
		
		
		
		
		
		</div>
		</div>
		
		</main>
</body>
</html>
