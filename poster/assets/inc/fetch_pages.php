<?php

	// MAKE DB CONNECTION
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "root";
	$db_name = "poster";

	//connect to db
	$mysqli = new mysqli( $db_host, $db_user, $db_pass, $db_name);

	if ( $mysqli -> connect_error){

		echo "connection error: " . $mysqli->connect_error;

		die();
	}

	//sanitize post value
	$pageNumber = intval($_POST["page"]);

	$itemPerPage = 5;

	//get current starting point of records
	$position = ($pageNumber * $itemPerPage);

	//Limit to 5 results per load more click and start from the last item loaded

	if ( $stmt = $mysqli->prepare("SELECT * FROM products WHERE is_on_sale = FALSE ORDER BY id DESC LIMIT $position, $itemPerPage") ) { //prepare statement

		$stmt->execute();

		//bind the variables to the statement
		$stmt->bind_result($id, $name, $desc, $price, $quant, $img_name, $sale_price, $on_sale, $in_cart, $quant_in_cart);

		//fetch the values
		while ( $stmt->fetch() ) {

			$itemDataString = 'data-id="' . $id . '"';

			echo "<div class='itemBlock'>";

				echo "<div class='thumbnail'></div>";

				echo "<div class='itemInfo'>";

					echo "<a href='#'' class='addToCart' " . $itemDataString . " ><i class='fa fa-shopping-cart'></i> Add to Cart</a>";

					echo "<ul>";
							echo '<li>' . $name . '<li>';
							echo '<li>Price: $' . $price . '<li>';
							echo '<li>In Stock: ' . $quant . '<li>';
							echo '<li>' . $desc . '<li>';
					echo "</ul>";

				echo "</div>";

			echo "</div>";

		}

		//close statement
		$stmt->close();

	}

	//close db connection
	$mysqli->close();

?>