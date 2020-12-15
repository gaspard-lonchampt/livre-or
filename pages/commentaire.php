<?php 

 include ('../include/head.php'); 
 include ('../include/header.php'); 

 if (!isset($_SESSION['id'])) {
    header('Location:../index.php');
	exit();
}
?>

<?php 
include ('../include/commentaire.php'); 
?>

<?php
include ('../include/footer.php'); 
?>