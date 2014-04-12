var timerId = null;

function countdown() {

    document.getElementById('timerID').innerHTML = 'Ready, set, go!';

    var count = 30;
    timerId = setInterval(function() {

        count--;

        // console.log(count);

        document.getElementById('timerID').innerHTML = count;

        if( count === 0 ) {

            clearInterval(timerId);

            document.getElementById('timerID').innerHTML = 'Out of time!';

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

    var interval = setInterval(function(){  //every 2 seconds check their styling

        if( $(element).css(property) == value ) { //in this case, value is the rgb value of the color red rgb(255, 0, 0) not 'red'

            console.log('Correct!');

            $('style').text(''); //clear the internal stylesheet for next question


            var addPoints = parseInt(points); //parse the parameters value to an integer for below addition
            var pointsInteger = parseInt( $('#totalPoints').text() ); //do the same for the existing value in the span #totalPoints

            var newPointCount = pointsInteger + addPoints; //add em up!

            $('#totalPoints').text(newPointCount); //set the inner text of the totalPoints span to the newly added count


            clearInterval(interval); //break out of the interval if the right style is applied

            getNewTask(); //run get new task, rinse and repeat

        }

    },2000);

}


//returns a random task from the db
//called at the start of the game, or after the user has applied the correct style
function getNewTask() {

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

getNewTask();
