<?php

	//every time an ajax call is made, this script is posted to
	//use the command pattern and send an action POST variable which describes what needs to be
	//executed, then call the necessary functions and break out of the switch
	if( isset($_POST['action']) && !empty($_POST['action']) ) {

		$action = $_POST['action'];

		switch( $action ) { //utilize command pattern

			case 'updateitem': //UPDATE a specific item with supplied values

				//get the serialized form data from the POST variable named data
				$formData = $_POST['data'];

				//parse the serialized string into an array to be used below
				parse_str($formData, $formArray);

				if( isset($formArray['onSale']) ) { //if the on sale button has been checked

					$numOnSale = getNumOnSale(); //returns number of items where on_sale = TRUE

					if( $numOnSale <= 4 ) { //if the number of items on sale is not greater than 5

						//make sure password is valid before inserting item 
						if( $formArray['adminPass'] == "poster" ) {

							//update the item based on the associated id
							$finalResult = updateItem($_POST['id'], $formArray['itemName'], $formArray['itemDesc'], $formArray['itemPrice'], $formArray['itemQuant'], $formArray['itemSalePrice'], 1);

							//echo back a result message
							echo json_encode($finalResult);

						}

					}

					else {

						echo ""; //send back an empty string alerting js of an error

					}

				}

				else { //on sale has not been checked

					//make sure password is valid before inserting item 
					if( $formArray['adminPass'] == "poster" ) {

					//update the item based on the associated id
					$finalResult = updateItem($_POST['id'], $formArray['itemName'], $formArray['itemDesc'], $formArray['itemPrice'], $formArray['itemQuant'], $formArray['itemSalePrice'], 0);

					//echo back a result message
					echo json_encode($finalResult);

					}

				}

				break;

			case 'getitem': //SELECT a specific item

				$finalResult = getItem($_POST['id']);

				//echo back an array which is the affected row from the select, and JSON encode it
				echo json_encode($finalResult);

				break;

			case 'additem': //INSERT an item into the table

				//get the posted form data from the POST variable data
				$formData = $_POST['data'];

				//parse the serialized string and convert it to an array
				parse_str($formData, $formArray);

				if( isset($formArray['onSale']) ) { //if the on sale button has been checked

					$numOnSale = getNumOnSale(); //returns number of items where on_sale = TRUE

					if( $numOnSale <= 4 ) { //if the number of items on sale is not greater than 5

						//make sure password is valid before inserting item 
						if( $formArray['adminPass'] == "poster" ) {

							addItem($formArray['itemName'], $formArray['itemDesc'], $formArray['itemPrice'], $formArray['itemQuant'], $formArray['itemSalePrice'], 1);

						}

					}

					else {

						echo ""; //send back an empty string alerting js of an error

					}

				}

				else { //item hasn't been checked as on sale

					//make sure password is valid before inserting item 
					if( $formArray['adminPass'] == "poster" ) {

						addItem($formArray['itemName'], $formArray['itemDesc'], $formArray['itemPrice'], $formArray['itemQuant'], $formArray['itemSalePrice'], 0);

					}

				}

				break;

			case 'loadmore': //SELECT the next 5 items

				//based on the passed in page number, echo back the next 5 items
				loadMore($_POST['page']);

				break;

			case 'emptycart': //UPDATE items passed in and setting their in_cart values to false

				$emptyResult = emptyCart( $_POST['items'] ); //empty the items currently in the cart

				if( $emptyResult == 'success') { //pass success message

					$finalResult = array('status' => 'success');

				}

				else {

					$finalResult = array('status' => 'error');

				}

				echo json_encode($finalResult);

				break;

			case 'addtocart':
				
				$decQuantResult = decreaseQuantityOnHand( $_POST['id'] ); //decrement the quantity of the item available

				if( $decQuantResult == 'success' ) {

					$incQuantInCartResult = increaseQuantityInCart( $_POST['id'] ); //increase the quantity of this item in the cart

					$addCartResult = addItemToCart( $_POST['id'] );

					if( $incQuantInCartResult == 'success' && $addCartResult == 'success' ) {

						$finalResult = array('status' => 'success');

					}

					else {

						$finalResult = array('status' => 'error');

					}

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


	function getNumOnSale() {

		include ("connect.php");

		if ( $stmt = $mysqli->prepare("SELECT id FROM products WHERE is_on_sale = TRUE") ) { //prepare statement

			$stmt->execute();

			$stmt->store_result();


			$rowCount = $stmt->num_rows;

			//close statement
			$stmt->close();

			//close db connection
			$mysqli->close();

			//send back the number of items on sale
			return $rowCount;

		}

	}

	function updateItem($_id, $_name, $_desc, $_price, $_quant, $_sale_price, $_on_sale) {

		include ("connect.php");

		if ( $stmt = $mysqli->prepare("UPDATE products SET name=?, description=?, price=?, quantity=?, sale_price=?, is_on_sale=? WHERE id = $_id") ) { //prepare statement

			$stmt->bind_param("sssiss", $name, $desc, $price, $quant, $sale_price, $on_sale);

			$name = $_name;
			$desc = $_desc;
			$price = $_price;
			$quant = $_quant;
			$sale_price = $_sale_price;
			$on_sale = $_on_sale;

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

		include ("connect.php");

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


	function addItem($_name, $_desc, $_price, $_quant, $_sale_price, $_on_sale) {

		include ("connect.php");

		if ( $stmt = $mysqli->prepare("INSERT INTO products (name, description, price, quantity, sale_price, is_on_sale) VALUES (?, ?, ?, ?, ?, ?)") ) { //prepare statement

			$stmt->bind_param("sssiss", $name, $desc, $price, $quant, $sale_price, $on_sale);

			$name = $_name;
			$desc = $_desc;
			$price = $_price;
			$quant = $_quant;
			$sale_price = $_sale_price;
			$on_sale = $_on_sale;

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

		include ("connect.php");

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

					$imagePath = "assets/img/" . $img_name . ".png";

					echo "<img src='" . $imagePath . "' " . "alt='" . $name . "' />";

					echo "<div class='itemInfo'>";

						if( $in_cart == FALSE ) {

							echo "<button class='addToCart' " . $itemDataString . " ><i class='fa fa-shopping-cart'></i> Add to Cart</button>";

						}

						else {

							echo "<i class='fa fa-shopping-cart'></i>";

							echo "<button class='inCart'><i class='fa fa-check-circle-o'></i> Item In Cart</button>";

						}

						echo "<ul>";
								echo '<li>' . $name . '</li>';
								echo '<li>Price: $' . $price . '</li>';
								echo '<li class="inStock">In Stock: ' . $quant . '</li>';
								echo '<li>' . $desc . '</li>';
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

		include ("connect.php");

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

		include ("connect.php");

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

		include ("connect.php");

		//make sure the quantity is > 0

		if ( $stmt = $mysqli->prepare("SELECT quantity FROM products WHERE id = $itemId") ) { //prepare statement

			$stmt->execute();

			//bind the variables to the statement
			$stmt->bind_result($quantity);


			$quantInHand;

			//fetch the values
			while ( $stmt->fetch() ) {

				$quantInHand = $quantity;

			}

			if( $quantInHand == 0 ) { //if its equal to 0, return an error and stop the execution of further code

				return 'error';

			}

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

		include ("connect.php");

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

		include ("connect.php");

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

		include ("connect.php");

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

		include ("connect.php");

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

		include ("connect.php");

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

		include ("connect.php");

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

		include ("connect.php");

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

		include ("connect.php");

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