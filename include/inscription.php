<?php

if (isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['cpassword'])) {

   $login = htmlspecialchars($_POST['username']);
   $password = htmlspecialchars($_POST['password']);
   $cpassword = htmlspecialchars($_POST['cpassword']);
   
}


try {
	$connexion = new PDO("mysql:host=localhost;dbname=livreor", 'root', 'root');
	$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $error = FALSE;


   // On vérifie d'abord que les infos viennent du formulaire
	if (isset($_POST["register"])) {
      // On vérifie que tous les champs sont remplis
		if ($login == NULL OR $password == NULL OR $cpassword == NULL) {
			
			$error = TRUE;
         $errorMsg = "Veuillez remplir tous les champs !";

      }

      elseif(!empty($login)) {

         $requete_same_login = $connexion->prepare(
               "SELECT * FROM utilisateurs WHERE login = ?"
            );
         
         $requete_same_login->execute([$login]);
         $count= $requete_same_login->rowCount();
         
      
            if ($count>0) {
   
               $error = TRUE;
               $errorMsg = "L'identifiant est déjà prit";
   
            }

            // Sinon, on vérifie que les mdp ne sont pas les mêmes et on affiche un msg d'erreur
            elseif ($password != $cpassword) {

               $error = TRUE;
               $errorMsg = "Le mot de passe et la confirmation sont différents";

            }

            // Sinon si le nom de compte et le mot de passe ont la même valeur :
            elseif ($login == $password) {

               $error = TRUE;
               $errorMsg = "L'identifiant et le mot de passe doivent être différents";

            }

            //Sinon on vérifie si les tailles de caractères sont conformes à ceux définis dans SQL (-de 245car)
            elseif (strlen($login) > 60) {
               
               $error = TRUE;
               $errorMsg = "L'identifiant doit faire moins de 60 caractères";

            }

            elseif ( 
            strlen($password) < 8 AND 
            !preg_match("[A-Z]", $password) AND 
            !preg_match("[a-z]", $password) AND 
            !preg_match("[\W_]", $password) AND
            !preg_match("[0-9]", $password) ) {

               $error = TRUE;
               $errorMsg = "Le mot de passe doit contenir plus de 8 caractères, doit contenir une majuscule, une majuscule, un chiffre et un caractère spécial";
               
            }
               
            // On vérifie si le mdp et la confirmation sont pareil, si oui, on continue à valider le reste et à envoyer les données si tout est bon
            elseif ($password == $cpassword) {

               $hash = password_hash($password, PASSWORD_DEFAULT);

               $requete_register = $connexion->prepare(
                  "INSERT INTO utilisateurs(login,password)
                  VALUES(:login,:password)"
               );
               
               $requete_register->execute(array(
                  'login' => $login,
                  'password' => $hash));
               
               header('Location:connexion.php');
               exit();
               
            }
      }
	}
}

catch (PDOException $e) {
	echo 'Echec de la connexion : ' . $e->getMessage();
}
?>


<div class="main-w3layouts wrapper">
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="../pages/inscription.php" method="post">
                    <input class="text" type="text" name="username" placeholder="Identifiant" required="">
                    <input class="text" type="password" name="password" placeholder="Mot de passe" required="">
                    <input class="text w3lpass" type="password" name="cpassword" placeholder="Confirmation du mot de passe" required="">
                    <div class="wthree-text">
                    <div class="clear"> </div>
                    </div>

               <?php 

               if(isset($error)){
                  if($error == TRUE) {
                  echo '<span> <h5 class="text-danger text-center">'.$errorMsg.'</h5> </span>'; 
                  }
               }

               ?> 

					<input type="submit" name="register" value="Inscription">
				</form>
				<p>Déjà un compte ? <a href="../pages/connexion.php"> Connectez-vous !</a></p>
			</div>
		</div>
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
