<?php
$page_title ='Catalog';
include('includes/header.html');
require("includes/DBconnect.php");
?>
	  <div class="container mt-3" id="appeitizers">
      <div class="row">
        <div class="col-12">
          <div id="carousel-Index" class="carousel slide" data-ride="carousel">

            <?php
            $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE type='appeitizer'");
            // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->error) 
            {
              trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
              return $ret;
            }
            if($stmt->execute())
            {
              $first = true;
              $result = $stmt->get_result(); // Het the result from the executed statement.
              $rows = $result->num_rows;

              echo '<ol class="carousel-indicators">';
              for($i = 0;$i<$rows;$i++)
              {
                 echo '<li data-target="#carousel-Index" data-slide-to="' . $i . '" class="' . (($first) ? "active" : "") . '"></li>';
                $first = false;
              }
              echo '</ol><div class="carousel-inner">';
              $first = true;
              while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
              {

                echo '<div class="carousel-item ' . (($first) ? "active" : "") . '">
                  <img class="d-block w-100" src="' . $row["image"] . '" alt="sushi">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>' . $row["name"] . '</h5>
                    <p>' . $row["description"] . '</p>
                  </div>
                </div>';
                $first = false;
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();

            ?>
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
      
    <hr>

    <hr>
    <h2 class="text-center">Fresh Fish All Day Every Day</h2>
    <hr>
    
    <div class="container">

      <div class="row text-center">

      <?php
              $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE type='appeitizer'");
            // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->error) 
            {
              trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
              return $ret;
            }
            if($stmt->execute())
            {
              $result = $stmt->get_result(); // Het the result from the executed statement.
              while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
              {


                echo '<div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                  <img class="card-img-top" src="' . $row["image"] . '" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">' . $row["name"] . '</h5>
                    <p class="card-text">' . $row["description"] . '</p>
                    <p class="card-text">$' . $row["price"] . '</p>
                    <a href="addcart.php?productID=' . $row["id"] . '" class="btn btn-primary">Add to Cart</a>
                    <form action="addcart.php" method="get">
                    <form>
                  </div>
                  </div></div>';
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();

            ?>
      </div>
      </div>
      </div>


      <div class="container mt-3" id="entrees">
      <div class="row">
        <div class="col-12">
          <div id="carousel-Index" class="carousel slide" data-ride="carousel">

            <?php
            $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE type='entree'");
            // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->error) 
            {
              trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
              return $ret;
            }
            if($stmt->execute())
            {
              $first = true;
              $result = $stmt->get_result(); // Het the result from the executed statement.
              $rows = $result->num_rows;

              echo '<ol class="carousel-indicators">';
              for($i = 0;$i<$rows;$i++)
              {
                 echo '<li data-target="#carousel-Index" data-slide-to="' . $i . '" class="' . (($first) ? "active" : "") . '"></li>';
                $first = false;
              }
              echo '</ol><div class="carousel-inner">';
              $first = true;
              while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
              {

                echo '<div class="carousel-item ' . (($first) ? "active" : "") . '">
                  <img class="d-block w-100" src="' . $row["image"] . '" alt="sushi">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>' . $row["name"] . '</h5>
                    <p>' . $row["description"] . '</p>
                  </div>
                </div>';
                $first = false;
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();

            ?>
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
      
    <hr>

    <hr>
    <h2 class="text-center">Fresh Fish All Day Every Day</h2>
    <hr>
    
    <div class="container">

      <div class="row text-center">

      <?php
              $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE type='entree'");
            // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->error) 
            {
              trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
              return $ret;
            }
            if($stmt->execute())
            {
              $result = $stmt->get_result(); // Het the result from the executed statement.
              while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
              {


                echo '<div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                  <img class="card-img-top" src="' . $row["image"] . '" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">' . $row["name"] . '</h5>
                    <p class="card-text">' . $row["description"] . '</p>
                    <p class="card-text">$' . $row["price"] . '</p>
                    <a href="addcart.php?productID=' . $row["id"] . '" class="btn btn-primary">Add to Cart</a>
                  </div>
                  </div></div>';
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();

            ?>
      </div>
      </div>
      </div>

	  <div class="container mt-3" id="sushi">
      <div class="row">
        <div class="col-12">
          <div id="carousel-Index" class="carousel slide" data-ride="carousel">

            <?php
            $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE type='sushi'");
            // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->error) 
            {
              trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
              return $ret;
            }
            if($stmt->execute())
            {
              $first = true;
              $result = $stmt->get_result(); // Het the result from the executed statement.
              $rows = $result->num_rows;

              echo '<ol class="carousel-indicators">';
              for($i = 0;$i<$rows;$i++)
              {
                 echo '<li data-target="#carousel-Index" data-slide-to="' . $i . '" class="' . (($first) ? "active" : "") . '"></li>';
                $first = false;
              }
              echo '</ol><div class="carousel-inner">';
              $first = true;
              while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
              {

                echo '<div class="carousel-item ' . (($first) ? "active" : "") . '">
                  <img class="d-block w-100" src="' . $row["image"] . '" alt="sushi">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>' . $row["name"] . '</h5>
                    <p>' . $row["description"] . '</p>
                  </div>
                </div>';
                $first = false;
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();

            ?>
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
      
    <hr>

    <hr>
    <h2 class="text-center">Fresh Fish All Day Every Day</h2>
    <hr>
    
    <div class="container">

      <div class="row text-center">

      <?php
              $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE type='sushi'");
            // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->error) 
            {
              trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
              return $ret;
            }
            if($stmt->execute())
            {
              $result = $stmt->get_result(); // Het the result from the executed statement.
              while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
              {


                echo '<div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                  <img class="card-img-top" src="' . $row["image"] . '" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">' . $row["name"] . '</h5>
                    <p class="card-text">' . $row["description"] . '</p>
                    <p class="card-text">$' . $row["price"] . '</p>
                    <a href="addcart.php?productID=' . $row["id"] . '" class="btn btn-primary">Add to Cart</a>
                  </div>
                  </div></div>';
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();

            ?>
      </div>
      </div>
      </div>

      <div class="container mt-3" id="rolls">
      <div class="row">
        <div class="col-12">
          <div id="carousel-Index" class="carousel slide" data-ride="carousel">

            <?php
            $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE type='roll'");
            // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->error) 
            {
              trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
              return $ret;
            }
            if($stmt->execute())
            {
              $first = true;
              $result = $stmt->get_result(); // Het the result from the executed statement.
              $rows = $result->num_rows;

              echo '<ol class="carousel-indicators">';
              for($i = 0;$i<$rows;$i++)
              {
                 echo '<li data-target="#carousel-Index" data-slide-to="' . $i . '" class="' . (($first) ? "active" : "") . '"></li>';
                $first = false;
              }
              echo '</ol><div class="carousel-inner">';
              $first = true;
              while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
              {

                echo '<div class="carousel-item ' . (($first) ? "active" : "") . '">
                  <img class="d-block w-100" src="' . $row["image"] . '" alt="sushi">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>' . $row["name"] . '</h5>
                    <p>' . $row["description"] . '</p>
                  </div>
                </div>';
                $first = false;
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();

            ?>
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
      
    <hr>

    <hr>
    <h2 class="text-center">Fresh Fish All Day Every Day</h2>
    <hr>
    
    <div class="container">

      <div class="row text-center">

      <?php
              $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE type='roll'");
            // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->error) 
            {
              trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
              return $ret;
            }
            if($stmt->execute())
            {
              $result = $stmt->get_result(); // Het the result from the executed statement.
              while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
              {


                echo '<div class="col-md-4 pb-1 pb-md-0">
                <div class="card">
                  <img class="card-img-top" src="' . $row["image"] . '" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">' . $row["name"] . '</h5>
                    <p class="card-text">' . $row["description"] . '</p>
                    <p class="card-text">$' . $row["price"] . '</p>
                    <a href="addcart.php?productID=' . $row["id"] . '" class="btn btn-primary">Add to Cart</a>
                  </div>
                  </div></div>';
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();

            ?>
      </div>
      </div>
      </div>
      
 
 <?php   
echo'<br><br>';
include('includes/footer.html');
?>
