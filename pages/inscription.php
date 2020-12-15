<?php 

 include ('../include/head.php'); 
 include ('../include/header.php'); 



 if (isset($_SESSION['id'])) {
    header('Location:../index.php');
	exit();
}

include ('../include/inscription.php'); 

 ?>



 <?php
 include ('../include/footer.php'); 
?>
