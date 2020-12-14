
<?php 

$repere = true;

// session_start();
include ('include/head.php'); 
include ('include/header.php'); 

// print_r($_SESSION)

?>


<main>
<div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="media/lapin1.jpg" alt="premier lapin">
      <div class="carousel-caption d-md-block">
    <h1 class="display-2">Adopter un lapin</h1>
    <h2 class="">Notre adorable lapin adulte recherche un foyer</h2>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="media/lapin2.jpg" alt="Second lapin" >
      <div class="carousel-caption d-none d-md-block mask flex-center rgba-green-strong">
    <h1 class=" display-2">Tic & Tac</h1>
    <h2 class="">Deux lapraux en recherche d'une famille d'accueil</h2>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="media/lapin3.jpg" alt="Troisième lapin">
      <div class="carousel-caption d-none d-md-block mask flex-center rgba-green-strong">
    <h1 class="display-2">La famille</h1>
    <h2 class="">Ces lapins sont inséparables et cherchent une ferme pour vivre ensemble</h2>
  </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</main>

<?php
include ('include/footer.php'); 
?>