<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();


$hotelID = filter_has_var(INPUT_GET, 'hotelID') ? $_GET['hotelID'] : null;
//$hotelID = 1;//placeholder


$dbConn = getConnection();
$getUsersQuery = "SELECT hotelName, hotelDescription, hotelLocation, roomNo, boardType, nightRatePerPerson, occupancy, typeName, locationCity, locationCountry, imageRef

FROM tc_rooms INNER JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
              INNER JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
              INNER JOIN tc_locations on tc_hotels.hotelLocation = tc_locations.locationID
              WHERE tc_hotels.hotelID = '$hotelID'
              ORDER BY tc_hotels.hotelID";





$queryResult = $dbConn->query($getUsersQuery);





$rowObj = $queryResult->fetchObject();
    echo "<div class='smallHoliday'>
        <img src='{$rowObj->imageRef}'/>
        <h1>{$rowObj->hotelName}</h1>

        <div class='splitCol'>
        <div class='rating'><img src='img/ratingPlaceholder.jpg'/></div>
     
        </div>


        <h2>{$rowObj->locationCity}, {$rowObj->locationCountry}</h2>

        <p>{$rowObj->hotelDescription}</p>
        <h2>Board Type</h2>
        <p>{$rowObj->boardType}</p>";
        
        


$getRoomTypeQuery = "SELECT tc_hotels.hotelID, tc_rooms.typeID, hotelName, hotelDescription, hotelLocation, roomNo, boardType, nightRatePerPerson, occupancy, typeName, locationCity, locationCountry, imageRef

FROM tc_rooms INNER JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
              INNER JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
              INNER JOIN tc_locations on tc_hotels.hotelLocation = tc_locations.locationID
              WHERE tc_hotels.hotelID = '$hotelID'
              ORDER BY tc_hotels.hotelID";


$queryResult = $dbConn->query($getRoomTypeQuery);

echo"<form action='book-room.php' method='post'>
        <h2>Select Room Type</h2>";

while ($rowObj = $queryResult->fetchObject()){



        echo"
         <input type='hidden' name='hotelID' value='{$rowObj->hotelID}'>
         
         
         ";
    
}

     $getRoomTypeQuery = "SELECT typeID, typeName, nightRatePerPerson FROM tc_roomtype";

$queryResult = $dbConn->query($getRoomTypeQuery);



while ($rowObj = $queryResult->fetchObject()){

         echo"
         <input type='radio' value='{$rowObj->typeID}' name='typeID'>
         <label for='typeID'>{$rowObj->typeName}. From: <span class='price'><h2>£{$rowObj->nightRatePerPerson} pp</h2></span></label><br>";
            
        
}




echo "<hr>
            <input type='submit' value='Book Now'>
        </form>
        <hr>";



echo "</div>";
makeFooter();
endHTML();
?>
