<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();



$roomID = filter_has_var(INPUT_GET, 'roomID') ? $_GET['roomID'] : null;



$dbConn = getConnection();
$getUsersQuery = "SELECT * FROM tc_rooms WHERE roomID = $roomID";

$queryResult = $dbConn->query($getUsersQuery);


echo '<h1>Edit Room Information</h1>
<form action="updateRoom.php" method="get">
';


while ($rowObj = $queryResult->fetchObject()){
    echo "
          <h2>Room ID</h2>
          <input type='text' name='roomID' value='{$rowObj->roomID}' readonly>
          <h2>Room Number</h2>
          <input type='text' name='roomNo' value='{$rowObj->roomNo}'>
         
          <br>
            ";
}
echo"<h3>Board Type</h3>
         <input type='radio' value='All inclusive, drinks included.' name='boardType'>
         <label for='>All inclusive, drinks included.'>All inclusive, drinks included.</label><br>
         <input type='radio' value='All inclusive.' name='boardType'>
         <label for='All inclusive.'>All inclusive.</label><br>
         <input type='radio' value='Inclusive.' name='boardType'>
         <label for='Inclusive.'>Inclusive.</label><br>
         
         


<input type='submit' value='Submit Changes'>
          </form>";




holidaysJs();



makeFooter();
endHTML();
?>
