<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();


$arrivalDate = filter_has_var(INPUT_POST, 'arrivalDate') ? $_POST['arrivalDate'] : null;
$occupancy = filter_has_var(INPUT_POST, 'occupancy') ? $_POST['occupancy'] : null;
$stayDuration = filter_has_var(INPUT_POST, 'stayDuration') ? $_POST['stayDuration'] : null;
$numberOfGuests = filter_has_var(INPUT_POST, 'numerOfGuests') ? $_POST['numberOfGuests'] : null;
$roomNo = filter_has_var(INPUT_POST, 'roomNo') ? $_POST['roomNo'] : null;
$roomID = filter_has_var(INPUT_POST, 'roomID') ? $_POST['roomID'] : null;

$username = $_SESSION['username'];


try {
   


            if (empty($arrivalDate)) {
                echo "<p>You need to provide an Arrival Date</p>\n";
                $errors = true;
            }if (empty($stayDuration)) {
                echo "<p>You need to provide a Stay Duration</p>\n";
                $errors = true;
            }
            if (empty($roomNo)) {
                echo "<p>You need to select a Room Number</p>\n";
                $errors = true;
            }if($numberOfGuests > $occupancy){
                echo "You have gone over the guest limit, please reduce amount of guests or pick a larger room.";
                $errors = true;
            }if($stayDuration <= 0){
                echo "You have not entered a valid stay duration.";
            }

                
                
                
                
                

            if ($errors === true) {
                echo "<p><a href='holidays.php'>Please try again</a>.</p>\n";
            } else {
                $dbConn = getConnection();
               


                $insertBookingQuery = "INSERT INTO tc_bookings(userID, roomID, arrivalDate, stayDuration, numberGuests)
                                       SELECT userID, roomID, $arrivalDate, $stayDuration, $numberOfGuests
                                       FROM tc_users
                                       WHERE username = $username
                
                ";
                                       
                $updateResult = $dbConn->prepare($updateSQL);
                $statement = $dbConn->prepare($insertBookingQuery);
                $statement->execute();
                
            
                                  
                                  
                                  
                
                echo "<p>Your invoice</p>";
                
                $bookingInvoiceQuery = "SELECT *, tc_users.username, tc_rooms.roomNo 
                                        FROM tc_bookings
                                        JOIN tc_users on tc_bookings.userID = tc_users.userID
                                        JOIN tc_rooms on tc_bookings.roomID = tc_rooms.roomID
                                        WHERE tc_users.username = $username";
                
                
                $dbConn = getConnection();
                $queryResult = $dbConn->query($bookingInvoiceQuery);
                
                echo "<table>
                        <tr>
                            <th>username</th>
                            <th>room Number</th>
                            <th>Arrival Date</th>
                            <th>Stay Durationi</th>
                            <th>Number of Guests</th>
                        </tr>
                        <tr>
                                ";

                while ($rowObj = $queryResult->fetchObject()){
                echo "<td>{$rowObj->username}</td>
                      <td>{$rowObj->roomNo}</td>
                      <td>{$rowObj->arrivalDate}</td>
                      <td>{$rowObj->stayDuration}</td>
                      <td>{$rowObj->numberGuests}</td>";


}
                
                
                
                echo "<form action='holidays.php'>
               <input type='submit' value='Back to Holidays'>
               </form><br>";


            }
        } catch (Exception $e) {
            $errors = true;
            echo "<p>Unsuccessful: " . $e->getMessage() . "</p><a href='holidays.php'>Try again</a>\n";
            
        }
















holidaysJs();


echo "</div>";
makeFooter();
endHTML();
?>
