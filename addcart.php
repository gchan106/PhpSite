<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
require("includes/DBconnect.php");

if(!isset($_SESSION["userID"]))
{
    header("Location: login.php");
}

if (isset($_GET['productID']) )
{
    $user = GetUser($_SESSION["userID"]);
    $cart = json_decode($user['cart'], true);

    $product = GetProduct($_GET['productID']);

    if($product == false)
    {
        echo '<br/><br/><h1>Product is invalid</h1>';
        header("refresh: 2;url=catalog.php");
        return;
    }

    $exists = false;

    foreach($cart as $key =>$item)
    {
        if($item['id'] == $product['id'])
        {
            $cart[$key]['quantity'] = $cart[$key]['quantity'] + 1;
            $exists = true;
            break;
        }
    }
    if(!$exists)
    {
        array_push($cart, array(
            "id" => $product['id'],
            "name" => $product['name'],
            "quantity" => 1
        ));
    }

    $newCart = json_encode($cart);
    if($newCart == null)
    $newCart = "[]";
    SaveUser($_SESSION["userID"],$user["name"], $user["email"], $user["passwordhash"], $newCart, $user["orders"], $user["usertype"]);

    echo "<h3>Item has been added to cart</h3>";
    header("refresh: 2;url=cart.php");
}
?>