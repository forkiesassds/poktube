<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("db.php");
if(!isset($_GET["user"])){
	die('No username specified!');
} else {
	$user = $_GET["user"];
}
if(!isset($_SESSION['username'])) {
	die('You are not logged in!');
}
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $_SESSION['username'] ."'"); // calls for channel info
$cdf = mysqli_fetch_assoc($chanfetch);
$Subscriptions = $cdf['subscriptions'];
$learray = json_decode($Subscriptions);
if (in_array($user, $learray)) {
	die("<script>window.location = 'unsubscribe.php?user=".$user."'</script>");
}
if ($user == $_SESSION['username']) {
	die('Why are you trying to subscribe to yourself?');
}
if(!isset($Subscriptions) OR $Subscriptions == "") {
	$learray = array($user);
} else if(count(json_decode($Subscriptions)) == 0) {
	$learray = array($user);
} else {
	array_push($learray, $user);
}
$schanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $user ."'"); // calls for channel info
$scdf = mysqli_fetch_assoc($schanfetch);
$Subscribers = $scdf['subscribers'];
$jsoned = json_encode($learray);
$newsubs = $Subscribers + 1;
$suser = $_SESSION['username'];
$stmt = $connect->prepare("UPDATE users SET subscriptions=? WHERE Username=?");
$stmt->bind_param("ss", $jsoned, $suser);
$stmt->execute();
$stmt2 = $connect->prepare("UPDATE users SET subscribers=? WHERE Username=?");
$stmt2->bind_param("ss", $newsubs, $user);
$stmt2->execute();
echo "<script>window.history.back();</script>";
?>
