<?php
include 'functions.php';
setSessionPath();
startHTML('Travel Co.','Home of travel for a newcastle travel agent');
makeHeader();
echo "<div class='widthWrap splitCol'>";
$userID = 1;//PLACEHOLDER UNTILL SESSIONS IMPLEMENTED
$reviewID = filter_has_var(INPUT_GET, 'reviewID') ? $_GET['reviewID'] : null;

//database
  $dbConn = getConnection();
  $deleteReview = "DELETE FROM tc_reviews WHERE reviewID = '$reviewID'";
  $reviewQuery = $dbConn->query($deleteReview);

  $deleteReviewReports = "DELETE FROM tc_flaggedreviews WHERE reviewID = '$reviewID'";
  $reportQuery = $dbConn->query($deleteReviewReports);

  if ($reportQuery === false||$reviewQuery === false) {
    echo "<p>Please try again!<a href='viewFlaggedReviews.php'>Click Here</a></p>\n";
    exit;
  }else{
    header("Location: viewFlaggedReviews.php");
    die();
  }

echo "</div>";
makeFooter();
endHTML();
?>
