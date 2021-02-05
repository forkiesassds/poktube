<?php
include("db.php"); 
if (empty($_GET["v"])) {
	$vid = "";
} else {
	$vid = $_GET["v"];
}


if (empty($_GET["activex"])) {
	echo "ActiveX";
} else {
	echo "HTML5";
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
    <?php if (isset($vdf['activex'])) {
echo "test"; // just dies
} else {
	echo
	"<video width='480' height='360' id='video_player' controls autoplay>
        <source src='./$VideoFile'>
		Error: HTML5 player hasen't loaded. If your browser supports ActiveX, then add &?activex==1 in the address bar
    </video>";
}
	?>
    </div>
</div>
</body>
</html>
