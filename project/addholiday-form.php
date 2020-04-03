<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();

?>

<h1>Create A Hotel</h1>
<form action="addholiday-process" method="post">
<input type="text" placeholder="Hotel Name">
<input type="text" placeholder="Hotel Description">
<h2>Hotel Location</h2>
<input type="radio" value="1" name="location">
<label for="1">London</label>
<input type="radio" value="2" name="location">
<label for="2">Manchester</label>
<input type="radio" value="3" name="location">
<label for="3">Tokyo</label>
<input type="radio" value="4" name="location">
<label for="4">Paris</label>
<input type="radio" value="5" name="location">
<label for="5">Berlin</label>


<input type="text" placeholder="Image Link">
<h2>Inclusions</h2>
<p>Pool</p>
<input type="radio" value="1" name="pool">
<label for="1">Yes</label>
<input type="radio" value="0" name="pool">
<label for="0">No</label>
<p>Spa</p>
<input type="radio" value="1" name="pool">
<label for="1">Yes</label>
<input type="radio" value="0" name="pool">
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


<form action='addroom-process'>
    
   <!-- <option value='{$rowObj->hotelID}'>{$rowObj->hotelName}</option><br><br>-->
  



<?php

    $getUsersQuery = "SELECT tc_hotels.hotelID, hotelName
FROM tc_hotels 
";



$dbConn = getConnection();

$queryResult = $dbConn->query($getUsersQuery);



while ($rowObj = $queryResult->fetchObject()){
    echo "<form action='addroom-process.php' method='post'>
    
          
          <input type='radio' value='{$rowObj->hotelID}' name='hotelID'>
          <label for='{$rowObj->hotelID}'>{$rowObj->hotelName}</label><br><br>";

        }
         echo"<h3>Room Number</h3>
          <input type='text' placeholder='Room Number'><br>";
    
    

    
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
         <input type='radio' value='1' name='boardType'>
         <label for='1'>All inclusive, drinks included.</label>
         <input type='radio' value='2' name='boardType'>
         <label for='2'>Full board, no drinks included.</label><br>
         <input type='submit' value='Create Room'>
         </form>";
    



?>
    
<?php
holidaysJs();


echo "</div>";
makeFooter();
endHTML();
?>
