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
    <?php if (($_GET["player"]) == 2) {
echo "<object id='MediaPlayer1' 
        CLASSID='CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95' 
        codebase='http://activex.microsoft.com/activex/controls/mplayer/ 
                  en/nsmp2inf.cab#Version=5,1,52,701'
        standby='Loading Microsoft Windows® Media Player components...'
        TYPE='application/x-oleobject'
        width='480'
        height='360'>
<param name='fileName' value='./$VideoFile'>
<param name='animationatStart' value='true'>
<param name='transparentatStart' value='true'>
<param name='autoStart' value='false'>
<param name='showControls' value='true'>
<param name='Volume' value='100'>
<embed type='application/x-mplayer2'
      id='myEmbededTag'
      pluginspage='http://www.microsoft.com/Windows/MediaPlayer/'
      src='./$VideoFile'
      name='MediaPlayer1'
      width=480
      height=360 
      autostart=1
      showcontrols=1
      volume=-20>
</object>";
} else {
	if (($_GET["player"]) == 1) {
echo "<embed name='player' width='480' height='360' id='player' src='player.swf' flashvars='video_id=$VideoFile' type='application/x-shockwave-flash' quality='high' bgcolor='#FFFFFF'>";
} else {
		if (($_GET["player"]) == 0) {
echo "<video width='480' height='360' id='video_player' controls autoplay>
        <source src='./$VideoFile'>
		If you're reading this, then your browser does not support the HTML5 video tag.
		<br>
		PokTube now supports ActiveX and Flash.
		<br>
		Replace the number 0 in your address bar with ethier the number 1 for Flash, or the number 2 for ActiveX.
    </video>";
} else {
if (($_GET["player"]) == null) {
echo "H";
} else {
	echo
	"SEX";
};
};
}
}
	?>
    </div>
</div>
</body>
</html>
