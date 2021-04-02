<?php
include("db.php"); 
ob_start();
if (empty($_GET["video_id"])) {
	$vid = "";
} else {
	$vid = $_GET["video_id"];
}

//if $vid is null then dont show anything
if ($vid == null) {
die();
}

$vidfetch = mysqli_query($connect, "SELECT * FROM videodb WHERE VideoID='". $vid ."'");
$vdf = mysqli_fetch_assoc($vidfetch);
//do not show anything if the video-stream dosent exist
if (!isset($vdf['VideoID'])) {
die(); // just dies
} else {
	$vid = $vdf['VideoFile'];
	echo $vid;
}
?>