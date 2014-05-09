<?php

	if( isset($_GET['action']) && !empty($_GET['action']) ) {

		$action = $_GET['action'];

		switch( $action ) { //use the command pattern

			case 'getTask':

				//run the get task method below
				$result = getTask();

				echo json_encode($result);

				break;

			default:

				//do nothing
				break;

		}


	}


	function getTask() {

		// MAKE DB CONNECTION
		$db_host = "localhost";
		$db_user = "root";
		$db_pass = "root";
		$db_name = "stylable";

		//connect to db
		$mysqli = new mysqli( $db_host, $db_user, $db_pass, $db_name);

		if ( $mysqli -> connect_error){

			echo "connection error: " . $mysqli->connect_error;

			die();
		}

		if ( $stmt = $mysqli->prepare("SELECT * FROM tasks WHERE id=18") ) { //prepare statement -> ORDER BY rand() LIMIT 1

			$stmt->execute();

			//bind the variables to the statement
			$stmt->bind_result($id, $task, $element, $property, $value, $html, $points);

			//an array of associative arrays which will each be a task
			$rowArray = array();

			//fetch the values
			while ( $stmt->fetch() ) {

				//create an associative array for this row item
				$rowArray = array( "id" => $id, "task" => $task, "element" => $element, "property" => $property, 
					"value" => $value, "html" => $html, "points" => $points);

			}

			//close statement
			$stmt->close();

			//send the view an array that can be manipulated accordingly
			return $rowArray;

		}

		//close db connection
		$mysqli->close();

	}





?>