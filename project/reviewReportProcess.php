<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();
echo "<div class='widthWrap splitCol'>";
$userID = 1;//PLACEHOLDER UNTILL SESSIONS IMPLEMENTED
$reviewID = filter_has_var(INPUT_GET, 'reviewID') ? $_GET['reviewID'] : null;
$hotelID = filter_has_var(INPUT_GET, 'hotelID') ? $_GET['hotelID'] : null;
//database

    $dbConn = getConnection();
    $insertQry = "INSERT INTO tc_flaggedreviews (reviewID, userID)
    VALUES ('$reviewID','$userID')";

    $queryResult = $dbConn->query($insertQry);

      if ($queryResult === false) {
        echo "<p>Please try again!</p>\n";
        exit;
      }else{
        header("Location: hotel.php?hotelID=$hotelID");
        die();
      }

echo "</div>";
makeFooter();
endHTML();
?>
