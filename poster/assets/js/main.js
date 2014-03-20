function animate() {

	var allMarkers = document.getElementsByClassName('catalogMark');

	for( var i = 0; i < allMarkers.length; i++ ) {

		if( allMarkers[i].id == "emptyCart" ) {

			allMarkers[i].style.marginLeft = "70%";

		}

		else {

			allMarkers[i].style.marginLeft = "50%";

		}

	}

}

function hideNav() {

	document.getElementById('sidebar').style.marginLeft = '1%'; //move the sidebar to the right a bit

	setTimeout(function(){

		document.getElementById('sidebar').style.marginLeft = '-200%'; //slide it all the way to the left

	}, 150);

	setTimeout(function(){

		document.getElementById('sidebar').style.display = 'none'; //hide the sidebar so it has no effect on layout

		document.body.style.paddingLeft = '50px';

	}, 350);
	
	setTimeout(function() { //show the nav toggle

		document.getElementById('showNav').style.display = 'block';

	}, 350);

}

function showNav() {

	document.body.style.paddingLeft = '190px';

	document.getElementById('sidebar').style.marginLeft = '-15%'; //move it off screen so that it appears to slide in

	document.getElementById('sidebar').style.display = 'block'; //make sure it's visible


	setTimeout(function() { //hide the nav toggle

		document.getElementById('sidebar').style.marginLeft = '0%'; //reset the sidebar margin

		document.getElementById('showNav').style.display = 'none';

	}, 120);


}