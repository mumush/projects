<?php

	//MAKE DB CONNECTION
	// $db_host = "localhost";
	// $db_user = "rch4495";
	// $db_pass = "Mumush1037";
	// $db_name = "rch4495";

	if( isset($_POST['action']) && !empty($_POST['action']) ) {

		$action = $_POST['action'];

		switch( $action ) { //use the command pattern

			case 'updateitem':

				$formData = $_POST['data'];

				parse_str($formData, $formArray);

				if( $formArray['adminPass'] == "poster" ) {

					$finalResult = updateItem($_POST['id'], $formArray['itemName'], $formArray['itemDesc'], $formArray['itemPrice'], $formArray['itemQuant'], $formArray['itemSalePrice']);

					echo json_encode($finalResult);

				}

				break;

			case 'getitem':

				$finalResult = getItem($_POST['id']);

				echo json_encode($finalResult);

				break;

			case 'additem':

				$formData = $_POST['data'];

				parse_str($formData, $formArray);

				if( $formArray['adminPass'] == "poster" ) {

					addItem($formArray['itemName'], $formArray['itemDesc'], $formArray['itemPrice'], $formArray['itemQuant'], $formArray['itemSalePrice']);

				}

				break;

			case 'loadmore':

				loadMore($_POST['page']);

				break;

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

	function updateItem($_id, $_name, $_desc, $_price, $_quant, $_sale_price) {

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

		if ( $stmt = $mysqli->prepare("UPDATE products SET name=?, description=?, price=?, quantity=?, sale_price=? WHERE id = $_id") ) { //prepare statement

			$stmt->bind_param("sssis", $name, $desc, $price, $quant, $sale_price);

			$name = $_name;
			$desc = $_desc;
			$price = $_price;
			$quant = $_quant;
			$sale_price = $_sale_price;

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


	function getItem($id) {

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

		if ( $stmt = $mysqli->prepare("SELECT * FROM products WHERE id = $id") ) { //prepare statement

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


	function addItem($_name, $_desc, $_price, $_quant, $_sale_price) {

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

		if ( $stmt = $mysqli->prepare("INSERT INTO products (name, description, price, quantity, sale_price) VALUES (?, ?, ?, ?, ?)") ) { //prepare statement

			$stmt->bind_param("sssis", $name, $desc, $price, $quant, $sale_price);

			$name = $_name;
			$desc = $_desc;
			$price = $_price;
			$quant = $_quant;
			$sale_price = $_sale_price;

			$stmt->execute();

			echo "<tr>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $desc . "</td>";
				echo "<td><a href='#' class='editItemLink' " . "data-id='" . $mysqli->insert_id . "' ><i class='fa fa-pencil'></i> Edit</a></td>";
			echo "</tr>";

			//close statement
			$stmt->close();

		}

		//close db connection
		$mysqli->close();

	}


	function loadMore($pageNum) {

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
		$pageNumber = intval($pageNum);

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