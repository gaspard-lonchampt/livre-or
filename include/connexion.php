<?php

if (isset($_POST['username']) AND isset($_POST['password'])) {
	
	$login = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

}

try {



	$connexion = new PDO("mysql:host=localhost;dbname=livreor", 'root', 'root');
	$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


   $error = FALSE;

   // On vérifie d'abord que les infos viennent du formulaire
	if (isset($_POST['connexion'])) {

		// On vérifie que le login est remplis
		if ($login == NULL) {
				
				$error = TRUE;
				$errorMsg = "Identifant manquant";

		}

		// Sinon, on vérifie que le mot de passe est remplis
		elseif ($password == NULL) {

			$error = TRUE;
			$errorMsg = "Mot de passe manquant";

		}

		// Si les deux conditions précédente sont fausse, alors on vérifie le mot de passe
		else {

			$requete_connexion = $connexion->prepare("SELECT * FROM utilisateurs WHERE login = ?");
			$requete_connexion->execute([$_POST['username']]);
			$user = $requete_connexion->fetchall(); 

			var_dump($user);

			if($user AND password_verify($password, $user[0]['password'])) {

				$error = FALSE;

				$_SESSION['id'] 	   = $user[0]['id'];
				$_SESSION['login']     = $user[0]['login'];
				$_SESSION['password']  = $user[0]['password'];
				$_SESSION['cpassword'] = $user[0]['password'];

				header('Location:../index.php');
				exit();

			}
				else {

					$error = TRUE;
					$errorMsg = "Mot de passe ou identifiant incorrect"; 

				}
		}
	}
}

catch (PDOException $e) {
	echo 'Echec de la connexion : ' . $e->getMessage();
}
?>

	<!-- main -->
	<div class="main-w3layouts wrapper">
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="connexion.php" method="post">
                    <input class="text" type="text" name="username" placeholder="Identifiant" required="">
					<input class="text" type="password" name="password" placeholder="Mot de passe" required="">
					<div class="wthree-text">
                    <label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span> &nbsp; J'accèpte les conditions générales d'utilisation</span>
						</label>
						<div class="clear"> </div>
						<?php 

               if($error == TRUE) {
               echo '<span> <h5 class="text-danger text-center">'.$errorMsg.'</h5> </span>'; 
               }

               ?> 
					</div>
					<input type="submit" name="connexion" value="Connexion">
				</form>
				<p>Pas encore de compte ? <a href="../pages/inscription.php"> Inscrivez-vous !</a></p>
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
	<!-- //main -->