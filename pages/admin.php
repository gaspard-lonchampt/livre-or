<?php 
include ('../include/head.php'); 
include ('../include/header.php'); 

if ($_SESSION['id'] != "1") {
    header('Location:../index.php');
	exit();
}

include ('../include/admin.php');

include ('../include/footer.php'); 
?>