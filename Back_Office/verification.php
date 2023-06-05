 <?php
 
 session_start();

if (!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['mdp']) || empty($_POST['mdp'])) {
    header('location:connexion.php?message=You must fill in both fields');
    exit;
}
	
	
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('location:connexion.php?message=Invalid Email');
    exit;
}
	
try {
    $bdd = new PDO('mysql:host=localhost;port=8889;dbname=master_theweb', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die($e->getMessage());
}

$q = 'SELECT id FROM users WHERE email = ? AND mdp = ?';
$req = $bdd->prepare($q);
$email=($_POST['email']);
$mdp=hash('sha256',( $_POST['mdp'] ));
$req->execute (array($email, $mdp));
$results = $req->fetchAll();

if (empty($results)) {
    header('location:connexion.php?message=Incorrect identifier');
    exit;
} else {
   
    $_SESSION['email'] = $_POST['email'];
	
	// Récupérer l'ID de l'utilisateur et le nom !
   $userId = $results[0]['id'];
    $username = $results[0]['username'];
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    
    header('location:Home page.php');
    exit;
}
?>

	
	
	
	
	
	
	 
	

	
	
	

	
	
	
	
  








// les donnees du formulaire arrivent des la $_ POST  
// si l'email n'est pas vide on enregistre l'email dans un cookie avec la fonction setcookie()
//  3 faire une rediraction dans le cas ou password ou email empty  affiche message 
// redirection vers page connexion si erreur et message erreur (dans url connexion.php?.message=erreur)
	
	
	
	// function writeLogLine($success, $email){
	// $log=fopen('log.txt', 'a+');
		// $line=date('Y/m/d - H:i;s').'Tentative de connexion '.($success? 'réussi' : 'echoué').'reussie de :'.$_POST['email']."/n";
		// fputs($log, $line);
		// fclose($log);
}
 // CODE COOKIE if (isset($_POST['email'])&& !empty($_POST['email'])){
    // setcookie('email',$_POST['email'],time()+ 24*3600);
	// }
// if (isset($_POST['email'])&& !empty($_POST['email'])){
    // setcookie('email',$_POST['email'],time()+ 24*3600);
	// }
	
	
	
	



  


	
	
	
	
	
	
	
	