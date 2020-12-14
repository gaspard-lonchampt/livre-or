<?php 

if (isset($_SESSION['id'])) {
    header('Location:../index.php');
	exit();
}

 include ('../include/head.php'); 
 include ('../include/header.php'); 
?>

<?php 
include ('../include/connexion.php'); 
?>

<?php
include ('../include/footer.php'); 
?>