<?php
$page_title ='Sushi';
include('includes/header.html');
require("includes/DBconnect.php");
if (session_status() == PHP_SESSION_NONE)
    session_start();

if(!isset($_SESSION['userID']))
{
	header("Location: login.php");
}
?>

<!-- Banner -->

<!-- Info Section -->

<div class="d-flex px-5 flex-column  my-3 flex-wrap">
    <?php
        $user = GetUser($_SESSION['userID']);
        if($user != false)
        {
            $orders = json_decode($user["orders"], true);
            if(count($orders) > 0)
            {
                foreach($orders as $key => $order)
                {
                    echo '<div class="container border mb-4">
                    <h5>Order Number: ' . $order["id"] . '</h5>
                    <p>Shipped to:</p>
                    <div class="container">
                        <p>Name: ' . $order["BillingInfo"]["name"] .'</p>
                        <p>Address: ' . $order["BillingInfo"]["address"] . ', ' . $order["BillingInfo"]["city"] . ', ' . $order["BillingInfo"]["state"] . ' ' . $order["BillingInfo"]["zip"] . '</p>
                    </div>
                    <p>Order Placed On: ' . $order["orderDate"] . '</p>
                    <p>Expected Delivery Date: ' . $order["deliveryDate"] . '</p>
                    <p>Paid with card: ' . GetLast4($order["BillingInfo"]["card"]) . '</p>
                    <p>Items: </p>
                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price Per Unit</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>';

                    foreach($order["items"] as $key => $item)
                    {
                        $product = GetProduct($item["id"]);
                        echo '<tr>
                        <th scope="row">' . (intval($key)+1) . '</th>
                        <td>' . $product["name"] . '</td>
                        <td>' . $item["quantity"] . '</td>
                        <td>' . $product["description"] . '</td>
                        <td>$' . $product["price"] . '</td>
                        <td>$' . $product["price"] * $item["quantity"] . '</td>
                        </tr>';
                    }

                    echo '</tbody>
                    </table>
                    <p>Total Price: $' . $order["Total"] . '</p>
                </div>';

                }
            }
            else
            {
                echo '<h1>There are no orders in your order history</h1>';
            }
        }
        else
        {
            echo '<h1>Fatal Error</h1>';
        }

        function GetLast4($cardNumber)
        {
            $outStr = "";
            for($i = 0;$i<strlen($cardNumber)-4;$i++)
            {
                $outStr .= "*";
            }
            $outStr .= substr($cardNumber, -4);
            return $outStr;
        }
    ?>
</div>


<?php
echo'<br><br>';
include('includes/footer.html');
?>