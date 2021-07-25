<?php
$page_title ='Search Results';
include('includes/header.html');
require("includes/DBconnect.php");

if (session_status() == PHP_SESSION_NONE)
    session_start();

?>

<div class="d-flex px-5 flex-row  my-3 flex-wrap">

<?php

if(isset($_POST["search"]))
{
    $sql = Sql_Connect();
              // Check if the database connected successfully. If not, return throw error and return false.
            if ($sql->connect_error) 
            {
              trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
            }
    
            // Prepare and bind parameter.
            //$Email = null;
            $stmt = $sql->prepare("SELECT * FROM products WHERE name LIKE CONCAT('%',?,'%') OR type LIKE CONCAT('%',?,'%');");
            $stmt->bind_param("ss", $_POST["search"],$_POST["search"]);

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

                echo '<div class="cards d-flex flex-column p-4 mx-2 my-2 my-lg-1 text-center">
                <img src="' . $row["image"] . '" class="img-fluid mx-auto d-block" alt="img">
                <h3>' . $row["name"] . '</h3>
                <p>' . $row["description"] . '</p>
                <p>$' . $row["price"] . '</p>
                <a href="addcart.php?productID=' . $row["id"] . '" class="btn btn-primary btn-sm">Add to Cart</a>
                </div>';
              }
            }
    
            // Cleanup
            $stmt->close();
            $sql->close();
}
?>
</div>

	
  <?php
echo'<br><br>';
include('includes/footer.html');
?>
