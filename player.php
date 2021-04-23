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
$userfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $Uploader ."'"); // calls for channel info
$udf = mysqli_fetch_assoc($userfetch);
if ($udf['isBanned'] == true AND $udf['bannedUntil'] > time()) {
	if(isset($_SESSION["username"])) {
		$result = mysqli_query($connect,"SELECT * FROM users WHERE `username` = '". $_SESSION["username"] ."'");
		$adf = mysqli_fetch_assoc($result);
		$admin = 0;
		if($adf['is_admin'] == 1 || $Uploader == $_SESSION["username"]) // is logged in?
		{
		$admin = 1;
		}
		else
		{
			include("header.php");
			echo "<div class='tableSubTitle'>403</div>
			Wow, just wow... Did you really try to bypass this video is uploaded by banned user error by loading up the player directly?";
			include("footer.php");
			die();
		}
	} else {
		include("header.php");
		echo "<div class='tableSubTitle'>403</div>
		Wow, just wow... Did you really try to bypass this video is uploaded by banned user error by loading up the player directly?";
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
  <body id="" class="date-20130415 en_US ltr   ytg-old-clearfix guide-feed-v2 site-left-aligned exp-new-site-width exp-watch7-comment-ui " dir="ltr">

  <div id="cued-embed" class="html5-video-player html5-autohide cued-mode video-content">

        
    <script id="js-914140142" src="/player_asset/www-embed-cued-vfl3Cfaol.js" data-loaded="true"></script>


  <script>
console.log("2013 player moment");

    yt.setConfig({
      'EMBED_BINARY_URL': "\/\/s.ytimg.com\/yts\/jsbin\/www-embed-vflqDUnF8.js",
      'POST_MESSAGE_ORIGIN': "*",

        'EVENT_ID': "LdZsUeaeDYenhAGBgoGADQ",

      'IS_OPERA_MINI': false
    });
    yt.setMsg({
      'FLASH_UPGRADE': '<div class=\"yt-alert yt-alert-default yt-alert-error  yt-alert-player\">  <div class=\"yt-alert-icon\">\n    <img src=\"\/\/s.ytimg.com\/yts\/img\/pixel-vfl3z5WfW.gif\" class=\"icon master-sprite\" alt=\"Alert icon\">\n  <\/div>\n<div class=\"yt-alert-buttons\"><\/div><div class=\"yt-alert-content\" role=\"alert\">    <span class=\"yt-alert-vertical-trick\"><\/span>\n    <div class=\"yt-alert-message\">\n            You need to upgrade your Adobe Flash Player to watch this video. <br> <a href=\"/web/20130416044013/http://get.adobe.com\/flashplayer\/\">Download it from Adobe.<\/a>\n    <\/div>\n<\/div><\/div>'
    });
      yt.setConfig({
      'PLAYER_CONFIG': {"html5": false, "assets": {"html": "\/html5_player_template", "css": "/web/20130416044013/http://s.ytimg.com\/yts\/cssbin\/www-player-vflpwefEm.css", "js": "/web/20130416044013/http://s.ytimg.com\/yts\/jsbin\/html5player-vflR_cX32.js"}, "sts": 1580, "min_version": "8.0.0", "url": "/web/20130416044013/http://s.ytimg.com\/yts\/swfbin\/watch_as3-vfl5qlEPI.swf", "args": {"iurlsd": "/web/20130416044013/http://i3.ytimg.com\/vi\/nKIu9yen5nc\/sddefault.jpg", "avg_rating": 4.87825333189, "enablejsapi": "0", "length_seconds": 344, "hl": "en_US", "is_html5_mobile_device": false, "rel": "1", "fexp": "901439,904824,900308,916626,913808,932000,932004,906383,916911,916910,924605,902000,901208,919512,929903,925714,931202,900821,900823,931203,906090,909419,908529,930807,919373,930803,906836,920201,929602,930101,930609,926403,900824", "cctp": 1, "allow_ratings": 1, "allow_embed": 1, "video_id": "nKIu9yen5nc", "sendtmp": "1", "iurl": "/web/20130416044013/http://i3.ytimg.com\/vi\/nKIu9yen5nc\/hqdefault.jpg", "view_count": 10228622, "share_icons": "/web/20130416044013/http://s.ytimg.com\/yts\/swfbin\/sharing-vflsBOuhL.swf", "sk": "2e7O1KWJxWh9VAo5Xso8POGNatyvyQWFC", "el": "embedded", "eurl": "/web/20130416044013/http://www.pbs.org\/newshour\/extra\/2013\/03\/techies-urge-kids-to-learn-code\/", "cr": "US", "playlist_module": "/web/20130416044013/http://s.ytimg.com\/yts\/swfbin\/playlist_module-vflzGeMnk.swf", "title": "What most schools don't teach"}, "url_v8": "/web/20130416044013/http://s.ytimg.com\/yts\/swfbin\/cps-vflrMbM76.swf", "attrs": {"width": "100%", "height": "100%", "id": "video-player"}, "url_v9as2": "/web/20130416044013/http://s.ytimg.com\/yts\/swfbin\/cps-vflrMbM76.swf", "params": {"allowscriptaccess": "always", "allowfullscreen": "true", "bgcolor": "#000000"}},
    'EMBED_HTML_TEMPLATE': "\u003ciframe width=\"__width__\" height=\"__height__\" src=\"__url__\" frameborder=\"0\" allowfullscreen\u003e\u003c\/iframe\u003e",
    'EMBED_HTML_URL': "/web/20130416044013/http://www.youtube.com\/embed\/__videoid__"
  });
    yt.setMsg('FLASH_UPGRADE', "\u003cdiv class=\"yt-alert yt-alert-default yt-alert-error  yt-alert-player\"\u003e  \u003cdiv class=\"yt-alert-icon\"\u003e\n    \u003cimg s\u0072c=\"\/\/s.ytimg.com\/yts\/img\/pixel-vfl3z5WfW.gif\" class=\"icon master-sprite\" alt=\"Alert icon\"\u003e\n  \u003c\/div\u003e\n\u003cdiv class=\"yt-alert-buttons\"\u003e\u003c\/div\u003e\u003cdiv class=\"yt-alert-content\" role=\"alert\"\u003e    \u003cspan class=\"yt-alert-vertical-trick\"\u003e\u003c\/span\u003e\n    \u003cdiv class=\"yt-alert-message\"\u003e\n            You need to upgrade your Adobe Flash Player to watch this video. \u003cbr\u003e \u003ca href=\"/web/20130416044013/http://get.adobe.com\/flashplayer\/\"\u003eDownload it from Adobe.\u003c\/a\u003e\n    \u003c\/div\u003e\n\u003c\/div\u003e\u003c\/div\u003e");
  yt.setMsg('PLAYER_FALLBACK', "The Adobe Flash Player or an HTML5 supported browser is required for video playback. \u003cbr\u003e \u003ca href=\"/web/20130416044013/http://get.adobe.com\/flashplayer\/\"\u003eGet the latest Flash Player\u003c\/a\u003e \u003cbr\u003e \u003ca href=\"\/html5\"\u003eLearn more about upgrading to an HTML5 browser\u003c\/a\u003e");
  yt.setMsg('QUICKTIME_FALLBACK', "The Adobe Flash Player or QuickTime is required for video playback. \u003cbr\u003e \u003ca href=\"/web/20130416044013/http://get.adobe.com\/flashplayer\/\"\u003eGet the latest Flash Player\u003c\/a\u003e \u003cbr\u003e \u003ca href=\"/web/20130416044013/http://www.apple.com\/quicktime\/download\/\"\u003eGet the latest version of QuickTime\u003c\/a\u003e");



      yt.embed.cued.writeCuedEmbed();
  </script>



</body>
</html>