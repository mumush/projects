
var gameTimer; //in game counter
var validateInterval; //style validation interval

//counts down from the supplied value in seconds to 0
function countdown(counter) {

    count = counter;
    gameTimer = setInterval(function() {

        count--;

        $('#timer').text(count);

        if( count === 0 ) {

            clearInterval(validateInterval); //break out of validation interval bc time is up

            clearInterval(gameTimer); //clear this interval

            $('#timer').text('Out of time!');

            setTimeout(function() {

                $('#timer').text('Play Again');

                $( "#timer" ).on( "click", startGame );
                $("#timer").css('cursor', 'pointer');

            }, 1500);

        }
    }, 1000);

}



//runs on an interval every 2 secs which checks if the right styles have been applied based on the
//task in the header...
function validateStyles(element, property, value, points) {

    //log useful values for comparison and testing
    console.log('Element to be styled: ' + element);
    console.log('Property to be styled: ' + property);
    console.log('Value of correct ' + property + ': ' + value);
    console.log( 'Current value of ' + property + ': ' + $(element).css(property) );

    validateInterval = setInterval(function(){  //every 2 seconds check their styling

        // console.log('validating styling...');

        console.log($(element).css(property));

        if( $(element).css(property) == value ) { //in this case, value is the rgb value of the color red rgb(255, 0, 0) not 'red'

            $('#timer').text('Correct!'); //tell the user they got something right!

            $('style').text(''); //clear the internal stylesheet for next question


            var addPoints = parseInt(points); //parse the parameters value to an integer for below addition
            var pointsInteger = parseInt( $('#totalPoints').text() ); //do the same for the existing value in the span #totalPoints


            var newPointCount = pointsInteger + addPoints; //add em up!

            $('#totalPoints').text(newPointCount); //set the inner text of the totalPoints span to the newly added count


            clearInterval(validateInterval); //break out of the interval if the right style is applied

            getNewTask(); //run get new task, rinse and repeat

        }

    },2000);

}


//returns a random task from the db
//called at the start of the game, or after the user has applied the correct style
function getNewTask() {

    //clear the main game time interval
    clearInterval(gameTimer);

    //restart the countdown
    countdown(30);

    $.get( "tasks.php", { action: "getTask" } )
        .done(function( data ) {

            //parse the returned JSON data to JS array
            var result = JSON.parse(data);

            //append the data array to mainContent
            $("#mainContent").html(result.html);

            $("#task").text(result.task);

            validateStyles(result.element, result.property, result.value, result.points);

    });

}

function startGame() {

    $('#timer').text('Ready, set, go!');

    $("#timer").off(); //remove on click event handler
    $("#timer").css('cursor', 'default');

    getNewTask();

}

$( "#timer" ).on( "click", startGame );




$( "#helpBut" ).on("click", function() {

    if( $( ".modal" ).css('display') == 'none' ) {

        $( "#helpBut" ).css('color', '#fff');

        $(".modal").slideDown();

    }

    else {

        $( "#helpBut" ).css('color', '#555');

        $(".modal").slideUp();

    }

});

