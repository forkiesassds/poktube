<?php
include("db.php"); 
if (empty($_GET["v"])) {
	$vid = "";
} else {
	$vid = $_GET["v"];
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
	$VideoFile = $vdf['VideoFile'];
}
?>
<html>
<head>
<link href="main.css" rel="stylesheet" type="text/css"/> 
</head>
<body>
    <div class="videocontainer" oncontextmenu="return false;">
    </script>
    <div style="overflow:hidden">
    <video width="480" height="360" id="video_player" controls autoplay>
        <source src="./<?php echo $VideoFile; ?>">
		<embed type="application/x-mplayer2" src="./<?php echo $VideoFile; ?>" name="MediaPlayer" showcontrols="1" showstatusbar="1" width="480" height="360">
		We are not going to waste our fucking time on Flash Player. It's clunky, obsolete and fucking useless.
    </video>
    </div>
</div>
</body>
</html>
