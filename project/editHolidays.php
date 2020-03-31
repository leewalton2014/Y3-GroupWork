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

echo "<div class='widthWrap splitCol'>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<h1>Edit Hotel Information</h1>
          <form action='updateHoliday.php' method='post'>
          <h2>Hotel ID</h2>
          <input type='text' name='hotelID' value='{$rowObj->hotelID}' readonly>
          <h2>Hotel Name</h2>
          <input type='text' name='hotelName' value='{$rowObj->hotelName}'>
          <h2>Hotel Price</h2>
          <input type='text' name='nightRatePerPerson' value='{$rowObj->nightRatePerPerson}'>
          <h2>Hotel Description</h2>
          <input type='text' name='hotelDescription' value='{$rowObj->hotelDescription}'>
          <h2>Board Type (Cannot Update Yet)</h2>
          <input type='text' name='boardType' value='{$rowObj->boardType}'>
          <input type='submit' value='Submit Changes'>
          </form>
            ";
}

//<a href='editRecord.php?recordID={$rowObj->recordID}'>{$rowObj->recordTitle}</a>

holidaysJs();


echo "</div>";
makeFooter();
endHTML();
?>
