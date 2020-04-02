<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();
$userID = 1;//PLACEHOLDER UNTILL SESSIONS IMPLEMENTED




$dbConn = getConnection();





echo "</div>";
makeFooter();
endHTML();
?>
