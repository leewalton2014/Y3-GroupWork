
<?php require_once"functions.php";
ini_set("session.save_path", "/home/unn_w15010508/sessionData");
session_start();


    $username = filter_has_var(INPUT_POST, 'username') ? $_POST ['username'] : null;
    $username = trim($username);
    $password = filter_has_var(INPUT_POST, 'password') ? $_POST ['password'] : null;
    $password = trim($password);

if(empty($username) || empty($password)){
    echo "";
    echo"";

}

$dbConn = getConnection();

$queorySQL = "SELECT passwordhash FROM nmc_users WHERE username = :username";
$stmt = $dbConn->prepare($queorySQL);
$stmt->execute(array(':username' => $username));
$user = $stmt->fetchobject();

if ($user) {

    $passwordHash = $user->passwordhash;
    if (password_verify($password, $passwordHash)) {

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['logged-in'] = true;

        header("Location:index.htm");
    }

} else {
    $message = "Username and/or Password incorrect.\\nTry again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
