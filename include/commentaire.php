<?php

if (isset($_POST['comment'])) {

   $comment = htmlspecialchars($_POST['comment']);
   
}


try {

	$connexion = new PDO("mysql:host=localhost;dbname=livreor", 'root', 'root');
	$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e) {
	die('Erreur : ' . $e->getMessage());
}

    $error = FALSE;
    $sucess = FALSE;
    $sucessMsg = FALSE;
    $errorMsg = FALSE;


   // On vérifie d'abord que les infos viennent du formulaire
	if (isset($_POST["validate"])) {
      // On vérifie que tous les champs sont remplis
		if ($comment == NULL) {
			
			$error = TRUE;
            $errorMsg = "Veuillez remplir tous les champs !";

      }

      else {

        $requete_commentaire = $connexion->prepare(
            "INSERT INTO commentaires(commentaire,id_utilisateur,date)
            VALUES(:commentaire,:id_utilisateur,:date)"
         );

         $id_utilisateur = $_SESSION['id'];
         $date = date('Y-m-d H:i:s');
         
         if (
            $requete_commentaire->execute(array(
            'commentaire' => $comment,
            'id_utilisateur' => $id_utilisateur,
            'date' => $date))                   ) 
        {
            $sucess = TRUE;
            $sucessMsg = "Message posté avec succès !";
        }

        else {
            print_r($requete_commentaire->errorInfo());
        }

         $requete_commentaire->closeCursor();
      }

    }




?>


<div class="main-w3layouts wrapper">
	<div class="main-agileinfo">
		<div class="agileits-top">
            <form  class="was-validated" action="../pages/commentaire.php" method="post">
                <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Ecrivez votre commentaire ici" name="comment" required></textarea>
                <input type="submit" name="validate" value="Valider">

                <?php 

                    if(isset($error, $sucess)){
                       if($error == TRUE) {
                       echo '<span> <h5 class="text-danger text-center">'.$errorMsg.'</h5> </span>'; 
                       }
                       elseif ($sucess = TRUE) {
                        echo '<span> <h5 class="text-white text-center">'.$sucessMsg.'</h5> </span>';
                       }
                    }
                    ?> 

			</form>
        </div>
    </div>
</div>