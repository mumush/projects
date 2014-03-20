<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans|Allerta+Stencil' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="assets/css/mobile.css">

	<title>Post.er | Catalog</title>

</head>

<body onload="animate();">

	<header id="sidebar">
		
		<h1><i class="fa fa-picture-o"></i>.er</h1>

		<nav>
			<ul id="nav">
				<a href="index.php"
					<?php if($currentPage == "catalog" ) { echo "class='tooltip active'";} else { echo "class='tooltip'";} ?>
				title="Catalog"><li><i class="fa fa-tag fa-2x"></i><span class="navText">Catalog</span></li></a>

				<a href="cart.php" 
					<?php if($currentPage == "cart" ) { echo "class='tooltip active'";} else { echo "class='tooltip'";} ?>
				title="Cart"><li><i class="fa fa-shopping-cart fa-2x"></i><span class="navText">Cart</span></li></a>

				<a href="admin.php"
					<?php if($currentPage == "admin" ) { echo "class='tooltip active'";} else { echo "class='tooltip'";} ?>
				title="Admin"><li><i class="fa fa-user fa-2x"></i><span class="navText">Admin</span></li></a>

				<a href="#" class="tooltip" id="hideNav" title="Hide" onclick="hideNav();"><li><i class="fa fa-outdent fa-2x"></i></li></a>
			</ul>
		</nav>

	</header>

	<a href="#" id="showNav" onclick="showNav();"><i class="fa fa-align-right"></i></a>

	<div id="mainContent">

		<div id="alert"></div>