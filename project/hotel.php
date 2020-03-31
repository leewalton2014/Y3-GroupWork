<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();


$hotelID = filter_has_var(INPUT_GET, 'hotelID') ? $_GET['hotelID'] : null;
//$hotelID = 1;//placeholder


$dbConn = getConnection();
$getUsersQuery = "SELECT tc_hotels.hotelID, hotelName, hotelDescription, hotelLocation, roomNo, boardType, nightRatePerPerson, occupancy, typeName, locationCity, locationCountry, imageRef

FROM tc_rooms INNER JOIN tc_roomtype on tc_rooms.typeID = tc_roomtype.typeID
              INNER JOIN tc_hotels on tc_hotels.hotelID = tc_rooms.hotelID
              INNER JOIN tc_locations on tc_hotels.hotelLocation = tc_locations.locationID
              WHERE tc_hotels.hotelID = '$hotelID'
              ORDER BY tc_hotels.hotelID";





$queryResult = $dbConn->query($getUsersQuery);



echo "<div class='widthWrap splitCol'>";
/*
while ($rowObj = $queryResult->fetchObject()){
    echo "<div class='smallHoliday'>
        <img src='{$rowObj->imageRef}'/>
        <h1>{$rowObj->hotelName}</h1>

        <div class='splitCol'>
        <div class='rating'><img src='img/ratingPlaceholder.jpg'/></div>
        <span class='price'><p>From</p><h2>£{$rowObj->nightRatePerPerson}pp</h2></span>
        </div>


        <h2>{$rowObj->locationCity}, {$rowObj->locationCountry}</h2>

        <p>{$rowObj->hotelDescription}</p>
        <h2>Board Type</h2>
        <p>{$rowObj->boardType}</p>


        <form action='hotelBooking.php' method='post'>
        <h2>Select Room Type</h2>
        <select>
            <option value={$rowObj->typeName}'>{$rowObj->typeName}</option>
        </select>
        <hr>
            <input type='submit' value='Book Now'>
        </form>
        <hr>


        <h2>Read the Reviews</h2>








      </div>


      ";


}*/
while ($rowObj = $queryResult->fetchObject()){
    echo "<div class='widthWrap splitCol'>
      <div class='hotel'>
        <p>Hotels > {$rowObj->locationCountry} > {$rowObj->locationCity} > <b>{$rowObj->hotelName}</b></p>
        <h1>{$rowObj->hotelName}</h1>
        <h2>{$rowObj->locationCity}, {$rowObj->locationCountry}</h2>
        <div class='splitCol'>
          <p>Star rating</p>
          <span class='price'><p>From</p><h2>425pp</h2></span>
        </div>
        <img src='{$rowObj->imageRef}'/>

        <article>
          <h1>Holiday Description</h1>
          <div>
            <p>{$rowObj->hotelDescription}</p>
            <ul>
              <li>List of items example</li>
              <li>List of items example</li>
              <li>List of items example</li>
              <li>List of items example</li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
          </div>
          <h1>Location</h1>
          <div>
            <p>
            Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
            purus. Vivamus hendrerit, dolor at aliquet laoreet.<br>
            </p>
            <iframe src='https://www.google.com/maps/embed/v1/place?key=AIzaSyD-Ikb9FiJVmyXVjSUH2Wms2ot8enQbzu0&q={$rowObj->locationCity},{$rowObj->locationCountry}' width='100%' height='400' frameborder='0' style='border:0;' allowfullscreen=''></iframe>
          </div>
        </article>

      </div>
      <aside>
        <div class='cAlign hotelContinue'>
          <span class='price'>&#163;<h2>425pp</h2></span>
          <br>
          <span class='price'><p>Total Price &#163;</p><h2>850</h2></span>
          <h1><a class='#' href='book-holiday.php?hotelID={$rowObj->hotelID}'>Continue</a></h1>     
        </div>
        </aside>
      </div>";
      
}

/*
    <aside>
        <div class='cAlign hotelContinue'>
          <span class='price'>&#163;<h2>425pp</h2></span>
          <br>
          <span class='price'><p>Total Price &#163;</p><h2>850</h2></span>
          <form action='book-holiday.php?hotelID={$rowObj->hotelID}'>
          <a href='book-holiday.php?hotelID={$rowObj->hotelID}'>View</a>
          <input class='viewBtn' type='submit' value='Continue'>
          </form>
        </div>
        </aside>
      </div>
    
*/

echo "</div>";
makeFooter();
endHTML();
?>
