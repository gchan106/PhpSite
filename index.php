<?php
$page_title ='Home';
include('includes/header.html');
require("includes/DBconnect.php");
?>

	<!-- Banner -->
	<!-- Info Section -->
	
	<div class="d-flex px-5 flex-row  my-3 flex-wrap">
		<div class="cards d-flex flex-column flex-fill p-4 mx-2 my-2 my-lg-1 text-center">
			<img src="images/sushi0.jpg" class="img-fluid mx-auto d-block" alt="img">
			<h3><a href="catalog.php#sushi">Nigiri/Sashimi</a></h3>
			<p>Freshest Fish.</p>
		</div>
		<div class="cards d-flex flex-column flex-fill p-4 mx-2 my-2 my-lg-1 text-center">
			<img src="images/sushi1.JPG" class="img-fluid mx-auto d-block" alt="img">
			<h3><a href="catalog.php#roll">Sushi Rolls</a></h3>
			<p>Special Rolls All Day.</p>
		</div>
		<div class="cards d-flex flex-column flex-fill p-4 mx-2 my-2 my-lg-1 text-center">
			<img src="images/entree0.JPG" class="img-fluid mx-auto d-block" alt="img">
			<h3><a href="catalog.php#entree">Entrees</a></h3>
			<p>Chefs Specialty</p>
		</div>
				<div class="cards d-flex flex-column flex-fill p-4 mx-2 my-2 my-lg-1 text-center">
			<img src="images/appeitizer0.JPG" class="img-fluid mx-auto d-block" alt="img">
			<h3><a href="catalog.php#appeitizers">Appeitzers</a></h3>
			<p>Snack on Something</p>
		</div>
	</div>
	
	  <div class="container mt-3">
      <div class="row">
        <div class="col-12">
          <div id="carousel-Index" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel-Index" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-Index" data-slide-to="1"></li>
              <li data-target="#carousel-Index" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="images/roll7.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">

                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/sushi6.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/sushi7.jpg" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-Index" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-Index" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <hr>
    </div>
	
  <?php
echo'<br><br>';
include('includes/footer.html');
?>
