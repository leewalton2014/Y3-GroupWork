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
echo "<section class='widthWrap splitCol basicHolidayWrap'>";
while ($rowObj = $queryResult->fetchObject()){
  //Check for rooms
  $getRooms = "SELECT nightRatePerPerson
  FROM tc_rooms INNER JOIN tc_roomtype ON tc_rooms.typeID = tc_roomtype.typeID
  WHERE hotelID = '{$rowObj->hotelID}'";
  //$rooms = $dbConn->query($getRooms);
  //$prices = $rooms[nightRatePerPerson];
  //$minPrice = min($prices);
  if ($minPrice == null){

      echo "<div class='basicHoliday'>
        <img src='{$rowObj->imageRef}'/>
        <h2 class='accent'><a href='hotel.php?hotelID={$rowObj->hotelID}'>{$rowObj->hotelName}</a></h2>
        <div class='rating'><img src='img/ratingPlaceholder.jpg'/></div>
        <span class='price'><p>From</p><h2>425pp</h2></span>
        <input class='viewBtn' type='submit' value='View Holiday'>
      </div>";
  }else{
    echo "<div class='basicHoliday'>
      <img src='{$rowObj->imageRef}'/>
      <h2 class='accent'><a href='hotel.php?hotelID={$rowObj->hotelID}'>{$rowObj->hotelName}</a></h2>
      <div class='rating'><img src='img/ratingPlaceholder.jpg'/></div>
      <span class='price'><p>From</p><h2>425pp</h2></span>
      <input class='viewBtn' type='submit' value='View Holiday'>
    </div>";

  }
}


echo "</section>";
echo "</div>";
makeFooter();
endHTML();
?>
