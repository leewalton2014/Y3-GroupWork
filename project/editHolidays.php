<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();



$hotelID = filter_has_var(INPUT_GET, 'hotelID') ? $_GET['hotelID'] : null;

$dbConn = getConnection();
$getUsersQuery = "SELECT tc_hotels.hotelID, hotelName, hotelDescription, hotelLocation, roomNo, boardType, nightRatePerPerson, occupancy, typeName, locationCity, locationCountry, imageRef

FROM tc_rooms INNER JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
              INNER JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
              INNER JOIN tc_locations on tc_hotels.hotelLocation = tc_locations.locationID
              WHERE tc_hotels.hotelID = '$hotelID'
              ORDER BY tc_hotels.hotelID";

$queryResult = $dbConn->query($getUsersQuery);


echo '<h1>Edit Hotel Information</h1>
<form action="updateHoliday.php" method="post">
<h2>Hotel Location</h2>
<input type="radio" value="1" name="locationID">
<label for="1">London</label>
<input type="radio" value="2" name="locationID">
<label for="2">Manchester</label>
<input type="radio" value="3" name="locationID">
<label for="3">Tokyo</label>
<input type="radio" value="4" name="locationID">
<label for="4">Paris</label>
<input type="radio" value="5" name="locationID">
<label for="5">Berlin</label>';


while ($rowObj = $queryResult->fetchObject()){
    echo "
          <h2>Hotel ID</h2>
          <input type='text' name='hotelID' value='{$rowObj->hotelID}' readonly>
          <h2>Hotel Name</h2>
          <input type='text' name='hotelName' value='{$rowObj->hotelName}'>
          <h2>Hotel Price</h2>
          <input type='text' name='nightRatePerPerson' value='{$rowObj->nightRatePerPerson}'>
          <h2>Hotel Description</h2>
          <input type='text' name='hotelDescription' value='{$rowObj->hotelDescription}'>
          <h2>Image Link</h2>
          <input type='text' name='imageRef' value='{$rowObj->imageRef}'>
            ";
}
echo '
<h2>Inclusions</h2>
<p>Pool</p>
<input type="radio" value="1" name="pool">
<label for="1">Yes</label>
<input type="radio" value="0" name="pool">
<label for="0">No</label>
<p>Spa</p>
<input type="radio" value="1" name="spa">
<label for="1">Yes</label>
<input type="radio" value="0" name="spa">
<label for="0">No</label>
<p>Balcony</p>
<input type="radio" value="1" name="balcony">
<label for="1">Yes</label>
<input type="radio" value="0" name="balcony">
<label for="0">No</label>
<p>Bar</p>
<input type="radio" value="1" name="bar">
<label for="1">Yes</label>
<input type="radio" value="0" name="bar">
<label for="0">No</label>
<p>Restaurant</p>
<input type="radio" value="1" name="restaurant">
<label for="1">Yes</label>
<input type="radio" value="0" name="restaurant">
<label for="0">No</label><br>

<input type="submit" value="Submit Changes">
          </form>';




echo "<h1>Select an existing room to edit<h1>";

$getRoomsQuery = "SELECT *, tc_rooms.roomID, tc_roomtype.typeID from tc_rooms
JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
WHERE tc_hotels.hotelID = $hotelID";


$dbConn = getConnection();
    $queryResult = $dbConn->query($getRoomsQuery);



echo"

<form action='editRoom.php' method='get'>
<table>
<tr>

</tr>
<tr>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<td>
              
              
              <a href='editRoom.php?roomID={$rowObj->roomID}'>{$rowObj->roomNo}</a><hr>
              <p>{$rowObj->boardType}</p></td>
              ";
              

}


//<a href='editRecord.php?recordID={$rowObj->recordID}'>{$rowObj->recordTitle}</a>

holidaysJs();



makeFooter();
endHTML();
?>
