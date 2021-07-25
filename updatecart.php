<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
require("includes/DBconnect.php");

if(!isset($_SESSION["userID"]))
{
    header("Location: login.php");
}

if (isset($_GET['remove']))
{
    $user = GetUser($_SESSION["userID"]);
    $cart = json_decode($user['cart'], true);

    $exists = false;

    if($_GET["remove"] == "all")
    {
        $newCart = "[]";
        SaveUser($_SESSION["userID"],$user["name"], $user["email"], $user["passwordhash"], $newCart, $user["orders"], $user["usertype"]);
        header("Location: cart.php");
    }
    else
    {
        $pid = intval($_GET["remove"]) or die("Error");
        foreach($cart as $key =>$item)
        {
            if($item['id'] == $pid)
            {
                array_splice($cart, $key, 1);
                break;
            }
        }
        $newCart = json_encode($cart);
        SaveUser($_SESSION["userID"],$user["name"], $user["email"], $user["passwordhash"], $newCart, $user["orders"], $user["usertype"]);
        header("Location: cart.php");
    }
}
?>