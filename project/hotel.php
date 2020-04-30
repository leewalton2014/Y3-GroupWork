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

$rowObj = $queryResult->fetchObject();
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
          </div>
          <h1>Location</h1>
          <div>
            <p>
            Check the map below for directions.
            </p>
            <iframe src='https://www.google.com/maps/embed/v1/place?key=AIzaSyD-Ikb9FiJVmyXVjSUH2Wms2ot8enQbzu0&q={$rowObj->locationCity},{$rowObj->locationCountry}' width='100%' height='400' frameborder='0' style='border:0;' allowfullscreen=''></iframe>
          </div>
        </article>";

//get summary info
$getReviewCount = "SELECT reviewID
FROM tc_reviews
WHERE hotelID = '$hotelID'";
$reviewCount = $dbConn->query($getReviewCount);
$count = $reviewCount->rowCount();

$overall = avgRating('overallRating',$hotelID);
$location = avgRating('locationRating',$hotelID);
$room = avgRating('roomRating',$hotelID);
$cleanliness = avgRating('cleanlinessRating',$hotelID);
$service = avgRating('serviceRating',$hotelID);


echo "<h1>Reviews</h1>
<div class='splitCol reviewInfo reviewInfoHeader'>";


getStarImage($overall);

echo "<p>($count reviews)</p>
</div>";

echo "<span class='splitCol reviewInfo'>
  <p>Cleanliness:</p>";
getStarImage($cleanliness);
echo "</span>";
echo "<span class='splitCol reviewInfo'>
  <p>Room:</p>";
getStarImage($room);
echo "</span>";
echo "<span class='splitCol reviewInfo'>
  <p>Location:</p>";
getStarImage($location);
echo "</span>";
echo "<span class='splitCol reviewInfo'>
  <p>Service:</p>";
getStarImage($service);
echo "</span>";

echo "<a href='reviewForm.php?hotelID=$hotelID' class='buttonCust'>Leave a review</a>
<br>";

$getReviews = "SELECT reviewID, reviewDate, userID, username, reviewTitle, reviewText, overallRating, locationRating, roomRating, cleanlinessRating, serviceRating
FROM tc_reviews INNER JOIN tc_users ON tc_reviews.userID = tc_users.ID
WHERE hotelID = '$hotelID'";
$reviews = $dbConn->query($getReviews);
if ($reviews->rowCount() == 0){
  echo "<div class='fullReview'>
    <p><b>No Reviews</b></p>
  </div>";
}else{
  while ($review = $reviews->fetchObject()){
    $starRating = $review->overallRating;
    echo "<div class='fullReview'>
      <p><b>{$review->reviewTitle}</b></p>
      <div class='splitCol'>";
      //display image for star rating
      getStarImage($starRating);

    echo "<p> {$review->reviewDate}, </p>
        <p> {$review->username}</p>
      </div>
      <p>{$review->reviewText}</p>
      <a href='reviewReportProcess.php?reviewID={$review->reviewID}&hotelID=$hotelID'>Report Review</a>
    </div>";
  }
}
echo "</div>
</div>";

echo "<aside>
  <div class='cAlign hotelContinue'>
    <span class='price'>&#163;<h2>425pp</h2></span>
    <br>
    <span class='price'><p>Total Price &#163;</p><h2>850</h2></span>
    <h1><a class='#' href='book-holiday.php?hotelID=$hotelID'>Continue</a></h1>
  </div>
  </aside>";


echo "</div>";
makeFooter();
endHTML();
?>
