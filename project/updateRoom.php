<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();


$roomID = filter_has_var(INPUT_GET, 'roomID') ? $_GET['roomID'] : null;
$boardType = filter_has_var(INPUT_GET, 'boardType') ? $_GET['boardType'] : null;
$roomNo = filter_has_var(INPUT_GET, 'roomNo') ? $_GET['roomNo'] : null;


$errors = false;








try {
   


            if (empty($boardType)) {
                echo "<p>You need to select a Board Type</p>\n";
                $errors = true;
            }
            if (empty($roomNo)) {
                echo "<p>You need to provide a Room Number</p>\n";
                $errors = true;
            }

            if ($errors === true) {
                echo "<p><a href='addholiday-form.php'>Please try again</a>.</p>\n";
            } else {
                $dbConn = getConnection();
               


                $updateSQL = "UPDATE tc_rooms
                              SET boardtype = :boardType,
                                  roomNo = :roomNo
                                  WHERE roomID = :roomID";
                
                $updateResult = $dbConn->prepare($updateSQL);
                
                $updateResult->execute(array(':roomID' => $roomID,
                                             ':boardType' => $boardType,
                                             ':roomNo' => $roomNo
                                            ));
            
                                  
                                  
                                  
                
                echo "<p>You Have Successfully Updated Room Details</p>";
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
