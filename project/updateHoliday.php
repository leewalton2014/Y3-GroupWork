<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();


$hotelID = filter_has_var(INPUT_GET, 'hotelID') ? $_GET['hotelID'] : null;
$hotelName = filter_has_var(INPUT_GET, 'hotelName') ? $_GET['hotelName'] : null;
$nightRatePerPerson = filter_has_var(INPUT_GET, 'nightRatePerPerson') ? $_GET['nightRatePerPerson'] : null;
$hotelDescription = filter_has_var(INPUT_GET, 'hotelDescription') ? $_GET['hotelDescription'] : null;
$boardType = filter_has_var(INPUT_GET, 'boardType') ? $_GET['boardType'] : null;

    
$hotelID = filter_has_var(INPUT_POST, 'hotelID') ? $_POST['hotelID'] : null;
$hotelName = filter_has_var(INPUT_POST, 'hotelName') ? $_POST['hotelName'] : null;
$nightRatePerPerson = filter_has_var(INPUT_POST, 'nightRatePerPerson') ? $_POST['nightRatePerPerson'] : null;
$hotelDescription = filter_has_var(INPUT_POST, 'hotelDescription') ? $_POST['hotelDescription'] : null;
$boardType = filter_has_var(INPUT_POST, 'boardType') ? $_POST['boardType'] : null;


$errors = false;








try {
   


            if (empty($hotelName)) {
                echo "<p>You need to provide a name for the Hotel</p>\n";
                $errors = true;
            }
            if (empty($nightRatePerPerson)) {
                echo "<p>You need to provide a night rate per person</p>\n";
                $errors = true;
            }
            if (empty($hotelDescription)) {
                echo "<p>You need to provide a hotel description</p>\n";
                $errors = true;
            }
            if (empty($boardType)) {
                echo "<p>You need to provide a board type</p>\n";
                $errors = true;
            }

            if ($errors === true) {
                echo "<p><a href='holidays.php'>Please try again</a>.</p>\n";
            } else {
                $dbConn = getConnection();
               


                $updateSQL = "UPDATE tc_hotels 
                              SET hotelName = :hotelName, 
                              hotelDescription = :hotelDescription
                              WHERE hotelID = :hotelID";
                
                $updateResult = $dbConn->prepare($updateSQL);
                
                $updateResult->execute(array(':hotelName' => $hotelName,
                                             ':hotelDescription' => $hotelDescription, 
                                             ':hotelID' => $hotelID
                                            ));
            
                              
                $updateSQL2 = "UPDATE tc_rooms
                              SET boardType=:boardType
                              WHERE tc_rooms.hotelID = :hotelID";
                
                $updateResult = $dbConn->prepare($updateSQL2);
                
                $updateResult->execute(array(':boardType' => $boardType,
                                             ':hotelID' => $hotelID
                                            ));
            
                              
               /* $updateSQL3 = "UPDATE tc_roomType
                              SET nightRatePerPerson=:nightRatePerPerson
                              FROM tc_roomType
                              JOIN tc_rooms 
                              ON tc_rooms.typeID = tc_roomType.typeID
                              WHERE tc_rooms.hotelID = :hotelID";
                                  
                $updateResult = $dbConn->prepare($updateSQL3);
                
                $updateResult->execute(array(':nightRatePerPeson' => $nightRatePerPerson,
                                             ':hotelID' => $hotelID
                                            ));
                              */
                                  
                                  
                                  
                
                echo "<p>You Have Successfully Updated Hotel Details</p>";
                echo "<form action='holidays.php'>
               <input type='submit' value='Back to Holidays'>
               </form><br>";


            }
        } catch (Exception $e) {
            $errors = true;
            echo "<p>Record not updated: " . $e->getMessage() . "</p>\n";
            
        }
    

















holidaysJs();


echo "</div>";
makeFooter();
endHTML();
?>
