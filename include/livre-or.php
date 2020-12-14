<?php 


try {

$connexion = new PDO("mysql:host=localhost;dbname=livreor", 'root', 'root');
$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete_admin = $connexion->prepare("SELECT login, date, commentaire FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ORDER BY date DESC");
$requete_admin->execute();
$result = $requete_admin->fetchall(PDO::FETCH_ASSOC);
}
    
catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
}


?>

<div class="container p-3">
<div class="agileits-top">

            <?php 
            foreach ($result as $key => $value) { ?>
                <table class="table table-striped table-hover table-dark">
                <tbody>
                <tr>
                    <td scope="col" class="text-left">
                    <?php echo $value['login'] ?> </td>
                    <td class="text-right"> 
                    <?php echo $value['date'] ?> </td>
                </tr>
                <tr>
                    <td scope="col" colspan="2">
                    <?php echo $value['commentaire'] ?> </td>
                </tr>
               
            <?php
             }   
             ?>
        </tbody>
    </table>
</div>
</div>