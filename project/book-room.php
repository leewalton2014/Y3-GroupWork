<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();

?>

<?php 


$hotelID = filter_has_var(INPUT_POST, 'hotelID') ? $_POST['hotelID'] : null;
$typeID = filter_has_var(INPUT_POST, 'typeID') ? $_POST['typeID'] : null;


//echo $hotelID;
//echo $typeID;


$getRoomsQuery = "SELECT *, tc_roomtype.typeID from tc_rooms
JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
WHERE tc_rooms.typeID = $typeID AND tc_hotels.hotelID = $hotelID";

$dbConn = getConnection();
    $queryResult = $dbConn->query($getRoomsQuery);

$rowObj = $queryResult->fetchObject();
    echo "<h1>Displaying all available rooms for type {$rowObj->typeName}</h1>";


$getRoomsQuery = "SELECT *, tc_roomtype.typeID from tc_rooms
JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
WHERE tc_rooms.typeID = $typeID AND tc_hotels.hotelID = $hotelID";


$dbConn = getConnection();
    $queryResult = $dbConn->query($getRoomsQuery);



echo"

<form action='book-room-process.php' method='post'>
<table>
<tr>

</tr>
<tr>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<td><input type='radio' value='{$rowObj->roomNo}' name='roomNo'>
              <label for'roomNo'>{$rowObj->roomNo}</label></td> ";


}


echo"
</tr>
</table>
</form>";


?>
    


<?php
holidaysJs();


echo "</div>";
makeFooter();
endHTML();
?>
