<?php
$page_title ='Checkout';
if (session_status() == PHP_SESSION_NONE)
	session_start();
include('includes/header.html');
if(!isset($_SESSION['userID']))
{
	header("Location: login.php");
}
require("includes/DBconnect.php"); // Connect to the db.
$user = GetUser($_SESSION["userID"]);
if($user)
{
  if($user["cart"] == "[]")
  {
    echo '<h1>Your cart is empty</h1>';
    header("refresh: 2; url=catalog.php");
    return;
  }
}
else
{
  echo '<h1>Fatal Error</h1>';
  header("refresh: 2; url=index.php");
  return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

  if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["address"]) && isset($_POST["city"]) && isset($_POST["state"]) && isset($_POST["zip"]) && isset($_POST["card"]) && isset($_POST["csv"]) && isset($_POST["exp"]))
  {

    $cart = json_decode($user["cart"],true);
    if($cart != "[]")
    {
      $total = 0.00;
      foreach($cart as $key => $item)
			{
				$product = GetProduct($item['id']);
				$total +=  $item['quantity'] * $product['price'];
			}
      $order = array(
        "id" => GenerateOrderId(),
        "userID" => $_SESSION["userID"],
        "BillingInfo" => array(
          "name" =>$_POST["name"],
          "email" =>$_POST["email"],
          "phone" =>$_POST["phone"],
          "address" =>$_POST["address"],
          "city" =>$_POST["city"],
          "state" =>$_POST["state"],
          "zip" =>$_POST["zip"],
          "card" =>$_POST["card"],
          "csv" =>$_POST["csv"],
          "exp" =>$_POST["exp"]
        ),
        "items" => $cart,
        "orderDate" => date('m-d-Y H:i:s', strtotime("now", time())),
        "deliveryDate" => date('m-d-Y H:i:s', strtotime("+3 day", time())),
        "Total" => $total
      );

      $user["cart"] = "[]";
      $Orders = json_decode($user["orders"], true);
      array_push($Orders, $order);
      $user["orders"] = json_encode($Orders);
      SaveUser($_SESSION["userID"],$user["name"], $user["email"], $user["passwordhash"], $user["cart"], $user["orders"], $user["usertype"]);
      echo '<h1>Order has been placed.</h1>';
      header("refresh: 2; url=orders.php");
      return;
    }
  }


  echo '<h1>Error placing order.</h1>';
  header("refresh: 2; url=cart.php");
  return;
}
?>

<div class= "d-flex justify-content-center">
<form action= "checkout.php" method = "post" >
	      <h1>Checkout</h1>
	
	<h4>Billing Information</h4>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" required>
    </div>
    <div class="form-group col-md-5">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
    </div>

    <div class="form-group col-md-5">
      <label for="phone">Phone Number</label>
      <input type="tel" class="form-control" id="phone" placeholder="Phone Number" name="phone" required>
    </div>

  </div>
  <div class="form-group">
    <label for="address">Street Address</label>
    <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required>
  </div>

  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="city" placeholder="Please enter your city" name="city" required>
    </div>
	  
    <div class="form-group col-md-2">
      <label for="state">State</label>
      <input type="text" class="form-control" id="state" name="state" required>
    </div>
    <div class="form-group col-md-2">
      <label for="zip">Zip</label>
      <input type="text" class="form-control" id="zip" name="zip" required>
    </div>
  </div>
  <div class="form-row">
	  <div class="form-group col-md-5">
    <label for="card">Card Number</label>
      <input type="text" class="form-control" id="card" name="card" required>
    </div>
    <div class="form-group col-md-2">
    <label for="csv">csv</label>
      <input type="text" class="form-control" id="csv" name="csv" required>
  </div>
</div>
<div class="form-row">
<div class="form-group col-md-5">
    <label for="exp">Expiration Date</label>
    <input type="text" class="form-control" id="exp" name="exp" required>
    </div>
    </div>
    <button class="btn btn-secondary mb-5" type="submit">Order Now</button>
</form>
<?php
function GenerateOrderId() {
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < 10; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }

  return strval($_SESSION["userID"]) . $randomString;
}
include('includes/footer.html');
?>



