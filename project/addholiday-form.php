<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();

?>

<h1>Create A Hotel</h1>
<h2>Hotel will not display on the holidays until at least 1 room has been added</h2>
<form action="addholiday-process.php" method="post">
 <input type="text" placeholder="Hotel Name" name="hotelName">
<input type="text" placeholder="Hotel Description" name="hotelDescription"><br>
<h2>Hotel Location</h2>
<?php

    $getUsersQuery = "SELECT locationCity, locationID, locationCountry
FROM tc_locations
";



$dbConn = getConnection();

$queryResult = $dbConn->query($getUsersQuery);



while ($rowObj = $queryResult->fetchObject()){
    echo "

          <input type='radio' value='{$rowObj->locationID}' name='locationID'>
          <label for='{$rowObj->locationID}'>{$rowObj->locationCity}, {$rowObj->locationCountry}</label><br>";

        }


?>




<input type="text" placeholder="Image Link" name="imageRef">
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
<input type="submit"  value="Create Hotel">
</form>


<h1>Add a room for an existing hotel</h1>


<form action='addroom-process.php' method="post">
    
   <!-- <option value='{$rowObj->hotelID}'>{$rowObj->hotelName}</option><br><br>-->
  



<?php

    $getUsersQuery = "SELECT tc_hotels.hotelID, hotelName
FROM tc_hotels 
";



$dbConn = getConnection();

$queryResult = $dbConn->query($getUsersQuery);



while ($rowObj = $queryResult->fetchObject()){
    echo "
    
          
          <input type='radio' value='{$rowObj->hotelID}' name='hotelID'>
          <label for='{$rowObj->hotelID}'>{$rowObj->hotelName}</label><br><br>";

        }
         echo"<h3>Room Number</h3>
          <input type='text' placeholder='Room Number' name='roomNumber'><br>";
    
    

    
    $getRoomTypes = "SELECT typeID, typeName
                     FROM tc_roomtype";

    $dbConn = getConnection();
    $queryResult = $dbConn->query($getRoomTypes);

while ($rowObj = $queryResult->fetchObject()){
    echo "
    
          
          <input type='radio' value='{$rowObj->typeID}' name='typeID'>
          <label for='{$rowObj->typeID}'>{$rowObj->typeName}</label><br><br>
          ";
          
        }    
    
    echo"<h3>Board Type</h3>
         <input type='radio' value='All inclusive, drinks included.' name='boardType'>
         <label for='>All inclusive, drinks included.'>All inclusive, drinks included.</label>
         <input type='radio' value='All inclusive.' name='boardType'>
         <label for='All inclusive.'>All inclusive.</label><br>
         <input type='radio' value='Inclusive.' name='boardType'>
         <label for='Inclusive.'>Inclusive.</label><br>
         <input type='submit' value='Create Room'>
         </form>";
    



?>
    
<?php
holidaysJs();


echo "</div>";
makeFooter();
endHTML();
?>
