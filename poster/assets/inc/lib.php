<?php

	//MAKE DB CONNECTION
	// $db_host = "localhost";
	// $db_user = "rch4495";
	// $db_pass = "Mumush1037";
	// $db_name = "rch4495";

	if( isset($_POST['action']) && !empty($_POST['action']) ) {

		$action = $_POST['action'];

		switch( $action ) { //use the command pattern

			case 'emptycart':

				$emptyResult = emptyCart( $_POST['items'] ); //empty the items currently in the cart

				if( $emptyResult == 'success') {

					$finalResult = array('status' => 'success');

				}

				else {

					$finalResult = array('status' => 'error');

				}

				echo json_encode($finalResult);


				break;

			case 'addtocart':
				
				$decQuantResult = decreaseQuantityOnHand( $_POST['id'] ); //decrement the quantity of the item available

				$incQuantInCartResult = increaseQuantityInCart( $_POST['id'] ); //increase the quantity of this item in the cart

				$addCartResult = addItemToCart( $_POST['id'] );

				if( $decQuantResult == 'success' && $incQuantInCartResult == 'success' && $addCartResult == 'success' ) {

					$finalResult = array('status' => 'success');

				}

				else {

					$finalResult = array('status' => 'error');

				}

				echo json_encode($finalResult);

				break;
				

			case 'removefromcart':

				$incQuantResult = increaseQuantityOnHand( $_POST['id'] ); //increment the quantity of the item available

				$decQuantInCartResult = decreaseQuantityInCart( $_POST['id'] ); //decrease the quantity of this item in the cart

				$removeItemResult = removeItemFromCart( $_POST['id'] );

				if( $incQuantResult == 'success' && $decQuantInCartResult == 'success' && $removeItemResult == 'success' ) {

					$finalResult = array('status' => 'success');

				}

				else {

					$finalResult = array('status' => 'error');

				}

				echo json_encode($finalResult);

				break;

		}

	}

	function increaseQuantityOnHand( $itemId ) {

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

		if ( $stmt = $mysqli->prepare("UPDATE products SET quantity=quantity+1 WHERE id = $itemId") ) { //prepare statement

			$stmt->execute();

			//close statement
			$stmt->close();

			//close db connection
			$mysqli->close();

			//send the view an array that can be manipulated accordingly
			return 'success';
		}

		else {
			return 'error';
		}

	}

	function increaseQuantityInCart( $itemId ) {

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

		if ( $stmt = $mysqli->prepare("UPDATE products SET quant_in_cart=quant_in_cart+1 WHERE id = $itemId") ) { //prepare statement

			$stmt->execute();

			//close statement
			$stmt->close();

			//close db connection
			$mysqli->close();

			//send the view an array that can be manipulated accordingly
			return 'success';
		}

		else {
			return 'error';
		}

	}

	function decreaseQuantityOnHand( $itemId ) {

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

		if ( $stmt = $mysqli->prepare("UPDATE products SET quantity=quantity-1 WHERE id = $itemId") ) { //prepare statement

			$stmt->execute();

			//close statement
			$stmt->close();

			//close db connection
			$mysqli->close();

			//send the view an array that can be manipulated accordingly
			return 'success';
		}

		else {
			return 'error';
		}

	}

	function decreaseQuantityInCart( $itemId ) {

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

		if ( $stmt = $mysqli->prepare("UPDATE products SET quant_in_cart=quant_in_cart-1 WHERE id = $itemId") ) { //prepare statement

			$stmt->execute();

			//close statement
			$stmt->close();

			//close db connection
			$mysqli->close();

			//send the view an array that can be manipulated accordingly
			return 'success';
		}

		else {
			return 'error';
		}

	}

	function addItemToCart( $itemId ) {

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

		if ( $stmt = $mysqli->prepare("UPDATE products SET in_cart=TRUE WHERE id = $itemId") ) { //prepare statement

			$stmt->execute();

			//close statement
			$stmt->close();

			//close db connection
			$mysqli->close();

			//send the view an array that can be manipulated accordingly
			return 'success';
		}

		else {
			return 'error';
		}

	}

	function removeItemFromCart( $itemId ) {

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

		if ( $stmt = $mysqli->prepare("UPDATE products SET in_cart=FALSE WHERE id = $itemId") ) { //prepare statement

			$stmt->execute();

			//close statement
			$stmt->close();

			//close db connection
			$mysqli->close();

			//send the view an array that can be manipulated accordingly
			return 'success';
		}

		else {
			return 'error';
		}

	}

	function emptyCart( $items ) {

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

		if ( $stmt = $mysqli->prepare("UPDATE products SET in_cart=FALSE, quantity=quantity+quant_in_cart, quant_in_cart=0 WHERE id IN ($items)") ) { //prepare statement

			$stmt->execute();

			//close statement
			$stmt->close();

			//close db connection
			$mysqli->close();

			//send the view an array that can be manipulated accordingly
			return 'success';
		}

		else {
			return 'error';
		}


	}

	function getCartItems() {

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

		if ( $stmt = $mysqli->prepare("SELECT * FROM products WHERE in_cart = TRUE") ) { //prepare statement

			$stmt->execute();

			//bind the variables to the statement
			$stmt->bind_result($id, $name, $desc, $price, $quant, $img_name, $sale_price, $on_sale, $in_cart, $quant_in_cart);

			//an array of associative arrays which will each be an item in the products table
			$resultArray = array();

			//fetch the values
			while ( $stmt->fetch() ) {

				//create an associative array for this row item
				$rowArray = array( "id" => $id, "name" => $name, "desc" => $desc, "price" => $price, 
					"quant" => $quant, "img_name" => $img_name, "sale_price" => $sale_price, "on_sale" => $on_sale, "in_cart" => $in_cart, "quant_in_cart" => $quant_in_cart);

				//add this array to the result array
				array_push($resultArray, $rowArray);

			}

			//close statement
			$stmt->close();

			//send the view an array that can be manipulated accordingly
			return $resultArray;

		}

		//close db connection
		$mysqli->close();

	}
 

	function getSaleItems() {

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

		if ( $stmt = $mysqli->prepare("SELECT * FROM products WHERE is_on_sale = TRUE") ) { //prepare statement

			$stmt->execute();

			//bind the variables to the statement
			$stmt->bind_result($id, $name, $desc, $price, $quant, $img_name, $sale_price, $on_sale, $in_cart, $quant_in_cart);

			//an array of associative arrays which will each be an item in the products table
			$resultArray = array();

			//fetch the values
			while ( $stmt->fetch() ) {

				//create an associative array for this row item
				$rowArray = array( "id" => $id, "name" => $name, "desc" => $desc, "price" => $price, 
					"quant" => $quant, "img_name" => $img_name, "sale_price" => $sale_price, "on_sale" => $on_sale, "in_cart" => $in_cart, "quant_in_cart" => $quant_in_cart);

				//add this array to the result array
				array_push($resultArray, $rowArray);

			}

			//close statement
			$stmt->close();

			//send the view an array that can be manipulated accordingly
			return $resultArray;

		}

		//close db connection
		$mysqli->close();

	}

	function getItems() {

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

		if ( $stmt = $mysqli->prepare("SELECT * FROM products WHERE is_on_sale = FALSE ORDER BY id DESC LIMIT 5") ) { //prepare statement

			$stmt->execute();

			//bind the variables to the statement
			$stmt->bind_result($id, $name, $desc, $price, $quant, $img_name, $sale_price, $on_sale, $in_cart, $quant_in_cart);

			//an array of associative arrays which will each be an item in the products table
			$resultArray = array();

			//fetch the values
			while ( $stmt->fetch() ) {

				//create an associative array for this row item
				$rowArray = array( "id" => $id, "name" => $name, "desc" => $desc, "price" => $price, 
					"quant" => $quant, "img_name" => $img_name, "sale_price" => $sale_price, "on_sale" => $on_sale, "in_cart" => $in_cart, $quant_in_cart => "quant_in_cart");

				//add this array to the result array
				array_push($resultArray, $rowArray);

			}

			//close statement
			$stmt->close();

			//send the view an array that can be manipulated accordingly
			return $resultArray;

		}

		//close db connection
		$mysqli->close();

	}


	function getAllItems() {

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

		if ( $stmt = $mysqli->prepare("SELECT * FROM products") ) { //prepare statement

			$stmt->execute();

			//bind the variables to the statement
			$stmt->bind_result($id, $name, $desc, $price, $quant, $img_name, $sale_price, $on_sale, $in_cart, $quant_in_cart);

			//an array of associative arrays which will each be an item in the products table
			$resultArray = array();

			//fetch the values
			while ( $stmt->fetch() ) {

				//create an associative array for this row item
				$rowArray = array( "id" => $id, "name" => $name, "desc" => $desc, "price" => $price, 
					"quant" => $quant, "img_name" => $img_name, "sale_price" => $sale_price, "on_sale" => $on_sale, "in_cart" => $in_cart, "quant_in_cart" => $quant_in_cart);

				//add this array to the result array
				array_push($resultArray, $rowArray);

			}

			//close statement
			$stmt->close();

			//send the view an array that can be manipulated accordingly
			return $resultArray;

		}

		//close db connection
		$mysqli->close();

	}



?>