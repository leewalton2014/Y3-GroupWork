<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();

//echo getcwd();



$getUsersQuery = "SELECT hotelID, hotelName, hotelDescription, locationCity, locationCountry, imageRef
FROM tc_hotels INNER JOIN tc_locations ON tc_hotels.hotelLocation = tc_locations.locationID";



$dbConn = getConnection();

$queryResult = $dbConn->query($getUsersQuery);

echo "<div class='widthWrap splitCol'>";

while ($rowObj = $queryResult->fetchObject()){
  //Check for rooms
  $getRooms = "SELECT nightRatePerPerson
  FROM tc_rooms INNER JOIN tc_roomtype ON tc_rooms.typeID = tc_roomtype.typeID
  WHERE hotelID = '{$rowObj->hotelID}'";
  //$rooms = $dbConn->query($getRooms);
  //$prices = $rooms[nightRatePerPerson];
  //$minPrice = min($prices);
  if ($minPrice == null){
    echo "<div class='smallHoliday'>
        <img src='{$rowObj->imageRef}'/>

        <a href='hotel.php?hotelID={$rowObj->hotelID}'><h1>{$rowObj->hotelName}</h1></a>
        <h2>{$rowObj->locationCity}, {$rowObj->locationCountry}</h2>

        <div class='splitCol'>
          <div class='rating'><img src='img/ratingPlaceholder.jpg'/></div>
          <span class='price'><h2>No Rooms</h2></span>
        </div>
      </div>";
  }else{
    echo "<div class='smallHoliday'>
        <img src='{$rowObj->imageRef}'/>

        <a href='hotel.php?hotelID={$rowObj->hotelID}'><h1>{$rowObj->hotelName}</h1></a>
        <h2>{$rowObj->locationCity}, {$rowObj->locationCountry}</h2>

        <div class='splitCol'>
          <div class='rating'><img src='img/ratingPlaceholder.jpg'/></div>
          <span class='price'><p>From</p><h2>£...</h2></span>
        </div>
      </div>";
  }
}

//<a href='editRecord.php?recordID={$rowObj->recordID}'>{$rowObj->recordTitle}</a>

//holidaysJs();


echo "</div>";
makeFooter();
endHTML();
?>
