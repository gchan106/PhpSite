<?php
$page_title ='Cart';
include('includes/header.html');
require("includes/DBconnect.php");
if(!isset($_SESSION['userID']))
{
	header("Location: login.php");
}
?>



	
	<div class="container-fluid">
		
	<table id="cart" class="table table-hover table-condensed">
		

    				<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th class="text-center">Subtotal</th>
							
						</tr>
					</thead>

					<tbody>
					<?php

					$total =  0.00;
					if(isset($_SESSION['userID']))
					{
						$user = GetUser($_SESSION['userID']);

						if($user["cart"] != "[]")
						{
							$cart = json_decode($user["cart"], true);
							foreach($cart as $key => $item)
							{
								$product = GetProduct($item['id']);
								echo '
								<tr>
									<td data-th="Cart">
										<div class="row">
											<div class="col-sm-2 hidden-xs"><img src="'. $product["image"] .'" alt="cart" class="img-responsive"style="width:100px;height:100/></div>
											<div class="col-sm-10">
												<h4>'. $item['name'] .'</h4>

											</div>
										</div>
									</td>
									<td data-th="Price">$'. $product['price'] .'</td>
									<td data-th="Quantity"> '. $item['quantity'] .'</td>
									<td data-th="Subtotal" class="text-center">$'. $item['quantity'] * $product['price'].'</td>
									<td data-th="Subtotal" class="text-center"><a class="btn btn-primary" href="updatecart.php?remove=' . $item['id'] .'">Remove Item</a></td>
						
								</tr>';
								$total +=  $item['quantity'] * $product['price'];
							}
						}

					}
				?>
				</tbody>

					<tfoot class="cart-checkout">
						<tr >
							<td class="text-center"><strong>Thank's enjoy your Citi Sushi</strong></td>
						</tr>
						<tr>
							<td><a href="updatecart.php?remove=all" class="btn btn-success">Clear Shopping Cart</a></td>
							<td><a href="checkout.php" class="btn btn-success btn-block"> Checkout</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs"><strong><?php echo '$' . $total; ?></strong></td>


						</tr>
					</tfoot>
				</table>
</div>

<?php
echo'<br><br>';
include('includes/footer.html');
?>
