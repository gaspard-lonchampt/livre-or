<?php 

if (isset($_SESSION['id'])) {
    header('Location:../index.php');
	exit();
}

 include ('../include/head.php'); 
 include ('../include/header.php'); 
?>

<?php 
include ('../include/commentaire.php'); 
?>

<?php
include ('../include/footer.php'); 
?>