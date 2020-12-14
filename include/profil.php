<?php

if (isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['cpassword'])) {

    $login = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $cpassword = htmlspecialchars($_POST['cpassword']);
    
}

try {
	$connexion = new PDO("mysql:host=localhost;dbname=livreor", 'root', 'root');
   $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e) {
	echo 'Echec de la connexion : ' . $e->getMessage();
}

$error = FALSE;
$sucess = FALSE;
$errorMsg = FALSE;
$sucessMsg = FALSE;

//préparation des requêtes
$requete_same_login = $connexion->prepare(
   "SELECT * FROM utilisateurs WHERE login = ?"
);

$requete_update = $connexion->prepare(
   "UPDATE utilisateurs SET login= ?, password= ? WHERE id= ?"
);

// On vérifie d'abord que les infos viennent du formulaire
if (isset($_POST["register"])) {

   // Changement du login seul
   if ($login !== NULL AND $_POST['password'] == NULL AND $_POST['cpassword'] == NULL) {

      $requete_same_login->execute([$login]);
      $count= $requete_same_login->rowCount();
      $user = $requete_same_login->fetchall(); 

      echo "Première condition check";

      if ($count>0 AND $user[0]['id'] == $_SESSION['id']) {
         $error = TRUE;
         $errorMsg = "Ceci est déjà votre identifiant";

         echo "1 condition dans 1ère";
      }
      elseif ($count>0 AND $user[0]['id'] !== $_SESSION['id']) {   

         $error = TRUE;
         $errorMsg = "Identifiant déjà prit";

         echo "2 condition dans 1ère";
      }
      else {
         if (strlen($login) > 60) {
            $error = TRUE;
            $errorMsg = "L'identifiant doit faire moins de 60 caractères"; 

            echo "3 condition dans 1ère";
         }
         else {
         $requete_update->execute([$login, $_SESSION['password'], $_SESSION['id']]);
         $sucess = TRUE;
         $sucessMsg = "Identifiant mis à jour";
         $_SESSION['login'] = $login;

         echo "4 condition dans 1ère";
         }
      }
   }
         
         
   // Changement du password seul
   elseif ($login == $_SESSION['login'] AND $password !== NULL and $cpassword !== NULL) {
            // On vérifie que les mdp ne sont pas les mêmes et on affiche un msg d'erreur
            if ($password != $cpassword) {
               $error = TRUE;
               $errorMsg = "Le mot de passe et la confirmation sont différents";
            }
            // Sinon on check le nom de compte et le mot de passe
            elseif ($login == $password) {
               $error = TRUE;
               $errorMsg = "L'identifiant et le mot de passe doivent être différents";
            }
            // On check les pré-requis mot de passe
            elseif (!preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#", $password)) {
                  $error = TRUE;
                  $errorMsg = "Le mot de passe doit contenir plus de 8 caractères, doit contenir une majuscule, une majuscule, un chiffre et un caractère spécial"; 
               }
            // les conditions sont remplis, on update
            else {
               $hash = password_hash($password, PASSWORD_DEFAULT);
               $id = $_SESSION['id'];
               $requete_update->execute([$login, $hash, $id]);
               $sucess = TRUE;
               $sucessMsg = "Mot de passe mis à jour";
            }
   } 
   
   elseif ($login !== NULL AND $password !== NULL AND $cpassword !== NULL) {
      $requete_same_login->execute([$login]);
      $count= $requete_same_login->rowCount();
      $user = $requete_same_login->fetchall(); 

      if ($count>0 AND $user[0]['id'] == $_SESSION['id']) {
         $error = TRUE;
         $errorMsg = "Ceci est déjà votre identifiant";
      }
      elseif ($count>0 AND $user[0]['id'] !== $_SESSION['id']) {   
         $error = TRUE;
         $errorMsg = "Identifiant déjà prit";
      }
      // On vérifie que les mdp ne sont pas les mêmes et on affiche un msg d'erreur
      elseif ($password != $cpassword) {
         $error = TRUE;
         $errorMsg = "Le mot de passe et la confirmation sont différents";
      }
      // Sinon on check le nom de compte et le mot de passe
      elseif ($login == $password) {
         $error = TRUE;
         $errorMsg = "L'identifiant et le mot de passe doivent être différents";
      }
      // On check les pré-requis mot de passe
      elseif (!preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#", $password)) {
         $error = TRUE;
         $errorMsg = "Le mot de passe doit contenir plus de 8 caractères, doit contenir une majuscule, une majuscule, un chiffre et un caractère spécial"; 
      }
      // les conditions sont remplis, on update
      else {
         $hash = password_hash($password, PASSWORD_DEFAULT);
         $id = $_SESSION['id'];
         $requete_update->execute([$login, $hash, $id]);
         $sucess = TRUE;
         $sucessMsg = "Mot de passe et identifiant mis à jour";
         $_SESSION['login'] = $login;
      }
   }
}
?>

<div class="main-w3layouts wrapper">
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="../pages/profil.php" method="post">
               <input class="text mb-5" type="text" name="username" value="<?php echo $_SESSION['login'] ?>" >
               <label class="text-white" for="password">Entrer votre mot de passe</label>
					<input class="text w3lpass mt-1 mb-5" type="password" name="password" placeholder="Mot de passe">
               <label class="text-white" for="cpassword">Confirmer votre mot de passe</label>
					<input class="text w3lpass mt-1 mb-4" type="password" name="cpassword" placeholder="Confirmation de votre mot de passe">
					<div class="wthree-text">
						<div class="clear"> </div>
					</div>

               <?php 
                     if($error == TRUE) {
                     echo '<span> <h5 class="text-danger text-center">'.$errorMsg.'</h5> </span>'; 
                     }
                     elseif ($sucess = TRUE) {
                      echo '<span> <h5 class="text-white text-center">'.$sucessMsg.'</h5> </span>';
                     }
                  
               ?> 

					<input type="submit" name="register" value="Modifier vos informations">
				</form>
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
