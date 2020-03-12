<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();

$getUsersQuery = "SELECT roomID, nightRatePerPerson, hotelName, hotelDescription, locationCity, locationCountry, imageRef
FROM tc_rooms INNER JOIN tc_roomtype ON tc_rooms.typeID = tc_roomtype.typeID
INNER JOIN tc_hotels ON tc_rooms.hotelID = tc_hotels.hotelID
INNER JOIN tc_locations ON tc_hotels.hotelLocation = tc_locations.locationID";
$dbConn = getConnection();
$queryResult = $dbConn->query($getUsersQuery);

echo "<div class='widthWrap splitCol'>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<div class='smallHoliday'>
        <img src='{$rowObj->imageRef}'/>
        <h1>{$rowObj->hotelName}</h1>
        <h2>{$rowObj->locationCity}, {$rowObj->locationCountry}</h2>
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
