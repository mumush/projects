<?php 

	$currentPage = "catalog"; //set the current page

	require("assets/inc/lib.php");

	include ("assets/inc/header.php");

?>

		<div class="catalogMark"><i class="fa fa-certificate"></i> On Sale</div>

		<?php

			$saleItems = getSaleItems();

			foreach( $saleItems as $item ) { ?>

				<?php $itemDataString = 'data-id="' . $item['id'] . '"'; ?>

				<div class="itemBlock">

					<?php $imagePath = "assets/img/" . $item['img_name'] . ".png"; ?>

					<img src="<?php echo $imagePath; ?>" alt="<?php echo $item['name']; ?>" />

					<div class="itemInfo">

						<?php

							if( $item['in_cart'] == FALSE ) { ?>

								<a href="#" class="addToCart" <?php echo $itemDataString; ?>><i class="fa fa-shopping-cart"></i> Add to Cart</a>

								<?php
							}

							else { ?>

								<i class="fa fa-shopping-cart"></i>

							<?php

							}

						?>

						<ul>
							<?php
								echo '<li>' . $item['name'] . '</li>';
								echo '<li>Sale Price: $' . $item['sale_price'] . '</li>';
								echo '<li>Original Price: $' . $item['price'] . '</li>';
								echo '<li class="inStock">In Stock: ' . $item['quant'] . '</li>';
								echo '<li>' . $item['desc'] . '</li>';
							?>
						</ul>
					</div>

				</div>

			<?php

			}
		?>


		<div class="catalogMark"><i class="fa fa-tag"></i> Catalog</div>

		<?php

			$items = getItems();

			foreach( $items as $item ) { ?>

				<?php $itemDataString = 'data-id="' . $item['id'] . '"'; ?>

				<div class="itemBlock">

					<?php $imagePath = "assets/img/" . $item['img_name'] . ".png"; ?>

					<img src="<?php echo $imagePath; ?>" alt="<?php echo $item['name']; ?>" />

					<div class="itemInfo">

						<?php

							if( $item['in_cart'] == FALSE ) { ?>

								<a href="#" class="addToCart" <?php echo $itemDataString; ?>><i class="fa fa-shopping-cart"></i> Add to Cart</a>

								<?php
							}

							else { ?>

								<i class="fa fa-shopping-cart"></i>

							<?php

							}

						?>

						<ul>
							<?php
								echo '<li>' . $item['name'] . '</li>';
								echo '<li>Price: $' . $item['price'] . '</li>';
								echo '<li class="inStock">In Stock: ' . $item['quant'] . '</li>';
								echo '<li>' . $item['desc'] . '</li>';
							?>
						</ul>
					</div>

				</div>

			<?php

			}
		?>

		<div id="loadMore">Click to load more <i class="fa fa-refresh"></i></div>


	<?php include("assets/inc/footer.php"); ?>
