<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();



$hotelID = 1;//placeholder

$getUsersQuery = "SELECT hotelName, hotelDescription, hotelLocation, roomNo, boardType, nightRatePerPerson, occupancy, typeName, locationCity, locationCountry, numberGuests

FROM tc_rooms INNER JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
              INNER JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
              INNER JOIN tc_locations on tc_hotels.hotelLocation = tc_locations.locationID
              WHERE hotelID = $hotelID";

$dbConn = getConnection();

$queryResult = $dbConn->query($getUsersQuery);

echo "<div class='widthWrap splitCol'>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<div class='smallHoliday'>
        <img src='{$rowObj->imageRef}'/>
        <h1>{$rowObj->hotelName}</h1>
        <h2>{$rowObj->locationCity}, {$rowObj->locationCountry}</h2>
        
        <p>{$rowObj->hotelDescription}</p>
        
        
        <form action='hotelBooking.php' method='post'>
        <h2>Room Type</h2>
        <select>
            <option value={$rowObj->typeName}'>{$rowObj->typeName}</option>
        </select>
            <input type='submit' value='Book Now'>
        </form>
        <div class='splitCol'>
          <div class='rating'><img src='img/ratingPlaceholder.jpg'/></div>
          <span class='price'><p>From</p><h2>£{$rowObj->nightRatePerPerson}pp</h2></span>
        </div>
      </div>";
}





echo "</div>";
makeFooter();
endHTML();
?>
