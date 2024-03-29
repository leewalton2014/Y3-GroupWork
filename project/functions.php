<?php
//Database connection
function getConnection() {
    try {
        $currentPath = getcwd();
        //$connection = new PDO('sqlite:tc_holidays.sqlite');
      //$connection = new PDO('mysql:host=localhost;dbname=unn_w17007224', 'unn_w17007224', 'db2020lww');
     //$connection = new PDO('mysql:host=localhost;dbname=tc_holidays', 'root', 'Newcastle251182');
        $connection = new PDO('mysql:host=localhost;dbname=tc_holidays', 'root', 'Newcastle251182');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        throw new Exception('Connection error '. $e->getMessage(), 0, $e);
    }
}
//Sessions
//Function to start sessions and set path
function setSessionPath(){
    $currentPath = getcwd();
    ini_set('session.save_path', $currentPath.'/sessionData');
    session_start();
}
//get input from form
function sanitise_input($var){
    $output = filter_has_var(INPUT_POST, $var) ? $_POST[$var] : null;
    $output = trim($output);
    $output = stripslashes($output);
    $output = htmlspecialchars($output);
    return $output;
}
//Start Webpage
function startHTML($title, $description){
  $content = <<< startHTML
  <!doctype html>
  <html lang='en'>
    <head>
        <meta charset='UTF-8'/>
        <meta name='description' content='$description'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$title</title>
        <link type="text/css" rel="stylesheet" href="css/lightslider.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/lightslider.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700&display=swap" rel="stylesheet">
        <link rel='stylesheet' type='text/css' href='css/style.css'>
    </head>
    <body>
startHTML;
  $content .= "\n";
  echo $content;
}
//Navigation
function makeHeader(){
  $content = <<< makeHEADER
  <header>
    <div id="floatingNav" class="widthWrap">
      <div class="logo">
        <h1><b>Travel</b> Co.</h1>
      </div>
      <nav>
        <a href='index.php'><h2 class="active">Homepage</h2></a>
        <a href='holidays.php'><h2>Holidays</h2></a>
        <a><h2>nav element</h2></a>
      </nav>
      <div id="login">
        <a><h2 class="active">Login</h2></a>
      </div>
    </div>
    <!-- Header Tagline -->
    <h1 class="cAlign tagline">Amazing travel deals<br>Youcant find anywhere else.</h1>
    <h2 class="cAlign">Where do you want to go?</h2>
    <!-- Header Search -->
    <div id="search" class="widthWrap">
      <input id="searchLocation" type="text" placeholder="Location"/>
      <input type="submit">
    </div>
  </header>
makeHEADER;
  $content .= "\n";
echo $content;
}
//Footer
function makeFooter(){
  $content = <<< makeFOOTER
  <footer>
    <footer>
      <h1 class="cAlign"><b>Travel</b> Co.</h1>
    </footer>
  </footer>
makeFOOTER;
  $content .= "\n";
  echo $content;
}
//endHTML
function endHTML(){
  $content = <<< endHTML
  </body>
</html>
endHTML;
  $content .= "\n";
  echo $content;
}

function holidaysJs(){

    echo "<script src='holidaysJs.js' type='text/javascript'</script>";
}

function avgRating($ratingCategory, $hotelID){
  //dbconn
  $dbConn = getConnection();
  //query for average by column name
  $getRatingAvg = "SELECT AVG($ratingCategory)
  FROM tc_reviews
  WHERE hotelID = '$hotelID'";
  $ratngAvg = $dbConn->query($getRatingAvg);
  $average = $ratngAvg->fetchColumn();
  $average = round($average);
  return $average;
}

function getStarImage($rating){
  switch ($rating) {
    case 1:
        echo "<img src='img/rating1.jpg' alt='1 Star'>";
        break;
    case 2:
        echo "<img src='img/rating2.jpg' alt='2 Stars'>";
        break;
    case 3:
        echo "<img src='img/rating3.jpg' alt='3 Stars'>";
        break;
    case 4:
        echo "<img src='img/rating4.jpg' alt='4 Stars'>";
        break;
    case 5:
        echo "<img src='img/rating5.jpg' alt='5 Stars'>";
        break;
    default:
        echo "<p> No Rating</p>";
  }
}
?>
