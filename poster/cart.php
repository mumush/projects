<?php

	$currentPage = "cart"; //set the current page

	require("assets/inc/lib.php");

	include ("assets/inc/header.php");

?>

		<div class="catalogMark"><i class="fa fa-check-circle-o"></i> Current Cart Items</div>

		<?php

			$cartTotal = 0.00;

			$cartItems = getCartItems();

			foreach( $cartItems as $item ) { ?>

				<?php $itemDataString = 'data-id="' . $item['id'] . '"'; ?>

				<div class="itemBlock">

					<?php $imagePath = "assets/img/" . $item['img_name'] . ".png"; ?>

					<img src="<?php echo $imagePath; ?>" alt="<?php echo $item['name']; ?>" />
					

					<div class="itemInfo">

						<button class="removeFromCart" <?php echo $itemDataString; ?>><i class="fa fa-minus-circle"></i> Remove Item</button>

						<ul>
							<?php
								echo '<li>' . $item['name'] . '</li>';

								if( $item['on_sale'] == TRUE ) {

									echo '<li class="itemPrice">Sale: $' . $item['sale_price'] . '</li>';

									$cartTotal = $cartTotal + floatval($item['sale_price']);

								}
								else {

									echo '<li class="itemPrice">Price: $' . $item['price'] . '</li>';

									$cartTotal = $cartTotal + floatval($item['price']);

								}
								echo '<li>In Stock: ' . $item['quant'] . '</li>';
								echo '<li>In Cart: ' . $item['quant_in_cart'] . '</li>';
								echo '<li>' . $item['desc'] . '</li>';
							?>
						</ul>
					</div>

				</div>

			<?php

			}
		?>


		<div class="catalogMark" id="cartTotal"><i class="fa fa-tasks"></i> Total: <?php echo "$" . $cartTotal; ?></div>

		<div class="catalogMark" id="emptyCart"><button><i class="fa fa-trash-o"></i> Empty Cart</button></div>


	<?php include("assets/inc/footer.php"); ?>
