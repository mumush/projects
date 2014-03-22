<?php


	//MAKE DB CONNECTION
	// $db_host = "localhost";
	// $db_user = "rch4495";
	// $db_pass = "Mumush1037";
	// $db_name = "rch4495";


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

?>