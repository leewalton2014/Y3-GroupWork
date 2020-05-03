<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();

//variables
$userID = 1;//PLACEHOLDER UNTILL SESSIONS IMPLEMENTED
$overall = sanitise_input('overall');
$location = sanitise_input('location-radio');
$room = sanitise_input('room-radio');
$clean = sanitise_input('clean-radio');
$service = sanitise_input('service-radio');
$hotelID = sanitise_input('hotelID');
$date = date("Y-m-d");
$reviewTitle = sanitise_input('reviewTitle');
$reviewText = sanitise_input('reviewText');
//ranges
$min = 1;
$max = 5;
//db con
$dbConn = getConnection();


//checking for errors
$errors = array();//create array of error messages
if (empty($overall)||empty($location)||empty($room)||empty($clean)||empty($service)||empty($hotelID)||empty($date)||empty($reviewTitle)||empty($reviewText)){
  array_push($errors,"ERROR: Please ensure all fields are populated.");
}

if (!filter_var($overall, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max)))){
  array_push($errors,"ERROR: Please ensure you select ratings.");

}elseif(!filter_var($location, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max)))){
  array_push($errors,"ERROR: Please ensure you select ratings.");

}elseif(!filter_var($room, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max)))){
  array_push($errors,"ERROR: Please ensure you select ratings.");

}elseif(!filter_var($clean, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max)))){
  array_push($errors,"ERROR: Please ensure you select ratings.");

}elseif(!filter_var($service, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max)))){
  array_push($errors,"ERROR: Please ensure you select ratings.");
}

if (strlen($reviewTitle) > 200){
  //error
  array_push($errors,"ERROR: Please make sure review title is less than 200 characters.");
}
if (strlen($reviewText) > 500){
  //error
  array_push($errors,"ERROR: Please ensure review text is less than 500 characters.");
}


//Check user has stayed at hotelLocation
$checkHotelsQuery = "SELECT hotelID
FROM tc_bookings INNER JOIN tc_rooms ON tc_bookings.roomID = tc_rooms.roomID
WHERE userID = '$userID' AND hotelID = '$hotelID'";
$checkHotels = $dbConn->query($checkHotelsQuery);

if ($checkHotels->rowCount() == 0){
  //if user has not stayed at hotel do not allow review
  echo "<p>You can only review hotels you have stayed at! To stay at this hotel view the hotel page <a href='hotel.php?hotelID=$hotelID'>here.</a></p>";
}elseif (!empty($errors)) {
  //if erros exist then display errors
  echo "<div>";
  foreach ($errors as $error){
    echo "<p>$error</p><br>";
  }
  echo "</div><br>";
  //autofill review content
  echo "<div>";
  echo "<div class='widthWrap splitCol'>";
  echo "<form class='reviewForm' action='processReview.php' method='POST' enctype='multipart/form-data'>
    <h1>Review Form</h1>
    <div class='splitCol'>
      <p><b>Overall: </b></p>
      </br>
      <div id='checkboxes'>
        <div class='checkboxgroup'>
          <label for='1overall'>1</label>
          <input type='radio' name='overall' id='1overall' value='1'/>
        </div>
        <div class='checkboxgroup'>
          <label for='2overall'>2</label>
          <input type='radio' name='overall' id='2overall' value='2'/>
        </div>
        <div class='checkboxgroup'>
          <label for='3overall'>3</label>
          <input type='radio' name='overall' id='3overall' value='3'/>
        </div>
        <div class='checkboxgroup'>
          <label for='4overall'>4</label>
          <input type='radio' name='overall' id='4overall' value='4'/>
        </div>
        <div class='checkboxgroup'>
          <label for='5overall'>5</label>
          <input type='radio' name='overall' id='5overall' value='5'/>
        </div>
      </div>
    </div>
    <div class='splitCol'>
      <p><b>Location: </b></p>
      </br>
      <div id='checkboxes'>
        <div class='checkboxgroup'>
          <label for='1location'>1</label>
          <input type='radio' name='location-radio' id='1location' value='1'/>
        </div>
        <div class='checkboxgroup'>
          <label for='2location'>2</label>
          <input type='radio' name='location-radio' id='2location' value='2'/>
        </div>
        <div class='checkboxgroup'>
          <label for='3location'>3</label>
          <input type='radio' name='location-radio' id='3location' value='3'/>
        </div>
        <div class='checkboxgroup'>
          <label for='4location'>4</label>
          <input type='radio' name='location-radio' id='4location' value='4'/>
        </div>
        <div class='checkboxgroup'>
          <label for='5location'>5</label>
          <input type='radio' name='location-radio' id='5location' value='5'/>
        </div>
      </div>
    </div>
    <div class='splitCol'>
      <p><b>Room: </b></p>
      </br>
      <div id='checkboxes'>
        <div class='checkboxgroup'>
          <label for='1room'>1</label>
          <input type='radio' name='room-radio' id='1room' value='1'/>
        </div>
        <div class='checkboxgroup'>
          <label for='2room'>2</label>
          <input type='radio' name='room-radio' id='2room' value='2'/>
        </div>
        <div class='checkboxgroup'>
          <label for='3room'>3</label>
          <input type='radio' name='room-radio' id='3room' value='3'/>
        </div>
        <div class='checkboxgroup'>
          <label for='4room'>4</label>
          <input type='radio' name='room-radio' id='4room' value='4'/>
        </div>
        <div class='checkboxgroup'>
          <label for='5room'>5</label>
          <input type='radio' name='room-radio' id='5room' value='5'/>
        </div>
      </div>
    </div>
    <div class='splitCol'>
      <p><b>Cleanliness: </b></p>
      </br>
      <div id='checkboxes'>
        <div class='checkboxgroup'>
          <label for='1clean'>1</label>
          <input type='radio' name='clean-radio' id='1clean' value='1'/>
        </div>
        <div class='checkboxgroup'>
          <label for='2clean'>2</label>
          <input type='radio' name='clean-radio' id='2clean' value='2'/>
        </div>
        <div class='checkboxgroup'>
          <label for='3clean'>3</label>
          <input type='radio' name='clean-radio' id='3clean' value='3'/>
        </div>
        <div class='checkboxgroup'>
          <label for='4clean'>4</label>
          <input type='radio' name='clean-radio' id='4clean' value='4'/>
        </div>
        <div class='checkboxgroup'>
          <label for='5clean'>5</label>
          <input type='radio' name='clean-radio' id='5clean' value='5'/>
        </div>
      </div>
    </div>
    <div class='splitCol'>
      <p><b>Service: </b></p>
      </br>
      <div id='checkboxes'>
        <div class='checkboxgroup'>
          <label for='1service'>1</label>
          <input type='radio' name='service-radio' id='1service' value='1'/>
        </div>
        <div class='checkboxgroup'>
          <label for='2service'>2</label>
          <input type='radio' name='service-radio' id='2service' value='2'/>
        </div>
        <div class='checkboxgroup'>
          <label for='3service'>3</label>
          <input type='radio' name='service-radio' id='3service' value='3'/>
        </div>
        <div class='checkboxgroup'>
          <label for='4service'>4</label>
          <input type='radio' name='service-radio' id='4service' value='4'/>
        </div>
        <div class='checkboxgroup'>
          <label for='5service'>5</label>
          <input type='radio' name='service-radio' id='5service' value='5'/>
        </div>
      </div>
    </div>
    <p><b>Review:</b></p>
    <input type='hidden' name='hotelID' value='$hotelID'>
    <input type='hidden' name='userID' value='$userID'>
    <input type='text' name='reviewTitle' value='$reviewTitle'/>
    <textarea placeholder='Review message here' name='reviewText'>$reviewText</textarea><br><br>
    <input class='viewBtn' type='submit' value='Submit Review'>
  </form>";
  echo "</div>";



}else{
  //if no erros then add review
  $insertQry = "INSERT INTO tc_reviews (reviewDate, hotelID, userID, reviewTitle, reviewText, overallRating, locationRating, roomRating, cleanlinessRating, serviceRating)
  VALUES ('$date','$hotelID','$userID','$reviewTitle','$reviewText', '$overall', '$location', '$room', '$clean', '$service')";

  $queryResult = $dbConn->query($insertQry);
        if ($queryResult === false) {
          echo "<p>Please try again! <a href='reviewForm.php?hotelID=$hotelID>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: hotel.php?hotelID=$hotelID");
          die();
        }
}















echo "</div>";
makeFooter();
endHTML();
?>
