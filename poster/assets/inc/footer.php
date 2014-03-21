	
	</div> <!--END MAIN CONTENT-->

	<footer>

		&copy; Ryan Hoffmann

	</footer>

	<script src="assets/js/main.js"></script>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<script>


	$( document ).ready(function() {

		$(window).scroll(function() {

			if( $(window).scrollTop() > 500 ) {
				$("#scrollTop").fadeIn("slow");
			}

			else {
				$("#scrollTop").fadeOut("slow");
			}

		});

	});


	function scrollToTop() {

		$("html, body").animate({ scrollTop: 0 }, "slow");
	}

	function showFadeAlert(message, method) { //show alert message and then fade it out
	//later add a param which is the success level to apply correct styling

		console.log('method: ' + method + ' message: ' + message);

		$('#alert').removeClass(); //clear the alert of all of its existing classes

		switch( method ) {

			case "updateitem":

				if( message == "success" ) {

					$('#alert').addClass('alert-success');

					$('#alert').html("<i class='fa fa-thumbs-up'></i> Item Successfully Updated!");
				}

				if( message == "error" ) {

					$('#alert').addClass('alert-error');

					$('#alert').html("<i class='fa fa-thumbs-down'></i> Uh-oh! Error Updating Item.");
				}				

				break;

			case "additem":

				if( message == "success" ) {

					$('#alert').addClass('alert-success');

					$('#alert').html("<i class='fa fa-thumbs-up'></i> Item Added to Catalog!");
				}

				if( message == "error" ) {

					$('#alert').addClass('alert-error');

					$('#alert').html("<i class='fa fa-thumbs-down'></i> Uh-oh! Error Adding Item to Catalog.");

				}

				break;

			case "addtocart":

				if( message == "success" ) {

					$('#alert').addClass('alert-success');

					$('#alert').html("<i class='fa fa-thumbs-up'></i> Item Added to Cart!");
				}

				if( message == "error" ) {

					$('#alert').addClass('alert-error');

					$('#alert').html("<i class='fa fa-thumbs-down'></i> Uh-oh! Error Adding Item to Cart.");
				}

				break;

			case "removefromcart":

				if( message == "success" ) {

					$('#alert').addClass('alert-success');

					$('#alert').html("<i class='fa fa-thumbs-up'></i> Item Removed from Cart!");

				}
				
				if( message == "error" ) {

					$('#alert').addClass('alert-error');

					$('#alert').html("<i class='fa fa-thumbs-down'></i> Uh-oh! Error Removing Item from Cart.");
				}

				break;

			default:
				//do nothing
		}

		$('#alert').fadeIn("slow");

		setTimeout(function(){ $('#alert').fadeOut("slow"); },3000); //fade it out

	}



	$( '#emptyCart' ).click(function() { //on click run the ajax call

		var itemIDArray = new Array();

		$( '.removeFromCart' ).each(function() {

			var itemDataID = $(this).data('id');

			itemIDArray.push( itemDataID );

		});

		var itemIDString = itemIDArray.join(",");

		console.log( itemIDString );

		$.ajax({
			type: "POST",
			url: "assets/inc/lib.php",
			data: { action: 'emptycart', items: itemIDString }
		})
		.done(function( result ) {

			var resultMessage = JSON.parse(result); //parse the JSON into an object

			console.log(resultMessage);

			$( '.removeFromCart' ).each(function() {

				$(this).closest(".itemBlock").fadeOut();

			});

			setTimeout(function(){ location.reload(true); },500); //reload page

		});

	});


	$( '.addToCart' ).click(function() { //on click run the ajax call

		console.log( $(this).data('id') );

		var itemDataID = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "assets/inc/lib.php",
			data: { action: 'addtocart', id: itemDataID }
		})
		.done(function( result ) {

			var resultMessage = JSON.parse(result); //parse the JSON into an object

			console.log(resultMessage);

			showFadeAlert(resultMessage['status'], 'addtocart'); //run method to show an alert message and then fade it out

			var list = $(".addToCart[data-id='" + itemDataID + "']").next();

			var inStockString = list.find(".inStock").text();

			var inStockArray = inStockString.split(" ");

			var newStock = parseInt(inStockArray[2]) - 1;

			console.log(inStockArray[2]);

			list.find(".inStock").text("In Stock: " + newStock);

		});

	});

	$( '.removeFromCart' ).click(function() { //on click run the ajax call

		console.log( $(this).data('id') );

		var itemDataID = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "assets/inc/lib.php",
			data: { action: 'removefromcart', id: itemDataID }
		})
		.done(function( result ) {

			var resultMessage = JSON.parse(result); //parse the JSON into an object

			console.log(resultMessage);

			$(".removeFromCart[data-id='" + itemDataID + "']").closest(".itemBlock").fadeOut();

			var list = $(".removeFromCart[data-id='" + itemDataID + "']").next();

			var itemPriceString = list.find(".itemPrice").text();

			var itemPriceArray = itemPriceString.split(" ");

			var itemPriceNum = itemPriceArray[1].replace("$", "");

			//use this price to subtrace from the total below
			itemPriceNum = parseFloat(itemPriceNum);



			showFadeAlert(resultMessage['status'], 'removefromcart'); //run method to show an alert message and then fade it out

			//setTimeout(function(){ location.reload(true); },500); //reload page

			var cartTotalString =  $("#cartTotal").text();

			var cartTotalArray = cartTotalString.split(" ");

			var cartNumTotal = cartTotalArray[2].replace("$", "");

			//total amount in the cart
			cartNumTotal = parseFloat(cartNumTotal);

			cartNumTotal = cartNumTotal - itemPriceNum;

			$("#cartTotal").text(" Total: $" + cartNumTotal);

			console.log(cartNumTotal);

		});

	});

	</script>

	<script>

		//tracks number of user clicks on the load more button
		var numClicks = 1;

		$("#loadMore").click(function() { //user clicks on button

		    //$(this).fadeOut(); //hide load more button on click

	        //post page number and load returned data into result element
	        $.post('assets/inc/lib.php',{ action: 'loadmore', 'page': numClicks }, function(data) {

	        	if( data === "" ) { //got nothing back, fade out button

	        		$("#loadMore").html("No More Items <i class='fa fa-frown-o'></i>");

	        		setTimeout(function(){ $("#loadMore").fadeOut(); },300); //wait half a second then fade button out

	        	}

	        	else { //we got something back

		            $("#loadMore").before(data);
		            
		            //scroll page smoothly to button id
		            $("html, body").animate({scrollTop: $(".itemBlock:nth-last-child(6)").offset().top}, 500);

		            numClicks++; //increase number of clicks every time they click the button

	        	}
	            
	        
	        }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
	            alert(thrownError); //alert with HTTP error
	        });
	        
		      
		});

		$("#addItemButton").click(function (event) { //user clicks on button

			//VALIDATE WITH JAVASCRIPT

			event.preventDefault();

	        // post page number and load returned data into result element
	        $.post('assets/inc/lib.php',{ action: 'additem', data: $('#addItemForm').serialize() }, function(data) {

	        	if( data === "" ) { //got nothing back, fade out button

	        		console.log("Empty response");

	        		showFadeAlert("error", 'additem'); //run method to show an alert message and then fade it out

	        	}

	        	else { //we got something back

		        	console.log(data);

		        	$("#editItemTable").append(data);

		        	$("#addItemForm").find("input, textarea").val("");

		        	showFadeAlert("success", 'additem'); //run method to show an alert message and then fade it out

	        	}


	            
	        
	        }).fail(function(xhr, ajaxOptions, thrownError) { //any errors
	            showFadeAlert("error", 'additem'); //run method to show an alert message and then fade it out
	        });
	        
		      
		});

		$("#discardChanges").click(function() { //user clicks on button

			$("#editDiv").slideUp("slow");

		});


		$(".editItemLink").click(function (event) { //user clicks on button

			event.preventDefault();

			var itemDataID = $(this).data('id');


	        $.post('assets/inc/lib.php',{ action: 'getitem', id: itemDataID }, function(data) {

	        	if( data === "" ) { //got nothing back, fade out button

	        		console.log("Empty response");

	        		//showFadeAlert("error", 'getitem'); //run method to show an alert message and then fade it out

	        	}

	        	else { //we got something back

	        		var parsedData = JSON.parse(data); //parse the JSON into an object

		        	console.log(parsedData);

		        	$("#editDiv input[name=editItemId]").val(parsedData[0].id);
		        	$("#editDiv input[name=itemName]").val(parsedData[0].name);
		        	$("#editDiv textarea[name=itemDesc]").val(parsedData[0].desc);
		        	$("#editDiv input[name=itemPrice]").val(parsedData[0].price);
		        	$("#editDiv input[name=itemQuant]").val(parsedData[0].quant);
		        	$("#editDiv input[name=itemSalePrice]").val(parsedData[0].sale_price);

					$("#editDiv").fadeIn();

					$("html, body").animate({ scrollTop: 0 }, "slow");

		        	//showFadeAlert("success", 'getitem'); //run method to show an alert message and then fade it out

	        	}
	        
	        }).fail(function(xhr, ajaxOptions, thrownError) { //any errors
	            //showFadeAlert("error", 'getitem'); //run method to show an alert message and then fade it out
	        });
	        
		      
		});


		$("#updateItemButton").click(function (event) { //user clicks on button

			event.preventDefault();

			var itemID = $("#editItemId").val();

			console.log(itemID);

	        $.post('assets/inc/lib.php',{ action: 'updateitem', id: itemID, data: $('#editItemForm').serialize() }, function(data) {

	        	if( data === "" ) { //got nothing back, fade out button

	        		console.log("Empty response");

	        		showFadeAlert("error", 'updateitem'); //run method to show an alert message and then fade it out

	        	}

	        	else { //we got something back

	        		console.log(data);

	        		var nameInput = $("#editItemForm input[name=itemName]").val();
	        		var descInput = $("#editItemForm textarea[name=itemDesc]").val();

	        		$("#editItemTable .editItemLink[data-id='" + itemID + "']").closest("tr").find("td:first-child").text(nameInput);
	        		$("#editItemTable .editItemLink[data-id='" + itemID + "']").closest("tr").find("td:nth-child(2)").text(descInput);

	        		showFadeAlert("success", 'updateitem'); //run method to show an alert message and then fade it out

	        		$("#editDiv").slideUp("slow");

	        	}
	        
	        }).fail(function(xhr, ajaxOptions, thrownError) { //any errors
	            showFadeAlert("error", 'updateitem'); //run method to show an alert message and then fade it out
	        });
	        
		      
		});


	</script>



</body>

</html>