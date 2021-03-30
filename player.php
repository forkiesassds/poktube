<?php
session_start();
include("db.php"); 
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . ":\/\/$_SERVER[HTTP_HOST]";
if(isset($_GET["v"])) {
$vid = htmlspecialchars($_GET["v"]);
}

//if $vid is null then dont show anything
if ($vid == null) {
die();
}
$vidfetch = mysqli_query($connect, "SELECT * FROM videodb WHERE VideoID='". $vid ."'");
$vdf = mysqli_fetch_assoc($vidfetch);
$Uploader = $vdf['Uploader'];
$isApproved = $vdf['isApproved'];
if ($isApproved != 1) {
	if(isset($_SESSION["username"])) {
		$result = mysqli_query($connect,"SELECT * FROM users WHERE `username` = '". $_SESSION["username"] ."'");
		$adf = mysqli_fetch_assoc($result);
		$admin = 0;
		if($adf['is_admin'] == 1 || $Uploader == $_SESSION["username"]) { // is logged in?
		$admin = 1;
		} else {
			include("header.php");
			echo "<div class='tableSubTitle'>403</div>
			Wow, just wow... Did you really try to bypass this video is private error by loading up the player directly?";
			include("footer.php");
			die();
		}
	} else {
		include("header.php");
		echo "<div class='tableSubTitle'>403</div>
		Wow, just wow... Did you really try to bypass this video is private error by loading up the player directly?";
		include("footer.php");
		die();
	}
}

$image = "content/thumbs/". $vid .".png"; // set this for thumbnail
$name = ""; // self-explanatory

$vidfetch = mysqli_query($connect, "SELECT * FROM videodb WHERE VideoID='". $vid ."'");
$vdf = mysqli_fetch_assoc($vidfetch);
//do not show anything if the video-stream dosent exist
if (isset($vdf['VideoName'])) {
$name = $vdf['VideoName'];
} else {
$name = "PLACEHOLDER";
}
?>
  <html lang="en" dir="ltr">

<head>

    <link rel="stylesheet" href="./player_asset/player.css">
  <style>
    @-o-viewport { width: device-width; }
    @-moz-viewport { width: device-width; }
    @-ms-viewport { width: device-width; }
    @-webkit-viewport { width: device-width; }
    @viewport { width: device-width; }
  </style>

  
</head>
  <body id="" class="date-20120609 en_US ltr ytg-old-clearfix " dir="ltr">

<div id="watch-longform-ad" class="hid">
  <div id="watch-longform-text">
Advertisement
  </div>
  <div id="watch-longform-ad-placeholder"><img src="" height="60" width="300"></div>
</div>



  <div id="player" class="light-theme full-frame"></div>

        
    <script src="./player_asset/embed.js" data-loaded="true"></script>


  <script>
console.log("2012 player loaded: by Crazy frog. Modified by Chaziz and Icanttellyou");
    yt.setMsg({
      'FLASH_UPGRADE': '<div class=\"yt-alert yt-alert-default yt-alert-error  yt-alert-player\"><div class=\"yt-alert-icon\"><img src=\"img\/pixel-vfl3z5WfW.gif\" class=\"icon master-sprite\" alt=\"Alert icon\"><\/div><div class=\"yt-alert-buttons\"><\/div><div class=\"yt-alert-content\" role=\"alert\">    <span class=\"yt-alert-vertical-trick\"><\/span>\n    <div class=\"yt-alert-message\">\n            You need to upgrade your Adobe Flash Player to watch this video. <br> <a href=\"http:\/\/get.adobe.com\/flashplayer\/\">Download it from Adobe.<\/a>\n    <\/div>\n<\/div><\/div>'
    });
      yt.setConfig({
      'PLAYER_CONFIG': {"assets": {"html": "\/html5_player_template", "css": "https:\/\/web.archive.org\/web\/20120609184833\/http:\/\/s.ytimg.com\/yt\/cssbin\/www-player-vflFpAOf-.css", "js": "<?php (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"?>\/player_asset\/html5player-vfljIEiND.js"}, "url": "https:\/\/web.archive.org\/web\/20120609184833\/http:\/\/s.ytimg.com\/yt\/swfbin\/watch_as3-vflpp9opi.swf", "min_version": "8.0.0", "args": {"el": "embedded", "fexp": "900064,907217,907335,921602,919306,919316,912804,913542,919324,912706", "is_html5_mobile_device": false, "length_seconds": 212, "allow_embed": 1, "tabsb": "1", "allow_ratings": 0, "hl": "en_US", "eurl": "", "iurl": "<?php echo $image; ?>", "view_count": 62280066, "title": "<?php echo $name; ?>", "avg_rating": 4.47379109953, "video_id": "<?php echo $vid; ?>", "sw": "1.0", "enablejsapi": "0", "sk": "MvZbizDv2TLFXP_7GPrvTX347OtEerznC", "advideo": "1", "rel": "1", "playlist_module": "https:\/\/web.archive.org\/web\/20120609184833\/http:\/\/s.ytimg.com\/yt\/swfbin\/playlist_module-vfl3lol2H.swf"}, "url_v9as2": "https:\/\/web.archive.org\/web\/20120609184833\/http:\/\/s.ytimg.com\/yt\/swfbin\/cps-vflNmVqFE.swf", "params": {"allowscriptaccess": "always", "allowfullscreen": "true", "bgcolor": "#000000"}, "attrs": {"width": "100%", "id": "video-player", "height": "100%"}, "url_v8": "https:\/\/web.archive.org\/web\/20120609184833\/http:\/\/s.ytimg.com\/yt\/swfbin\/cps-vflNmVqFE.swf", "html5": true},
    'EMBED_HTML_TEMPLATE': "\u003ciframe width=\"__width__\" height=\"__height__\" src=\"__url__\" frameborder=\"0\" allowfullscreen\u003e\u003c\/iframe\u003e",
    'EMBED_HTML_URL': "<?php echo $link;?>\/embed.php?v=__videoid__"
  });
    yt.setMsg('HTML5_DEFAULT_FALLBACK', "This video is currently unavailable.");
  yt.setMsg('FLASH_UPGRADE', "\u003cdiv class=\"yt-alert yt-alert-default yt-alert-error  yt-alert-player\"\u003e\u003cdiv class=\"yt-alert-icon\"\u003e\u003cimg s\u0072c=\"img\/pixel-vfl3z5WfW.gif\" class=\"icon master-sprite\" alt=\"Alert icon\"\u003e\u003c\/div\u003e\u003cdiv class=\"yt-alert-buttons\"\u003e\u003c\/div\u003e\u003cdiv class=\"yt-alert-content\" role=\"alert\"\u003e    \u003cspan class=\"yt-alert-vertical-trick\"\u003e\u003c\/span\u003e\n    \u003cdiv class=\"yt-alert-message\"\u003e\n            You need to upgrade your Adobe Flash Player to watch this video. \u003cbr\u003e \u003ca href=\"http:\/\/get.adobe.com\/flashplayer\/\"\u003eDownload it from Adobe.\u003c\/a\u003e\n    \u003c\/div\u003e\n\u003c\/div\u003e\u003c\/div\u003e");
  yt.setMsg('HTML5_NO_AVAILABLE_FORMATS_FALLBACK', "Your browser does not currently recognize any of the video formats available.\u003cbr\u003e\u003ca href=\"\/html5\"\u003eClick here to visit our frequently asked questions about HTML5 video.\u003c\/a\u003e");
  yt.setMsg('PLAYER_FALLBACK', "\u003cdiv class=\"yt-alert yt-alert-default yt-alert-error  yt-alert-player\"\u003e\u003cdiv class=\"yt-alert-icon\"\u003e\u003cimg s\u0072c=\"img\/pixel-vfl3z5WfW.gif\" class=\"icon master-sprite\" alt=\"Alert icon\"\u003e\u003c\/div\u003e\u003cdiv class=\"yt-alert-buttons\"\u003e\u003c\/div\u003e\u003cdiv class=\"yt-alert-content\" role=\"alert\"\u003e    \u003cspan class=\"yt-alert-vertical-trick\"\u003e\u003c\/span\u003e\n    \u003cdiv class=\"yt-alert-message\"\u003e\n            The Adobe Flash Player or an HTML5 supported browser is required for video playback. \u003cbr\u003e \u003ca href=\"http:\/\/get.adobe.com\/flashplayer\/\"\u003eGet the latest Flash Player\u003c\/a\u003e \u003cbr\u003e \u003ca href=\"\/html5\"\u003eLearn more about upgrading to an HTML5 browser\u003c\/a\u003e\n    \u003c\/div\u003e\n\u003c\/div\u003e\u003c\/div\u003e");
  yt.setMsg('QUICKTIME_FALLBACK', "\u003cdiv class=\"yt-alert yt-alert-default yt-alert-error  yt-alert-player\"\u003e\u003cdiv class=\"yt-alert-icon\"\u003e\u003cimg s\u0072c=\"img\/pixel-vfl3z5WfW.gif\" class=\"icon master-sprite\" alt=\"Alert icon\"\u003e\u003c\/div\u003e\u003cdiv class=\"yt-alert-buttons\"\u003e\u003c\/div\u003e\u003cdiv class=\"yt-alert-content\" role=\"alert\"\u003e    \u003cspan class=\"yt-alert-vertical-trick\"\u003e\u003c\/span\u003e\n    \u003cdiv class=\"yt-alert-message\"\u003e\n            The Adobe Flash Player or QuickTime is required for video playback. \u003cbr\u003e \u003ca href=\"http:\/\/get.adobe.com\/flashplayer\/\"\u003eGet the latest Flash Player\u003c\/a\u003e \u003cbr\u003e \u003ca href=\"http:\/\/www.apple.com\/quicktime\/download\/\"\u003eGet the latest version of QuickTime\u003c\/a\u003e\n    \u003c\/div\u003e\n\u003c\/div\u003e\u003c\/div\u003e");

  yt.setMsg('HTML5_SPEED_NORMAL', "Normal");
  yt.setMsg('HTML5_QUALITY_SETTING', "quality");
  yt.setMsg('HTML5_SPEED_SETTING', "speed");
  yt.setMsg('HTML5_VOLUME_SETTING', "volume");
  yt.setMsg('HTML5_VOLUME_MUTED', "muted");
  yt.setMsg('HTML5_VOLUME_MUTE', "mute");
  yt.setMsg('HTML5_VOLUME_UNMUTE', "unmute");
  yt.setMsg('HTML5_CONTROL_TOGGLE', "toggle");

  yt.setMsg('HTML5_SUBS_TRANSCRIBED', "transcribed");
  yt.setMsg('VISIT_ADVERTISERS_SITE', "Visit advertiser's site");
  yt.setMsg('FRESCA_COMPLETE_MESSAGE', "Thanks for watching!");
  yt.setMsg('FRESCA_STAND_BY_MESSAGE', "Please stand by.");



      yt.embed.writeEmbed();
  </script>



</body>
</html>