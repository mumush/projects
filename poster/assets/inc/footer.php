	
	</div> <!--END MAIN CONTENT-->

	<footer>

		&copy; Ryan Hoffmann

	</footer>

	<script src="assets/js/main.js"></script>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<script>

	function showFadeAlert(message, method) { //show alert message and then fade it out
	//later add a param which is the success level to apply correct styling

		console.log('method: ' + method + ' message: ' + message);

		switch( method ) {

			case "addtocart":

				if( message == "success" ) {
					$('#alert').text("Item Added to Cart!");
				}

				if( message == "error" ) {
					$('#alert').text("Uh-oh! Error Adding Item to Cart.");
				}

				break;

			case "removefromcart":

				if( message == "success" ) {
					$('#alert').text("Item Removed from Cart!");
				}
				
				if( message == "error" ) {
					$('#alert').text("Uh-oh! Error Removing Item from Cart.");
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

			$(".addToCart[data-id='" + itemDataID + "']").prev().fadeIn();

			showFadeAlert(resultMessage['status'], 'addtocart'); //run method to show an alert message and then fade it out

			setTimeout(function(){ location.reload(true); },500); //reload page

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

			showFadeAlert(resultMessage['status'], 'removefromcart'); //run method to show an alert message and then fade it out

			setTimeout(function(){ location.reload(true); },500); //reload page

		});

	});

	</script>

	<script>

		$(document).ready(function() {

			//tracks number of user clicks on the load more button
			var track_click = 0;

			$("#loadMore").click(function() { //user clicks on button

			    //$(this).fadeOut(); //hide load more button on click

		        //post page number and load returned data into result element
		        $.post('assets/inc/fetch_pages.php',{'page': track_click}, function(data) {
		        
		            //$("#loadMore").show(); //bring back load more button
		            
		            $("#results").append(data); //append data received from server
		            
		            //scroll page smoothly to button id
		            $("html, body").animate({scrollTop: $("#loadMore").offset().top}, 500);

		            track_click++; //user click increment on load button
		        
		        }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
		            alert(thrownError); //alert with HTTP error
		            $(".load_more").show(); //bring back load more button
		        });
		        
		        
		        // if(track_click >= total_pages-1) //compare user click with page number
		        // {
		        //     //reached end of the page yet? disable load button
		        //     $(".load_more").attr("disabled", "disabled");
		        // }
			      
			});

		});

	</script>


</body>

</html>