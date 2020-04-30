<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();
echo "<div class='widthWrap splitCol'>";
$userID = 1;//PLACEHOLDER UNTILL SESSIONS IMPLEMENTED


//database
  $dbConn = getConnection();
  $getReportedReviews = "SELECT reviewTitle, reviewText, tc_reviews.reviewID
  FROM tc_flaggedreviews INNER JOIN tc_reviews ON tc_flaggedreviews.reviewID = tc_reviews.reviewID
  GROUP BY reviewID";
  $reviews = $dbConn->query($getReportedReviews);

if ($reviews->rowCount() == 0){
  echo "<p>No reported reviews outstanding.</p>";
}else{
  //start table
  echo "<div class='admin'>";
  echo "<h1>Reported Reviews</h1>
      <p>Delete reviews which do not meets the guidelines or clear
      all reports on the review by clearing the review in which case it will remain visible on the site.</p>
      <table>
        <tr>
          <th>Review Title</th>
          <th>Review Text</th>
          <th>Delete Review</th>
          <th>Clear Review</th>
        </tr>";
  while ($review = $reviews->fetchObject()){
      //Display table rows
      echo "<tr>
        <td>{$review->reviewTitle}</td>
        <td>{$review->reviewText}</td>
        <td><a href='removeReview.php?reviewID={$review->reviewID}'>Delete</a></td>
        <td><a href='clearReview.php?reviewID={$review->reviewID}'>Clear</a></td>
      </tr>";
  }
  //end table
  echo "</table>";
  echo "</div>";
}



echo "</div>";
makeFooter();
endHTML();
?>
