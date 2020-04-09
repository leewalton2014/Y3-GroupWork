<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();

?>

<?php 


$hotelID = filter_has_var(INPUT_POST, 'hotelID') ? $_POST['hotelID'] : null;
$typeID = filter_has_var(INPUT_POST, 'typeID') ? $_POST['typeID'] : null;


//echo $hotelID;
//echo $typeID;


$getRoomsQuery = "SELECT *, tc_roomtype.typeID from tc_rooms
JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
WHERE tc_rooms.typeID = $typeID AND tc_hotels.hotelID = $hotelID";

$dbConn = getConnection();
    $queryResult = $dbConn->query($getRoomsQuery);

$rowObj = $queryResult->fetchObject();
    echo "<h1>Displaying all available rooms for type {$rowObj->typeName}</h1>
          <h2>Select the room you would like</h2>";



$getRoomsQuery = "SELECT *, tc_hotels.hotelID, tc_roomtype.typeID from tc_rooms
JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
WHERE tc_rooms.typeID = $typeID AND tc_hotels.hotelID = $hotelID";


$dbConn = getConnection();
    $queryResult = $dbConn->query($getRoomsQuery);



echo"

<form action='bookingConfirmation.php' method='post'>
<table>
<tr>

</tr>
<tr>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<td>
    <input type='hidden' value='{$rowObj->hotelID}' name='hotelID'>
    <input type='hidden' value='{$rowObj->roomID}' name='roomID'>
    <input type='radio' value='{$rowObj->roomNo}' name='roomNo'>
              <label for'roomNo'><h2>Room Number</h2><hr>{$rowObj->roomNo}  <hr> <h2>Board Type</h2><p>{$rowObj->boardType}</p></label></td> ";


}


echo"
</tr>
</table>";



/*$getHotelFeatures = "SELECT pool, spa, balcony, bar, restaurant FROM tc_hotels WHERE hotelID = $hotelID"

$dbConn = getConnection();
$queryResult = $dbConn->query($getRoomsQuery);
$rowObj = $queryResult->fetchObject();

echo"<h2>Hotel Features</h2>
*/






$getRoomsQuery = "SELECT occupancy FROM tc_roomtype WHERE typeID = $typeID";
$dbConn = getConnection();
$queryResult = $dbConn->query($getRoomsQuery);
$rowObj = $queryResult->fetchObject();

echo"




<h2>How long will you be staying?</h2>
  <input type='hidden' name='occupancy' value='{$rowObj->occupancy}'>
  <label for='arrivalDate'>Arrival Date:</label>
  <input type='date' id='arrivalDate' name='arrivalDate'>
  <p>Stay Duration (Days)</p>
  <input type='text' placeholder='stayDuration (Days)' name='stayDuration'>
  <p>Number of guests. The maximum number of guests for this room is {$rowObj->occupancy}></p>
  <input type='text' name='numberOfGuests' placeholder='Number of Guests' min='1' max='{$rowObj->occupancy}'>
    
    
  <input type='submit'>
</form>";

?>





<?php
holidaysJs();


echo "</div>";
makeFooter();
endHTML();
?>
