<?php
require_once __DIR__ . '/../../lib/BBCode/BBCode.php';
require_once __DIR__ . '/../../lib/BBCode/Tag.php';
include("header.php");
$share_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$embed_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/embed.php?v=".$_GET['v'];
if(!isset($_GET["v"])){
	die();
} else {
	$vid = $_GET["v"];
}

function limit_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$VideoName = "No title.";
$VideoDesc = "No description.";
$Uploader = "Unknown";
$UploadDate = "Unknown";
$loaded = 0;

function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}

function makeClickableLinksLimit($s) {
  return preg_replace('@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@', '<a href="$1" target="_blank">$1</a>', $s);
}

$vidfetch = mysqli_query($connect, "SELECT * FROM videodb WHERE VideoID='". $vid ."'");
$vdf = mysqli_fetch_assoc($vidfetch);
//do not show anything if the video dosent exist
if (!isset($vdf['VideoID'])) {
echo "<script>window.location.replace('/?vexist=0');</script>";
die();
} else {
$VideoID = $vdf['VideoID'];
}
if (isset($_COOKIE["watched"])) {
	$Watched = $_COOKIE["watched"];
} else {
	$Watched = "";
}
$learray = json_decode($Watched);
if ($learray == NULL) {
} else if (in_array($VideoID, $learray)) {
}
if(!isset($Watched) OR $Watched == "") {
	$learray = array($VideoID);
} else if(count(json_decode($Watched)) == 0) {
	$learray = array($VideoID);
} else {
	array_push($learray, $VideoID);
}
setcookie("watched", json_encode($learray), time() + 86400, "/");
$Uploader = htmlspecialchars($vdf['Uploader']); // get all video information
$LastWatched = htmlspecialchars($vdf['LastViewed']);
$VideoName = htmlspecialchars($vdf['VideoName']);
$ViewCount = $vdf['ViewCount'];
$PreUploadDate = htmlspecialchars($vdf['UploadDate']);
$VideoDesc = nl2br(htmlspecialchars($vdf['VideoDesc']));
$VideoCategory = htmlspecialchars($vdf['VideoCategory']);
$VideoFile = $vdf['VideoFile'];
$DateTime = new DateTime($PreUploadDate);
$length = 0;
if ($_COOKIE["im_not_curl"] == crypt($_SERVER['HTTP_USER_AGENT'], "coca cola espuma, i am death")) {
	if (isset($_COOKIE["watched"]) AND !in_array($VideoID, json_decode($_COOKIE["watched"]))) {
		$newview = $ViewCount + 1;
		$updateQuery = "UPDATE videodb SET ViewCount='". $newview ."' WHERE `VideoID`='". $VideoID ."'";
		mysqli_query($connect,$updateQuery);
	}
	$updateQuery = "UPDATE videodb SET LastViewed='".date('Y-m-d H:i:s')."' WHERE VideoID='". $VideoID ."'";
	mysqli_query($connect,$updateQuery);
}
if($vdf['VideoLength'] > 3600) {
	$length = floor($vdf['VideoLength'] / 3600) . ":" . gmdate("i:s", $vdf['VideoLength'] % 3600);
} else { 
	$length = gmdate("i:s", $vdf['VideoLength'] % 3600) ;
};
$isApproved = $vdf['isApproved'];
if ($isApproved != 1) {
	$result = mysqli_query($connect,"SELECT * FROM users WHERE `username` = '". $_SESSION["username"] ."'");
	$adf = mysqli_fetch_assoc($result);
	$admin = 0;
	if($adf['is_admin'] == 1 || $Uploader == $_SESSION["username"]) // is logged in?
	{
	$admin = 1;
	}
	else
	{
		echo "<script>window.location.replace('/?vexist=1');</script>";
		die();
	}
}
$userfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $Uploader ."'"); // calls for channel info
$udf = mysqli_fetch_assoc($userfetch);

if ($udf['isBanned'] == true AND $udf['bannedUntil'] > time()) {
	$result = mysqli_query($connect,"SELECT * FROM users WHERE `username` = '". $_SESSION["username"] ."'");
	$adf = mysqli_fetch_assoc($result);
	$admin = 0;
	if($adf['is_admin'] == 1 || $Uploader == $_SESSION["username"]) // is logged in?
	{
	$admin = 1;
	}
	else
	{
		echo "<script>window.location.replace('/?vexist=2');</script>";
		die();
	}
}

if(isset($_SESSION["username"])){
$localfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $_SESSION["username"] ."'"); // calls for channel info
$ldf = mysqli_fetch_assoc($localfetch);

$vidnew = $ldf["videos_watched"] + 1;

$updateQuery = "UPDATE users SET videos_watched='". $vidnew ."' WHERE username='". $_SESSION["username"] ."'";
mysqli_query($connect,$updateQuery);
}
$PreRegisteredOn = $udf['registeredon'];
$DateTime2 = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime2->format('F j, Y');
$UploadDate = $DateTime->format('F j, Y');

$sql= mysqli_query($connect, "SELECT * FROM comments ORDER BY commentid DESC");

$commentcount = 0;

if(!$VideoDesc) {
	$VideoDesc = "<i>No description...</i>";
}

$commentcount = 0;

while ($searchcomments = mysqli_fetch_assoc($sql)) { // get comments for video
$usercommentlist = htmlspecialchars($searchcomments['user']); // commente
$datecommentlist = $searchcomments['date']; // comment date
$messagecommentlist = htmlspecialchars($searchcomments['comment']); // actual text for comment
$idcommentlist = $searchcomments['id']; // comment id, to get descending order to work
$hidden = $searchcomments['hidden']; // hidden comments are for deleted videos

if ($idcommentlist == $vid AND $hidden != 1) {
$commentcount++; // count the amount of comments
}

$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $Uploader ."'"); // calls for channel info
$cdf = mysqli_fetch_assoc($chanfetch);
$LastestVideo = htmlspecialchars($cdf['recent_vid']);
$Username = htmlspecialchars($cdf['username']);
$AboutMe = htmlspecialchars($cdf['aboutme']);
$VidsWatched = $cdf['videos_watched'];
$Name = htmlspecialchars($cdf['prof_name']);
$Age = htmlspecialchars($cdf['prof_age']);
$City = htmlspecialchars($cdf['prof_city']);
$Hometown = htmlspecialchars($cdf['prof_hometown']);
$Country = htmlspecialchars($cdf['prof_country']);
$Foreground = htmlspecialchars($cdf['channel_color']);
$Subs = htmlspecialchars($cdf['subscribers']);
$Background = htmlspecialchars($cdf['channel_bg']);
$PreRegisteredOn = $cdf['registeredon'];
$DateTime = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime->format('F j Y');
$RegisteredYear = $DateTime->format('Y');
}
?>
<main class="bottom_wrapper">
<style>
	#vtbl_pl,
	#vtbl_actions,
	#vtbl_desc {
		display:inline-block;
		vertical-align:top;
	}
	
	#vtbl {
		width: 640px;
	}
	
	#vtbl_pl,
	#vtbl_actions {
		width:640px;
		margin-right:20px;
		overflow:hidden;
	}
	
	#vtbl_pl {
		height:360px;
	}
	
	#vtbl_desc {
		width:340px;
		float:right;
	}
	
	#vtbl.expanded #vtbl_pl {
		width:1000px;
		height:563px;
		margin-right:0;
	}
	
	#vtbl.expanded #vtbl_desc {
		margin-top:11px;
	}
</style>
<div class="w_title">
<h1><?php echo $VideoName;?></h1>
</div>
<div id="vtbl" class="">
<iframe src='/player.php?v=<?php echo $vid ?>' width='640px' height='392px' frameBorder='0' scrolling='no' debug='true'></iframe>
</div><div id="vtbl_desc">
<div class="wt_des" style=""> <div> <a href="/user/AnthonyGiarrusso"><img src='/content/profpic/<?php echo $Uploader;?>.png' onerror="this.src='/img/profiledef.png'" class="avt2 " alt="<?php echo $Uploader;?>" width="55" height="55"></a> <div class="wt_person"> <a href="/user/AnthonyGiarrusso"><?php echo $Uploader;?></a><br> Apr 18, 2021<br> (<a href="javascript:void(0)" id="show_more">more info</a>) </div> <div id="subsbtns"> <a href="javascript:void(0)" class="yel_btn" onclick="alert('You must be logged in to subscribe!')">Subscribe</a> <a href="/user/AnthonyGiarrusso/subscribers" class="yel_btn"><?php echo $Subs;?></a> </div> </div> <div class="cl"></div> <div id="des_text" style="max-height:84px">
<?php echo $VideoDesc;?> </div> <div id="des_info" class="hddn"> <div> <div>Category: </div> <div> <a href="/videos?c=10&amp;o=re&amp;t=2">Entertainment</a></div> </div> <div class="cl"></div> <div> <div>Tags:</div> <div style="width: 281px"> <a href="/results?q=Anthony+Giarrusso+blessed+with+888+friends+4+17+2021">Anthony Giarrusso blessed with 888 friends 4 17 2021</a> <a href="/results?q=AnthonyGiarrusso">AnthonyGiarrusso</a> <a href="/results?q=Anthony+Giarrusso">Anthony Giarrusso</a> <a href="/results?q=888">888</a> <a href="/results?q=888+friends+Vidlii">888 friends Vidlii</a> <a href="/results?q="></a> </div> </div> </div> <div> <table> <tbody><tr> <td align="right"><label for="em">Embed</label></td> <td><input type="text" id="em" onclick="$(this).select()" readonly="" value="<iframe allowfullscreen src=&quot;https://www.vidlii.com/embed?v=XAK5cPyquPW&amp;a=1&quot; frameborder=&quot;0&quot; width=&quot;640&quot; height=&quot;360&quot;></iframe>"></td> </tr> </tbody></table> </div></div>
<div class="u_sct" style="margin:0 0 10px">
<img src="https://i.r.worldssl.net/img/clp00.png">
<span class="u_sct_hd" style="font-size: 17px;position:relative;top:1px;left:5px">More From: AnthonyGiarrusso</span>
</div>
<div class="w_videos" style="display:none">
<div>
<div>
<div class="th">
<div class="th_t">14:12</div>
<a href="/watch?v=15e0L4BuLcd"><img class="vid_th" src="/usfi/thmp/15e0L4BuLcd.jpg" alt="Drone UFO Seen By Anthony Giarrusso" title="Drone UFO Seen By Anthony Giarrusso" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=15e0L4BuLcd" class="ln2">Drone UFO Seen By Anthony Giarrusso</a>
<span class="vw s">14 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">3:23</div>
<a href="/watch?v=unkNIn7b-8J"><img class="vid_th" src="/usfi/thmp/unkNIn7b-8J.jpg" alt="Anthony Giarrusso Funny Moments" title="Anthony Giarrusso Funny Moments" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=unkNIn7b-8J" class="ln2">Anthony Giarrusso Funny Moments</a>
<span class="vw s">7 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">2:33</div>
<a href="/watch?v=i8o6a6eovMu"><img class="vid_th" src="/usfi/thmp/i8o6a6eovMu.jpg" alt="Eat Dogs Eat Bats" title="Eat Dogs Eat Bats" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=i8o6a6eovMu" class="ln2">Eat Dogs Eat Bats</a>
<span class="vw s">42 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">7:07</div>
<a href="/watch?v=TjcghLTifxU"><img class="vid_th" src="/usfi/thmp/TjcghLTifxU.jpg" alt="Time Efficiency 2019 Anthony Giarrusso" title="Time Efficiency 2019 Anthony Giarrusso" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=TjcghLTifxU" class="ln2">Time Efficiency 2019 Anthony Giarrusso</a>
<span class="vw s">20 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">9:50</div>
<a href="/watch?v=Z0GvyN3zcDZ"><img class="vid_th" src="/usfi/thmp/Z0GvyN3zcDZ.jpg" alt="Skeptics Inversion Of Reality" title="Skeptics Inversion Of Reality" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=Z0GvyN3zcDZ" class="ln2">Skeptics Inversion Of Reality</a>
<span class="vw s">14 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">5:59</div>
<a href="/watch?v=NrW-GgQ9gjF"><img class="vid_th" src="/usfi/thmp/NrW-GgQ9gjF.jpg" alt="100 Subscribers Vidlii Anthony Giarrusso" title="100 Subscribers Vidlii Anthony Giarrusso" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=NrW-GgQ9gjF" class="ln2">100 Subscribers Vidlii Anthony Giarrusso</a>
<span class="vw s">14 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">3:43</div>
<a href="/watch?v=0HkI4P_JPsZ"><img class="vid_th" src="/usfi/thmp/0HkI4P_JPsZ.jpg" alt="Anthony Giarrusso Catches Youtube In Censorship Scam" title="Anthony Giarrusso Catches Youtube In Censorship Scam" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=0HkI4P_JPsZ" class="ln2">Anthony Giarrusso Catches Youtube In Censorship Scam</a>
<span class="vw s">10 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">3:22</div>
<a href="/watch?v=kulj1p27qYt"><img class="vid_th" src="/usfi/thmp/kulj1p27qYt.jpg" alt="YouTube Censorship" title="YouTube Censorship" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=kulj1p27qYt" class="ln2">YouTube Censorship</a>
<span class="vw s">9 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">7:37</div>
<a href="/watch?v=oa6rGAGWq3m"><img class="vid_th" src="/usfi/thmp/oa6rGAGWq3m.jpg" alt="Globalist Censorship Attack" title="Globalist Censorship Attack" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=oa6rGAGWq3m" class="ln2">Globalist Censorship Attack</a>
<span class="vw s">54 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/half_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">16:16</div>
<a href="/watch?v=soVqMgNHJJr"><img class="vid_th" src="/usfi/thmp/soVqMgNHJJr.jpg" alt="What Students Can Do" title="What Students Can Do" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=soVqMgNHJJr" class="ln2">What Students Can Do</a>
<span class="vw s">66 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">4:39</div>
<a href="/watch?v=ZHT8we6h6Dy"><img class="vid_th" src="/usfi/thmp/ZHT8we6h6Dy.jpg" alt="Nero Promises AG REMIX" title="Nero Promises AG REMIX" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=ZHT8we6h6Dy" class="ln2">Nero Promises AG REMIX</a>
<span class="vw s">15 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">3:07</div>
<a href="/watch?v=_aqxvs7RZ5X"><img class="vid_th" src="/usfi/thmp/_aqxvs7RZ5X.jpg" alt="Diamond Clouds DJ GT Remix" title="Diamond Clouds DJ GT Remix" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=_aqxvs7RZ5X" class="ln2">Diamond Clouds DJ GT Remix</a>
<span class="vw s">19 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">2:24</div>
<a href="/watch?v=lsTC-LnTg9P"><img class="vid_th" src="/usfi/thmp/lsTC-LnTg9P.jpg" alt="Wonders of Anthony Giarrusso What is it" title="Wonders of Anthony Giarrusso What is it" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=lsTC-LnTg9P" class="ln2">Wonders of Anthony Giarrusso What is it</a>
<span class="vw s">11 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">0:16</div>
<a href="/watch?v=RjV-LsLiYIf"><img class="vid_th" src="/usfi/thmp/RjV-LsLiYIf.jpg" alt="Waterfall Drooling Meme Nia DearS" title="Waterfall Drooling Meme Nia DearS" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=RjV-LsLiYIf" class="ln2">Waterfall Drooling Meme Nia DearS</a>
<span class="vw s">13 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">2:46</div>
<a href="/watch?v=bD89D_oZZpO"><img class="vid_th" src="/usfi/thmp/bD89D_oZZpO.jpg" alt="All Night King Anthony Remix" title="All Night King Anthony Remix" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=bD89D_oZZpO" class="ln2">All Night King Anthony Remix</a>
<span class="vw s">10 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">3:05</div>
<a href="/watch?v=lR0J9r54EMG"><img class="vid_th" src="/usfi/thmp/lR0J9r54EMG.jpg" alt="All Night AMG REMIX" title="All Night AMG REMIX" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=lR0J9r54EMG" class="ln2">All Night AMG REMIX</a>
<span class="vw s">15 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">0:26</div>
<a href="/watch?v=y8adO5JQII8"><img class="vid_th" src="/usfi/thmp/y8adO5JQII8.jpg" alt="Where Can We Find Anthony Giarrusso Vidlii Metacafe" title="Where Can We Find Anthony Giarrusso Vidlii Metacafe" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=y8adO5JQII8" class="ln2">Where Can We Find Anthony Giarrusso Vidlii Metacafe</a>
<span class="vw s">57 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">5:24</div>
<a href="/watch?v=YSfDSSbrgQi"><img class="vid_th" src="/usfi/thmp/YSfDSSbrgQi.jpg" alt="EVPs Mentioning Jesus Ghost Spirit Angel Voices EVP" title="EVPs Mentioning Jesus Ghost Spirit Angel Voices EVP" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=YSfDSSbrgQi" class="ln2">EVPs Mentioning Jesus Ghost Spirit Angel Voices EVP</a>
<span class="vw s">20 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">10:53</div>
<a href="/watch?v=nYlhB5aTikB"><img class="vid_th" src="/usfi/thmp/nYlhB5aTikB.jpg" alt="Note Taking" title="Note Taking" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=nYlhB5aTikB" class="ln2">Note Taking</a>
<span class="vw s">26 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">1:05</div>
<a href="/watch?v=bxoIjZ-qcnn"><img class="vid_th" src="/usfi/thmp/bxoIjZ-qcnn.jpg" alt="Need For Speed Real Life" title="Need For Speed Real Life" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=bxoIjZ-qcnn" class="ln2">Need For Speed Real Life</a>
<span class="vw s">36 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
</div>
</div>
<div class="u_sct">
<img src="https://i.r.worldssl.net/img/clp11.png">
<span class="u_sct_hd" style="font-size: 17px;position:relative;top:1px;left:5px">Related Videos</span>
</div>
<div class="w_videos" style="display:block">
<div>
<div>
<div class="th">
<div class="th_t">0:43</div>
<a href="/watch?v=XE6CKNRNp2k"><img class="vid_th" src="/usfi/thmp/XE6CKNRNp2k.jpg" alt="Jesus Approves Of Vidlii" title="Jesus Approves Of Vidlii" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=XE6CKNRNp2k" class="ln2">Jesus Approves Of Vidlii</a>
<span class="vw s">11,860 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">5:22</div>
<a href="/watch?v=zGsBLnUscCM"><img class="vid_th" src="/usfi/thmp/zGsBLnUscCM.jpg" alt="Okochonka" title="Okochonka" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=zGsBLnUscCM" class="ln2">Okochonka</a>
<span class="vw s">2,494 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">1:55</div>
<a href="/watch?v=6iBitlwudjr"><img class="vid_th" src="/usfi/thmp/6iBitlwudjr.jpg" alt="SEVENTH HAVEN (game size) ♥ English Cover【rachie】" title="SEVENTH HAVEN (game size) ♥ English Cover【rachie】" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=6iBitlwudjr" class="ln2">SEVENTH HAVEN (game size) ♥ English Cover【rachie】</a>
<span class="vw s">2,972 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">2:38</div>
<a href="/watch?v=PlV2cAO9kf1"><img class="vid_th" src="/usfi/thmp/PlV2cAO9kf1.jpg" alt="Teenage Mutant Ninja Turtles Intro Animated with Mario Paint by Mike Matei" title="Teenage Mutant Ninja Turtles Intro Animated with Mario Paint by Mike Matei" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=PlV2cAO9kf1" class="ln2">Teenage Mutant Ninja Turtles Intro Animated with Mario Paint by Mike Matei</a>
<span class="vw s">10,730 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">11:04</div>
<a href="/watch?v=1xvtGCqNyYb"><img class="vid_th" src="/usfi/thmp/1xvtGCqNyYb.jpg" alt="The Annoying Collab (100 Subscriber Special)" title="The Annoying Collab (100 Subscriber Special)" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=1xvtGCqNyYb" class="ln2">The Annoying Collab (100 Subscriber Special)</a>
<span class="vw s">1,623 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">6:35</div>
<a href="/watch?v=EDQMTjh6vnH"><img class="vid_th" src="/usfi/thmp/EDQMTjh6vnH.jpg" alt="NFKRZ Comes To Vidlii - My Thoughts" title="NFKRZ Comes To Vidlii - My Thoughts" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=EDQMTjh6vnH" class="ln2">NFKRZ Comes To Vidlii - My Thoughts</a>
<span class="vw s">2,586 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">23:22</div>
<a href="/watch?v=XeYhOKUV7sG"><img class="vid_th" src="/usfi/thmp/XeYhOKUV7sG.jpg" alt="Evangelion Capitulo 17 (Español Latino)" title="Evangelion Capitulo 17 (Español Latino)" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=XeYhOKUV7sG" class="ln2">Evangelion Capitulo 17 (Español Latino)</a>
<span class="vw s">4,628 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">8:19</div>
<a href="/watch?v=6wEZUI26GTK"><img class="vid_th" src="/usfi/thmp/6wEZUI26GTK.jpg" alt="Bennybud - The BEST Troll on Vidlii" title="Bennybud - The BEST Troll on Vidlii" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=6wEZUI26GTK" class="ln2">Bennybud - The BEST Troll on Vidlii</a>
<span class="vw s">768 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">2:59</div>
<a href="/watch?v=rndP2IIYkAa"><img class="vid_th" src="/usfi/thmp/rndP2IIYkAa.jpg" alt="History of VidLiis UI in 3 Minutes (If You Knew Nothing About It)" title="History of VidLiis UI in 3 Minutes (If You Knew Nothing About It)" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=rndP2IIYkAa" class="ln2">History of VidLii's UI in 3 Minutes (If You Knew Nothing About It)</a>
<span class="vw s">4,381 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">4:24</div>
<a href="/watch?v=914PhJ3Zbhp"><img class="vid_th" src="/usfi/thmp/914PhJ3Zbhp.jpg" alt="Joe Stalin Anamorphic-1" title="Joe Stalin Anamorphic-1" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=914PhJ3Zbhp" class="ln2">Joe Stalin Anamorphic-1</a>
<span class="vw s">394 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">3:28</div>
<a href="/watch?v=Y2hGvll4xWD"><img class="vid_th" src="/usfi/thmp/Y2hGvll4xWD.jpg" alt="Username 666 on VidLii [HD]" title="Username 666 on VidLii [HD]" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=Y2hGvll4xWD" class="ln2">Username 666 on VidLii [HD]</a>
<span class="vw s">3,377 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">1:19</div>
<a href="/watch?v=iafQhGRTdOa"><img class="vid_th" src="/usfi/thmp/iafQhGRTdOa.jpg" alt="VidLii 2.0 Details" title="VidLii 2.0 Details" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=iafQhGRTdOa" class="ln2">VidLii 2.0 Details</a>
<span class="vw s">2,301 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
<div>
<div class="th">
<div class="th_t">10:32</div>
<a href="/watch?v=RmMcpZNHf4c"><img class="vid_th" src="/usfi/thmp/RmMcpZNHf4c.jpg" alt="Rescued! | Hanazuki Ep#25 EXCLUSIVE Full Episode" title="Rescued! | Hanazuki Ep#25 EXCLUSIVE Full Episode" width="121" height="78"></a>
</div>
<div>
<a href="/watch?v=RmMcpZNHf4c" class="ln2">'Rescued!' | Hanazuki Ep#25 EXCLUSIVE Full Episode</a>
<span class="vw s">481 views</span><br>
<img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="14"> </div>
</div>
</div>
</div>
</div>
<div id="vtbl_actions">
<div class="w_actions">
<div id="rateYo" class="jq-ry-container" style="width: 95px;" readonly="readonly"><div class="jq-ry-group-wrapper"><div class="jq-ry-normal-group jq-ry-group"><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#c7c7c7"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#c7c7c7" style="margin-left: 0px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#c7c7c7" style="margin-left: 0px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#c7c7c7" style="margin-left: 0px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#c7c7c7" style="margin-left: 0px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg></div><div class="jq-ry-rated-group jq-ry-group" style="width: 100%;"><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#E74C3C"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#E74C3C" style="margin-left: 0px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#E74C3C" style="margin-left: 0px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#E74C3C" style="margin-left: 0px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg><!--?xml version="1.0" encoding="utf-8"?--><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" width="19px" height="19px" fill="#E74C3C" style="margin-left: 0px;"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "></polygon></svg></div></div></div>
<div id="ratings">1 rating</div>
<div class="w_views"><strong>26</strong> views</div>
<script>
                                        $(function () {
                        $("#rateYo").rateYo({
                            ratedFill: "#E74C3C",
                            normalFill: "#c7c7c7",
                            fullStar: true,
                            starWidth: "19px",
                                                        rating: 5,
                                                        readOnly: true
                                                    });

                        
                                                $("#rateYo").click(function() {
                            alert("You must be logged in to rate videos!");
                        });
                                            });
                    				</script>
<div class="w_lnks">
<a href="javascript:void(0)" onmouseenter="wn('w_sh')" onmouseleave="wl('w_sh')" onclick="wc('w_sh')"><img src="https://i.r.worldssl.net/img/shhd1.png" id="w_sh"><span style="top:2px">Share</span></a><a href="javascript:void(0)" onmouseenter="wn('w_fv')" onmouseleave="wl('w_fv')" onclick="wc('w_fv')"><img src="https://i.r.worldssl.net/img/hehd0.png" id="w_fv"><span>Favorite</span></a><a href="javascript:void(0)" onmouseenter="wn('w_pl')" onmouseleave="wl('w_pl')" onclick="wc('w_pl')"><img src="https://i.r.worldssl.net/img/plhd0.png" id="w_pl"><span>Playlists</span></a><a href="javascript:void(0)" onmouseenter="wn('w_fl')" onmouseleave="wl('w_fl')" onclick="wc('w_fl')"><img src="https://i.r.worldssl.net/img/flhd0.png" id="w_fl"><span>Flag</span></a>
</div>
<div id="w_l_cnts">
<img src="https://i.r.worldssl.net/img/wse.png" id="w_sel" style="left:84px">
<div id="w_sh_cnt">
<span><a href="https://www.facebook.com/sharer/sharer.php?u=https%3A//www.vidlii.com/watch?v=XAK5cPyquPW" target="_blank" onclick="playerInstance.pause(true)">Facebook</a></span><span><a href="https://twitter.com/home?status=I%20just%20watched%20this%20awesome%20video%3A%20https%3A//www.vidlii.com/watch?v=XAK5cPyquPW" target="_blank" onclick="playerInstance.pause(true)">Twitter</a></span><span><a href="https://www.reddit.com/submit?url=https://www.vidlii.com/watch?v=XAK5cPyquPW&amp;title=Anthony+Giarrusso+blessed+with+888+friends+4+17+2021" target="_blank" onclick="playerInstance.pause(true)">Reddit</a></span>
</div>
<div id="w_fv_cnt" class="hddn">
<div class="you_wnt">
<div>
<strong>Want to add this video to your favorites?</strong><br>
<strong><a href="/login">Sign in to VidLii now!</a></strong>
</div>
</div>
</div>
<div id="w_pl_cnt" class="hddn">
<div class="you_wnt">
<div>
<strong>Want to add this video to your playlists?</strong><br>
<strong><a href="/login">Sign in to VidLii now!</a></strong>
</div>
</div>
</div>
<div id="w_fl_cnt" class="hddn">
<div class="you_wnt">
<div>
<strong>Want to add flag this video?</strong><br>
<strong><a href="/login">Sign in to VidLii now!</a></strong>
</div>
</div>
<script async="">setTimeout(function(){$.ajax({type:"POST",url:"/ajax/aw",data:{u:'XAK5cPyquPW',a:'https://www.vidlii.com/watch?v=XAK5cPyquPW'}})},1750);</script>
 </div>
</div>
</div>
<div style="width:468px;margin:8px auto">
<script async="" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8433080377364721" data-ad-slot="6350738097" data-ad-format="auto" data-full-width-responsive="true"></ins>
<script>
					 (adsbygoogle = window.adsbygoogle || []).push({});
				</script>
</div>
<div class="w_btm">
<div style="display:table;width:100%">
<div class="w_big_btn big_sel" id="w_com">
<a href="javascript:void(0)">Commentary</a>
</div>
<div class="w_big_btn" id="w_stats">
<a href="javascript:void(0)">Statistics</a>
</div>
</div>
<div class="cl"></div>
<div id="w_com_sct">
<div class="u_sct">
<img src="https://i.r.worldssl.net/img/clp00.png">
<span class="u_sct_hd">Video Responses <span>(<span>0</span>)</span></span>
<a href="/login" onclick="event.stopPropagation()">Sign in to make a video response</a> </div>
<div style="display:none;margin-bottom:20px">
<div style="text-align:center;margin-top:22px">This video doesn't have any video responses!</div>
</div>
<div class="u_sct">
<img src="https://i.r.worldssl.net/img/clp11.png">
<span class="u_sct_hd">Text Comments <span>(<span id="cmt_num">4</span>)</span></span>
<a href="/login" onclick="event.stopPropagation()">Sign in to post a comment</a> </div>
<div style="display:block; word-wrap: break-word">
<div id="top_comments">
<div class="wt_c_sct" id="wt_313588">
<div style="background:#cfffc4">
<a href="/user/AnthonyGiarrusso">AnthonyGiarrusso</a> <span>(2 days ago)</span>
</div>
<div>
<a href="/user/AnthonyGiarrusso"><img src="https://www.vidlii.com/usfi/avt/gI0PhwqTwZC.jpg" class="avt2 wp_avt" alt="AnthonyGiarrusso" width="41" height="41"></a> <div>
<span style="color:green">3</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div>
888 Friends on Vidlii! Wow! How did I achieve such a success? </div>
</div>
</div>
<div class="wt_c_sct" id="wt_313589">
<div style="background:#cfffc4">
<a href="/user/TristanElliotWebster">TristanElliotWebster</a> <span>(2 days ago)</span>
</div>
<div>
<a href="/user/TristanElliotWebster"><img src="https://www.vidlii.com/usfi/avt/2aSDMoVExH0.jpg" class="avt2 wp_avt" alt="TristanElliotWebster" width="41" height="41"></a> <div>
<span style="color:green">3</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div>
I saw me in the thumbnail and I changed my username just you know. </div>
</div>
</div>
</div>
<div id="video_comments_section">
<div class="wt_c_sct" id="wt_313593">
<div>
<a href="/user/TonyTurismo">TonyTurismo</a> <span>(2 days ago)</span>
<div>
</div>
</div>
<div>
<a href="/user/TonyTurismo"><img src="https://www.vidlii.com/usfi/avt/sqBZA1769k6.jpg" class="avt2 wp_avt" alt="TonyTurismo" width="41" height="41"></a> <div>
<span style="color:green">1</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div>
<a href="/user/AnthonyGiarrusso">@AnthonyGiarrusso</a> Keep up the great achievements hotshot! </div>
</div>
</div>
<div class="wt_c_sct" id="wt_313591">
<div style="background:#fffcc2">
<a href="/user/AnthonyGiarrusso">AnthonyGiarrusso</a> <span>(2 days ago)</span>
<div>
</div>
</div>
<div>
<a href="/user/AnthonyGiarrusso"><img src="https://www.vidlii.com/usfi/avt/gI0PhwqTwZC.jpg" class="avt2 wp_avt" alt="AnthonyGiarrusso" width="41" height="41"></a> <div>
<span style="color:green">2</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div>
It happened on 4/17/2021! </div>
</div>
</div>
<div class="wt_c_sct" id="wt_313589">
<div>
<a href="/user/TristanElliotWebster">TristanElliotWebster</a> <span>(2 days ago)</span>
<div>
</div>
</div>
<div>
<a href="/user/TristanElliotWebster"><img src="https://www.vidlii.com/usfi/avt/2aSDMoVExH0.jpg" class="avt2 wp_avt" alt="TristanElliotWebster" width="41" height="41"></a> <div>
<span style="color:green">3</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div>
I saw me in the thumbnail and I changed my username just you know. </div>
</div>
</div>
<div class="wt_c_sct wt_r_sct" id="wt_313590" op="313589" data-op-user="AnthonyGiarrusso">
<div style="background:#fffcc2">
<a href="/user/AnthonyGiarrusso">AnthonyGiarrusso</a> <span>(2 days ago)</span>
<div>
</div>
</div>
<div>
<a href="/user/AnthonyGiarrusso"><img src="https://www.vidlii.com/usfi/avt/gI0PhwqTwZC.jpg" class="avt2 wp_avt" alt="AnthonyGiarrusso" width="41" height="41"></a> <div>
<span style="color:green">2</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div style="width:442px">
<a href="/user/TristanElliotWebster">@TristanElliotWebster</a> Okay! </div>
</div>
</div>
<div class="wt_c_sct" id="wt_313588">
<div style="background:#fffcc2">
<a href="/user/AnthonyGiarrusso">AnthonyGiarrusso</a> <span>(2 days ago)</span>
<div>
</div>
</div>
<div>
<a href="/user/AnthonyGiarrusso"><img src="https://www.vidlii.com/usfi/avt/gI0PhwqTwZC.jpg" class="avt2 wp_avt" alt="AnthonyGiarrusso" width="41" height="41"></a> <div>
<span style="color:green">3</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div>
888 Friends on Vidlii! Wow! How did I achieve such a success? </div>
</div>
</div>
<a href="javascript:void(0)" class="show_more" onclick="show_all_replies(313588)" id="sa_313588">Show all 3 replies</a>
<div class="wt_c_sct wt_r_sct" id="wt_313594" op="313588" data-op-user="TonyTurismo">
<div>
<a href="/user/TonyTurismo">TonyTurismo</a> <span>(2 days ago)</span>
<div>
</div>
</div>
<div>
<a href="/user/TonyTurismo"><img src="https://www.vidlii.com/usfi/avt/sqBZA1769k6.jpg" class="avt2 wp_avt" alt="TonyTurismo" width="41" height="41"></a> <div>
<span style="color:green">1</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div style="width:442px">
<a href="/user/TristanElliotWebster">@TristanElliotWebster</a> Everyone agrees accept for the trolls. Do trolls opinions matter. No, not really. </div>
</div>
</div>
<div class="wt_c_sct wt_r_sct" id="wt_313595" op="313588" data-op-user="tweb712">
<div>
<a href="/user/TristanElliotWebster">TristanElliotWebster</a> <span>(2 days ago)</span>
<div>
</div>
</div>
<div>
<a href="/user/TristanElliotWebster"><img src="https://www.vidlii.com/usfi/avt/2aSDMoVExH0.jpg" class="avt2 wp_avt" alt="TristanElliotWebster" width="41" height="41"></a> <div>
<span>0</span>
<img src="https://i.r.worldssl.net/img/td0.png" onclick="alert('Please sign in to rate this comment')"><img src="https://i.r.worldssl.net/img/tu0.png" onclick="alert('Please sign in to rate this comment')"> </div>
<div style="width:442px">
<a href="/user/TonyTurismo">@TonyTurismo</a> That's right trolls opinions don't matter. </div>
</div>
</div>
</div>
<div style="text-align:center;margin: 13px 0 5px">
<a href="/register">Sign up</a> for a free account, or <a href="/login">sign in</a> to post a comment.
</div>
</div>
</div>
<div id="w_stats_sct" class="hddn">
<table style="width:88%;margin:0 0 0 61px" cellpadding="5">
<tbody><tr>
<td>Date: <strong><date>Apr 18, 2021</date></strong></td>
<td>Views: <strong>26</strong></td>
<td>Ratings: <strong>1</strong></td>
</tr>
<tr>
<td>Time: <strong><time>04:27 AM</time></strong></td>
<td>Comments: <strong>4</strong></td>
<td>Favorites: <strong>1</strong></td>
</tr>
</tbody></table>
</div>
</div>
<div style="width:468px;margin:8px auto">
<script async="" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8433080377364721" data-ad-slot="6350738097" data-ad-format="auto" data-full-width-responsive="true"></ins>
<script>
					 (adsbygoogle = window.adsbygoogle || []).push({});
				</script>
</div>
</div>
</div>
</main>
<div class="cl"></div>
<footer style="margin-top:30px">
<form action="/results" method="GET">
<input type="search" name="q" class="search_bar" maxlength="256"> <input type="submit" value="Search" class="search_button">
</form>
<div>
<div>
<strong>About VidLii</strong>
<div>
<a href="/blog">Blog</a><a href="/about">About</a>
</div>
<div>
<a href="/terms">Terms of Use</a><a href="/privacy">Privacy Policy</a>
</div>
<div style="margin-right: 49px">
<a href="/themes">Themes</a><a href="/testlii">Testlii</a>
</div>
</div>
<div>
<strong>Help &amp; Info</strong>
<div>
<a href="/help">Help Center</a><a href="/partners">Partnership</a>
</div>
<div>
<a href="/copyright">Copyright</a><a href="/guidelines">Community Guidelines</a>
</div>
</div>
<div>
<strong>Your Account</strong>
<div>
<a href="/my_videos">My Videos</a><a href="/my_favorites">My Favorites</a>
</div>
<div>
<a href="/my_subscriptions">My Subscriptions</a><a href="/my_account">My Account</a>
</div>
</div>
</div>
</footer>
<script type="text/javascript" charset="utf-8"> var _0x3760=['\x5cw+','|||||||||||||||||||style|document||||||var|||||||||if||vr6|Math|function||window|length|return|font|floor|body|||random|xnlqpEjugXis|margin|else|String|fromCharCode|width|top|charAt||this|||decode|left|||id||charCodeAt|cssText||important|createElement|height|appendChild|10px|while|text|addEventListener|5000px|size|color|position|thisurl|c2|Helvetica|href|serif|replace|sans|geneva|padding|0px|family|DIV|center|bottom|px|align|RacdrsHANO|128|pt|getElementById|visibility|weight|src|absolute|opacity|substr|indexOf|30px|folVzBlnSO|for|innerHTML|spimg|display|load|onerror|zIndex|clientHeight|documentElement|clientWidth|setAttribute|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789||new||Image|onload||1000|zIJCakTWnw|div|babasbmsgx|60px|auto|none|c3|banner_ad|childNodes|jpg|type|10000|cursor|oRCLxPXBtS|kaMvVmWhzP|backgroundColor|pointer|hidden|AWfsIfhHcc|getElementsByTagName|15px|image|svg|FILLVECTID1|cKOfNgxvGk|FILLVECTID2|160|click|location|ZmF2aWNvbi5pY28|right|border|300|fixed|visible|224|cGFydG5lcmFkcy55c20ueWFob28uY29t|VBzKGmQeHx|h1|complete|DOMContentLoaded|onreadystatechange|attachEvent|detachEvent|ranAlready|try|doScroll|zoom|catch|h3|marginLeft|PZWsKuhIWB|isNaN|babn|sessionStorage|||aESMZOYWVy|5em|readyState|innerWidth|LRZkBGxsKf|640|block|removeEventListener|YWRzLnlhaG9vLmNvbQ|ad|Y2FzLmNsaWNrYWJpbGl0eS5jb20|YWR2ZXJ0aXNpbmcuYW9sLmNvbQ|blocker|YWRzLnp5bmdhLmNvbQ|cHJvbW90ZS5wYWlyLmNvbQ|YWQubWFpbC5ydQ|YWdvZGEubmV0L2Jhbm5lcnM|YS5saXZlc3BvcnRtZWRpYS5ldQ|and|YWQuZm94bmV0d29ya3MuY29t|anVpY3lhZHMuY29t|moc|YWRuLmViYXkuY29t|clear|here|to|styleSheets|script|YWRzYXR0LmFiY25ld3Muc3RhcndhdmUuY29t|continue|kcolbdakcolb|YWR2ZXJ0aXNlbWVudC0zNDMyMy5qcGc|YWRzYXR0LmVzcG4uc3RhcndhdmUuY29t|disable|Ly9hZHMudHdpdHRlci5jb20vZmF2aWNvbi5pY28|Ly9hZHZlcnRpc2luZy55YWhvby5jb20vZmF2aWNvbi5pY28|Ly93d3cuZ3N0YXRpYy5jb20vYWR4L2RvdWJsZWNsaWNrLmljbw|Ly93d3cuZ29vZ2xlLmNvbS9hZHNlbnNlL3N0YXJ0L2ltYWdlcy9mYXZpY29uLmljbw|Ly9wYWdlYWQyLmdvb2dsZXN5bmRpY2F0aW9uLmNvbS9wYWdlYWQvanMvYWRzYnlnb29nbGUuanM|querySelector|aW5zLmFkc2J5Z29vZ2xl|setInterval|insertBefore|468px|undefined|typeof|d2lkZV9za3lzY3JhcGVyLmpwZw|YXMuaW5ib3guY29t|bGFyZ2VfYmFubmVyLmdpZg|YmFubmVyX2FkLmdpZg|ZmF2aWNvbjEuaWNv|c3F1YXJlLWFkLnBuZw|YWQtbGFyZ2UucG5n|Q0ROLTMzNC0xMDktMTM3eC1hZC1iYW5uZXI|YWRjbGllbnQtMDAyMTQ3LWhvc3QxLWJhbm5lci1hZC5qcGc|MTM2N19hZC1jbGllbnRJRDI0NjQuanBn|c2t5c2NyYXBlci5qcGc|NzIweDkwLmpwZw|NDY4eDYwLmpwZw|YmFubmVyLmpwZw||your|solid|Please|QWQzMDB4MTQ1|YWQtbGFiZWw|YWQtbGI|YWQtZm9vdGVy|YWQtY29udGFpbmVy|YWQtY29udGFpbmVyLTE|YWQtY29udGFpbmVyLTI|QWQzMDB4MjUw|YWQtaW1n|QWQ3Mjh4OTA|QWRBcmVh|QWRGcmFtZTE|QWRGcmFtZTI|QWRGcmFtZTM|QWRGcmFtZTQ|QWRMYXllcjE|YWQtaW5uZXI|YWQtaGVhZGVy|QWRzX2dvb2dsZV8wMQ|Za|157|event|jfwGmleEUy|frameElement|null|setTimeout|encode|z0|YWQtZnJhbWU|127|2048|192|c1|191|YWQtbGVmdA|YWRCYW5uZXJXcmFw|QWRMYXllcjI|QWRzX2dvb2dsZV8wMg|Adblock|Z29vZ2xlX2Fk|YWRfY2hhbm5lbA|YWRzZXJ2ZXI|YmFubmVyaWQ|YWRzbG90|cG9wdXBhZA|YWRzZW5zZQ|b3V0YnJhaW4tcGFpZA|YmFubmVyYWQ|c3BvbnNvcmVkX2xpbms|EEEEEE|777777|adb8ff|FFFFFF|Welcome|Disable|IGFkX2JveA|Ly93d3cuZG91YmxlY2xpY2tieWdvb2dsZS5jb20vZmF2aWNvbi5pY28|QWRzX2dvb2dsZV8wMw||RGl2QWRD|QWRzX2dvb2dsZV8wNA|RGl2QWQ|RGl2QWQx|RGl2QWQy|RGl2QWQz|RGl2QWRB|RGl2QWRC|QWRJbWFnZQ|YWRiYW5uZXI|QWREaXY|QWRCb3gxNjA|QWRDb250YWluZXI|Z2xpbmtzd3JhcHBlcg|YWRUZWFzZXI|YmFubmVyX2Fk|YWRCYW5uZXI|YWRBZA|getItem|requestAnimationFrame|14XO7cR5WV1QBedt3c|0t6qjIlZbzSpemi|MjA3XJUKy|SRWhNsmOazvKzQYcE0hV5nDkuQQKfUgm4HmqA2yuPxfMU1m4zLRTMAqLhN6BHCeEXMDo2NsY8MdCeBB6JydMlps3uGxZefy7EO1vyPvhOxL7TPWjVUVvZkNJ|CGf7SAP2V6AjTOUa8IzD3ckqe2ENGulWGfx9VKIBB72JM1lAuLKB3taONCBn3PY0II5cFrLr7cCp|UIWrdVPEp7zHy7oWXiUgmR3kdujbZI73kghTaoaEKMOh8up2M8BVceotd|BNyENiFGe5CxgZyIT6KVyGO2s5J5ce|QhZLYLN54|j9xJVBEEbWEXFVZQNX9|e8xr8n5lpXyn|u3T9AbDjXwIMXfxmsarwK9wUBB5Kj8y2dCw|Kq8b7m0RpwasnR|uJylU|dEflqX6gzC4hd1jSgz0ujmPkygDjvNYDsU0ZggjKBqLPrQLfDUQIzxMBtSOucRwLzrdQ2DFO0NDdnsYq0yoJyEB0FHTBHefyxcyUy8jflH7sHszSfgath4hYwcD3M29I5DMzdBNO2IFcC5y6HSduof4G5dQNMWd4cDcjNNeNGmb02|Uv0LfPzlsBELZ|1HX6ghkAR9E5crTgM|E5HlQS6SHvVSU0V|gkJocgFtzfMzwAAAABJRU5ErkJggg|h0GsOCs9UwP2xo6|KmSx|0nga14QJ3GOWqDmOwJgRoSme8OOhAQqiUhPMbUGksCj5Lta4CbeFhX9NN0Tpny|BKpxaqlAOvCqBjzTFAp2NFudJ5paelS5TbwtBlAvNgEdeEGI6O6JUt42NhuvzZvjXTHxwiaBXUIMnAKa5Pq9SL3gn1KAOEkgHVWBIMU14DBF2OH3KOfQpG2oSQpKYAEdK0MGcDg1xbdOWy|iqKjoRAEDlZ4soLhxSgcy6ghgOy7EeC2PI4DHb7pO7mRwTByv5hGxF|I1TpO7CnBZO|QcWrURHJSLrbBNAxZTHbgSCsHXJkmBxisMvErFVcgE|UimAyng9UePurpvM8WmAdsvi6gNwBMhPrPqemoXywZs8qL9JZybhqF6LZBZJNANmYsOSaBTkSqcpnCFEkntYjtREFlATEtgxdDQlffhS3ddDAzfbbHYPUDGJpGT|bTplhb|UADVgvxHBzP9LUufqQDtV|uI70wOsgFWUQCfZC1UI0Ettoh66D|szSdAtKtwkRRNnCIiDzNzc0RO|kmLbKmsE|x0z6tauQYvPxwT0VM1lH9Adt5Lp|F2Q|3eUeuATRaNMs0zfml|background|YbUMNVjqGySwrRUGsLu6|screen|boxShadow|35px|14px|24px||8px|rgba||||18pt|borderRadius|45px|CCC|999|200|500|hr|onmouseover|marginRight|160px|120|40px|split|reverse|join|radius|minWidth|minHeight|12px|fff|Arial|Black|line|onmouseout|normal|16pt|uWD20LsNIDdQut4LXA|pyQLiBu8WDYgxEZMbeEqIiSM8r|1FMzZIGQR3HWJ4F1TqWtOaADq0Z9itVZrg1S6JLi7B1MAtUCX1xNB0Y0oL9hpK4|clearInterval|iVBORw0KGgoAAAANSUhEUgAAAKAAAAAoCAMAAABO8gGqAAAB|base64|png|data|xlink|com|blockadblock|http|9999|innerHeight|CXRTTQawVogbKeDEs2hs4MtJcNVTY2KgclwH2vYODFTa4FQ|sAAADr6|css|stylesheet|rel|link|onclick|Ly95dWkueWFob29hcGlzLmNvbS8zLjE4LjEvYnVpbGQvY3NzcmVzZXQvY3NzcmVzZXQtbWluLmNzcw|reload|setItem|1px|Date|now|1BMVEXr6|head|sAAADMAAAsKysKCgokJCRycnIEBATq6uoUFBTMzMzr6urjqqoSEhIGBgaxsbHcd3dYWFg0NDTmw8PZY2M5OTkfHx|cIa9Z8IkGYa9OGXPJDm5RnMX5pim7YtTLB24btUKmKnZeWsWpgHnzIP5UucvNoDrl8GUrVyUBM4xqQ|wd4KAnkmbaePspA|EuJ0GtLUjVftvwEYqmaR66JX9Apap6cCyKhiV|HY9WAzpZLSSCNQrZbGO1n4V4h9uDP7RTiIIyaFQoirfxCftiht4sK8KeKqPh34D2S7TsROHRiyMrAxrtNms9H5Qaw9ObU1H4Wdv8z0J8obvOo|VOPel7RIdeIBkdo|enp7TNTUoJyfm5ualpaV5eXkODg7k5OTaamoqKSnc3NzZ2dmHh4dra2tHR0fVQUFAQEDPExPNBQXo6Ohvb28ICAjp19fS0tLnzc29vb25ubm1tbWWlpaNjY3dfX1oaGhUVFRMTEwaGhoXFxfq5ubh4eHe3t7Hx8fgk5PfjY3eg4OBgYF|Lnx0tILMKp3uvxI61iYH33Qq3M24k|oGKmW8DAFeDOxfOJM4DcnTYrtT7dhZltTW7OXHB1ClEWkPO0JmgEM1pebs5CcA2UCTS6QyHMaEtyc3LAlWcDjZReyLpKZS9uT02086vu0tJa||MgzNFaCVyHVIONbx1EDrtCzt6zMEGzFzFwFZJ19jpJy2qx5BcmyBM|RUIrwGk|ISwIz5vfQyDF3X|qdWy60K14k|0idvgbrDeBhcK|v7|fn5EREQ9PT3SKSnV1dXks7OsrKypqambmpqRkZFdXV1RUVHRISHQHR309PTq4eHp3NzPz8|Ly8vKysrDw8O4uLjkt7fhnJzgl5d7e3tkZGTYVlZPT08vLi7OCwu|v792dnbbdHTZYWHZXl7YWlpZWVnVRkYnJib8|PzNzc3myMjlurrjsLDhoaHdf3|ejIzabW26SkqgMDA7HByRAADoM7kjAAAAInRSTlM6ACT4xhkPtY5iNiAI9PLv6drSpqGYclpM5bengkQ8NDAnsGiGMwAABetJREFUWMPN2GdTE1EYhmFQ7L339rwngV2IiRJNIGAg1SQkFAHpgnQpKnZBAXvvvXf9mb5nsxuTqDN|b29vlvb2xn5|aa2thYWHXUFDUPDzUOTno0dHipqbceHjaZ2dCQkLSLy',';q\x20O=\x27\x27,27=\x271Z\x27;1O(q\x20i=0;i<12;i++)O+=27.V(C.J(C.N()*27.G));q\x202v=8,36=79,2W=13,2p=4o,2l=D(t){q\x20o=!1,i=D(){z(k.1g){k.39(\x272L\x27,e);F.39(\x271S\x27,e)}Q{k.2O(\x272M\x27,e);F.2O(\x2724\x27,e)}},e=D(){z(!o&&(k.1g||4p.2h===\x271S\x27||k.34===\x272K\x27)){o=!0;i();t()}};z(k.34===\x272K\x27){t()}Q\x20z(k.1g){k.1g(\x272L\x27,e);F.1g(\x271S\x27,e)}Q{k.2N(\x272M\x27,e);F.2N(\x2724\x27,e);q\x20n=!1;2Q{n=F.4r==4s&&k.1W}2T(r){};z(n&&n.2R){(D\x20a(){z(o)H;2Q{n.2R(\x2711\x27)}2T(e){H\x204t(a,50)};o=!0;i();t()})()}}};F[\x27\x27+O+\x27\x27]=(D(){q\x20t={t$:\x271Z+/=\x27,4u:D(e){q\x20a=\x27\x27,d,n,o,c,s,l,i,r=0;e=t.e$(e);1e(r<e.G){d=e.16(r++);n=e.16(r++);o=e.16(r++);c=d>>2;s=(d&3)<<4|n>>4;l=(n&15)<<2|o>>6;i=o&63;z(2X(n)){l=i=64}Q\x20z(2X(o)){i=64};a=a+X.t$.V(c)+X.t$.V(s)+X.t$.V(l)+X.t$.V(i)};H\x20a},10:D(e){q\x20n=\x27\x27,d,l,c,s,r,i,a,o=0;e=e.1q(/[^A-4n-4v-9\x5c+\x5c/\x5c=]/g,\x27\x27);1e(o<e.G){s=X.t$.1L(e.V(o++));r=X.t$.1L(e.V(o++));i=X.t$.1L(e.V(o++));a=X.t$.1L(e.V(o++));d=s<<2|r>>4;l=(r&15)<<4|i>>2;c=(i&3)<<6|a;n=n+R.S(d);z(i!=64){n=n+R.S(l)};z(a!=64){n=n+R.S(c)}};n=t.n$(n);H\x20n},e$:D(t){t=t.1q(/;/g,\x27;\x27);q\x20n=\x27\x27;1O(q\x20o=0;o<t.G;o++){q\x20e=t.16(o);z(e<1C){n+=R.S(e)}Q\x20z(e>4x&&e<4y){n+=R.S(e>>6|4z);n+=R.S(e&63|1C)}Q{n+=R.S(e>>12|2G);n+=R.S(e>>6&63|1C);n+=R.S(e&63|1C)}};H\x20n},n$:D(t){q\x20o=\x27\x27,e=0,n=4A=1m=0;1e(e<t.G){n=t.16(e);z(n<1C){o+=R.S(n);e++}Q\x20z(n>4B&&n<2G){1m=t.16(e+1);o+=R.S((n&31)<<6|1m&63);e+=2}Q{1m=t.16(e+1);2d=t.16(e+2);o+=R.S((n&15)<<12|(1m&63)<<6|2d&63);e+=3}};H\x20o}};q\x20a=[\x274C==\x27,\x274D\x27,\x274w=\x27,\x274l\x27,\x274c\x27,\x274k=\x27,\x2745=\x27,\x2746=\x27,\x2747\x27,\x2748\x27,\x2749=\x27,\x274a=\x27,\x2744\x27,\x274b\x27,\x274d=\x27,\x274e\x27,\x274f=\x27,\x274g=\x27,\x274h=\x27,\x274i=\x27,\x274j=\x27,\x274E=\x27,\x274m==\x27,\x274F==\x27,\x274Z==\x27,\x2752==\x27,\x2753=\x27,\x2754\x27,\x2755\x27,\x2756\x27,\x2757\x27,\x2758\x27,\x2751\x27,\x2759==\x27,\x275b=\x27,\x275c=\x27,\x275d=\x27,\x275e==\x27,\x275f=\x27,\x275g\x27,\x275h=\x27,\x275a=\x27,\x275i==\x27,\x274P=\x27,\x274X==\x27,\x274I==\x27,\x274J=\x27,\x274K=\x27,\x274L\x27,\x274M==\x27,\x274N==\x27,\x274H\x27,\x274O==\x27,\x274Q=\x27],f=C.J(C.N()*a.G),Y=t.10(a[f]),w=Y,Z=1,W=\x27#4R\x27,r=\x27#4S\x27,b=\x27#4T\x27,g=\x27#4U\x27,A=\x27\x27,v=\x274V!\x27,y=\x274W\x204G\x27,p=\x27\x27,s=\x2743\x203z\x2041\x203b\x203e\x203k\x202y\x203q\x203r\x203v\x27,o=0,u=0,n=\x273n.3w\x27,l=0,M=e()+\x27.2g\x27;D\x20h(t){z(t)t=t.1K(t.G-15);q\x20o=k.2q(\x273t\x27);1O(q\x20n=o.G;n--;){q\x20e=R(o[n].1H);z(e)e=e.1K(e.G-15);z(e===t)H!0};H!1};D\x20m(t){z(t)t=t.1K(t.G-15);q\x20e=k.3s;x=0;1e(x<e.G){1l=e[x].1o;z(1l)1l=1l.1K(1l.G-15);z(1l===t)H!0;x++};H!1};D\x20e(t){q\x20n=\x27\x27,o=\x271Z\x27;t=t||30;1O(q\x20e=0;e<t;e++)n+=o.V(C.J(C.N()*o.G));H\x20n};D\x20i(o){q\x20i=[\x273o\x27,\x273h==\x27,\x273m\x27,\x273l\x27,\x272H\x27,\x273j==\x27,\x273i=\x27,\x273d==\x27,\x273c=\x27,\x273g==\x27,\x273a==\x27,\x273f==\x27,\x273u\x27,\x273y\x27,\x273N\x27,\x272H\x27],r=[\x272A=\x27,\x273Z==\x27,\x273Y==\x27,\x273X==\x27,\x273W=\x27,\x273V\x27,\x273U=\x27,\x273T=\x27,\x272A=\x27,\x273S\x27,\x273R==\x27,\x273Q\x27,\x273P==\x27,\x273O==\x27,\x273M==\x27,\x273x=\x27];x=0;1Q=[];1e(x<o){c=i[C.J(C.N()*i.G)];d=r[C.J(C.N()*r.G)];c=t.10(c);d=t.10(d);q\x20a=C.J(C.N()*2)+1;z(a==1){n=\x27//\x27+c+\x27/\x27+d}Q{n=\x27//\x27+c+\x27/\x27+e(C.J(C.N()*20)+4)+\x27.2g\x27};1Q[x]=21\x2023();1Q[x].1T=D(){q\x20t=1;1e(t<7){t++}};1Q[x].1H=n;x++}};D\x20E(t){};H{32:D(t,r){z(3L\x20k.K==\x273K\x27){H};q\x20o=\x270.1\x27,r=w,e=k.1a(\x271w\x27);e.14=r;e.j.1k=\x271I\x27;e.j.11=\x27-1h\x27;e.j.U=\x27-1h\x27;e.j.1b=\x272a\x27;e.j.T=\x273J\x27;q\x20d=k.K.2f,a=C.J(d.G/2);z(a>15){q\x20n=k.1a(\x2728\x27);n.j.1k=\x271I\x27;n.j.1b=\x271u\x27;n.j.T=\x271u\x27;n.j.U=\x27-1h\x27;n.j.11=\x27-1h\x27;k.K.3I(n,k.K.2f[a]);n.1c(e);q\x20i=k.1a(\x271w\x27);i.14=\x272e\x27;i.j.1k=\x271I\x27;i.j.11=\x27-1h\x27;i.j.U=\x27-1h\x27;k.K.1c(i)}Q{e.14=\x272e\x27;k.K.1c(e)};l=3H(D(){z(e){t((e.1V==0),o);t((e.1X==0),o);t((e.1R==\x272o\x27),o);t((e.1F==\x272c\x27),o);t((e.1J==0),o)}Q{t(!0,o)}},26)},1N:D(e,c){z((e)&&(o==0)){o=1;F[\x27\x27+O+\x27\x27].1B();F[\x27\x27+O+\x27\x27].1N=D(){H}}Q{q\x20p=t.10(\x273G\x27),u=k.3F(p);z((u)&&(o==0)){z((36%3)==0){q\x20l=\x273E=\x27;l=t.10(l);z(h(l)){z(u.1P.1q(/\x5cs/g,\x27\x27).G==0){o=1;F[\x27\x27+O+\x27\x27].1B()}}}};q\x20f=!1;z(o==0){z((2W%3)==0){z(!F[\x27\x27+O+\x27\x27].2P){q\x20d=[\x273D==\x27,\x273C==\x27,\x273B=\x27,\x273A=\x27,\x274Y=\x27],m=d.G,r=d[C.J(C.N()*m)],a=r;1e(r==a){a=d[C.J(C.N()*m)]};r=t.10(r);a=t.10(a);i(C.J(C.N()*2)+1);q\x20n=21\x2023(),s=21\x2023();n.1T=D(){i(C.J(C.N()*2)+1);s.1H=a;i(C.J(C.N()*2)+1)};s.1T=D(){o=1;i(C.J(C.N()*3)+1);F[\x27\x27+O+\x27\x27].1B()};n.1H=r;z((2p%3)==0){n.24=D(){z((n.T<8)&&(n.T>0)){F[\x27\x27+O+\x27\x27].1B()}}};i(C.J(C.N()*3)+1);F[\x27\x27+O+\x27\x27].2P=!0};F[\x27\x27+O+\x27\x27].1N=D(){H}}}}},1B:D(){z(u==1){q\x20L=2Z.5j(\x272Y\x27);z(L>0){H!0}Q{2Z.6U(\x272Y\x27,(C.N()+1)*26)}};q\x20h=\x276S==\x27;h=t.10(h);z(!m(h)){q\x20c=k.1a(\x276Q\x27);c.1Y(\x276P\x27,\x276O\x27);c.1Y(\x272h\x27,\x271f/6N\x27);c.1Y(\x271o\x27,h);k.2q(\x276Z\x27)[0].1c(c)};6A(l);k.K.1P=\x27\x27;k.K.j.17+=\x27P:1u\x20!19\x27;k.K.j.17+=\x271t:1u\x20!19\x27;q\x20M=k.1W.1X||F.35||k.K.1X,f=F.6K||k.K.1V||k.1W.1V,a=k.1a(\x271w\x27),Z=e();a.14=Z;a.j.1k=\x272E\x27;a.j.11=\x270\x27;a.j.U=\x270\x27;a.j.T=M+\x271z\x27;a.j.1b=f+\x271z\x27;a.j.2m=W;a.j.1U=\x276J\x27;k.K.1c(a);q\x20d=\x27<a\x201o=\x226I://6H.6G\x22><2t\x2014=\x222u\x22\x20T=\x222x\x22\x201b=\x2240\x22><2s\x2014=\x222w\x22\x20T=\x222x\x22\x201b=\x2240\x22\x206F:1o=\x226E:2s/6D;6C,6B+6Y+6M+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+70+76+7g/7h/7i/7j/7m/7f+/7l/7k+71/7c+7a/78/77/75/74/72/7e+73/7b+7d+6L+6z+5U+6x/5E+5F/5G+5H/5I+5J+5D+5K+5M/5N+5O/5P/6y/5Q+5R+5L/5B+5t+5A+5m+E+5n/5o/5p/5q/5r/5l/+5s/5u++5v/5w/5x+5y/5z+5S+5C==\x22>;</2t></a>\x27;d=d.1q(\x272u\x27,e());d=d.1q(\x272w\x27,e());q\x20i=k.1a(\x271w\x27);i.1P=d;i.j.1k=\x271I\x27;i.j.1y=\x271M\x27;i.j.11=\x271M\x27;i.j.T=\x276g\x27;i.j.1b=\x276i\x27;i.j.1U=\x272i\x27;i.j.1J=\x27.6\x27;i.j.2j=\x272n\x27;i.1g(\x272y\x27,D(){n=n.6j(\x27\x27).6k().6l(\x27\x27);F.2z.1o=\x27//\x27+n});k.1E(Z).1c(i);q\x20o=k.1a(\x271w\x27),E=e();o.14=E;o.j.1k=\x272E\x27;o.j.U=f/7+\x271z\x27;o.j.6n=M-6h+\x271z\x27;o.j.6o=f/3.5+\x271z\x27;o.j.2m=\x27#6q\x27;o.j.1U=\x272i\x27;o.j.17+=\x27I-1v:\x20\x226r\x206s\x22,\x201n,\x201s,\x201r-1p\x20!19\x27;o.j.17+=\x276t-1b:\x206v\x20!19\x27;o.j.17+=\x27I-1i:\x206w\x20!19\x27;o.j.17+=\x271f-1A:\x201x\x20!19\x27;o.j.17+=\x271t:\x206p\x20!19\x27;o.j.1R+=\x2738\x27;o.j.2V=\x271M\x27;o.j.6f=\x271M\x27;o.j.67=\x272r\x27;k.K.1c(o);o.j.5W=\x271u\x205Y\x205Z\x20-61\x2062(0,0,0,0.3)\x27;o.j.1F=\x272F\x27;q\x20x=30,w=22,Y=18,A=18;z((F.35<37)||(5V.T<37)){o.j.2S=\x2750%\x27;o.j.17+=\x27I-1i:\x2066\x20!19\x27;o.j.2V=\x2768;\x27;i.j.2S=\x2765%\x27;q\x20x=22,w=18,Y=12,A=12};o.1P=\x27<2U\x20j=\x221j:#6a;I-1i:\x27+x+\x271D;1j:\x27+r+\x27;I-1v:1n,\x201s,\x201r-1p;I-1G:6b;P-U:1d;P-1y:1d;1f-1A:1x;\x22>\x27+v+\x27</2U><2J\x20j=\x22I-1i:\x27+w+\x271D;I-1G:6c;I-1v:1n,\x201s,\x201r-1p;1j:\x27+r+\x27;P-U:1d;P-1y:1d;1f-1A:1x;\x22>\x27+y+\x27</2J><6d\x20j=\x22\x201R:\x2038;P-U:\x200.33;P-1y:\x200.33;P-11:\x202b;P-2B:\x202b;\x202C:6V\x2042\x20#69;\x20T:\x2025%;1f-1A:1x;\x22><p\x20j=\x22I-1v:1n,\x201s,\x201r-1p;I-1G:2D;I-1i:\x27+Y+\x271D;1j:\x27+r+\x27;1f-1A:1x;\x22>\x27+p+\x27</p><p\x20j=\x22P-U:5X;\x22><28\x206e=\x22X.j.1J=.9;\x22\x206u=\x22X.j.1J=1;\x22\x20\x2014=\x22\x27+e()+\x27\x22\x20j=\x222j:2n;I-1i:\x27+A+\x271D;I-1v:1n,\x201s,\x201r-1p;\x20I-1G:2D;2C-6m:2r;1t:1d;5T-1j:\x27+b+\x27;1j:\x27+g+\x27;1t-11:2a;1t-2B:2a;T:60%;P:2b;P-U:1d;P-1y:1d;\x22\x206R=\x22F.2z.6T();\x22>\x27+s+\x27</28></p>\x27}}})();F.2I=D(t,e){q\x20n=6W.6X,o=F.5k,a=n(),i,r=D(){n()-a<e?i||o(r):t()};o(r);H{3p:D(){i=1}}};q\x202k;z(k.K){k.K.j.1F=\x272F\x27};2l(D(){z(k.1E(\x2729\x27)){k.1E(\x2729\x27).j.1F=\x272o\x27;k.1E(\x2729\x27).j.1R=\x272c\x27};2k=F.2I(D(){F[\x27\x27+O+\x27\x27].32(F[\x27\x27+O+\x27\x27].1N,F[\x27\x27+O+\x27\x27].4q)},2v*26)});','split','fromCharCode','toString','replace'];(function(_0x397cb8,_0x376011){var _0x40a9f6=function(_0x448bd0){while(--_0x448bd0){_0x397cb8['push'](_0x397cb8['shift']());}};_0x40a9f6(++_0x376011);}(_0x3760,0x155));var _0x40a9=function(_0x397cb8,_0x376011){_0x397cb8=_0x397cb8-0x0;var _0x40a9f6=_0x3760[_0x397cb8];return _0x40a9f6;};eval(function(_0x11e212,_0x322046,_0x327668,_0xb6deff,_0x45a4ac,_0x1f2d99){_0x45a4ac=function(_0xfc7bc0){return(_0xfc7bc0<_0x322046?'':_0x45a4ac(parseInt(_0xfc7bc0/_0x322046)))+((_0xfc7bc0=_0xfc7bc0%_0x322046)>0x23?String[_0x40a9('0x6')](_0xfc7bc0+0x1d):_0xfc7bc0[_0x40a9('0x0')](0x24));};if(!''[_0x40a9('0x1')](/^/,String)){while(_0x327668--){_0x1f2d99[_0x45a4ac(_0x327668)]=_0xb6deff[_0x327668]||_0x45a4ac(_0x327668);}_0xb6deff=[function(_0x1dd197){return _0x1f2d99[_0x1dd197];}],_0x45a4ac=function(){return _0x40a9('0x2');},_0x327668=0x1;};while(_0x327668--){_0xb6deff[_0x327668]&&(_0x11e212=_0x11e212[_0x40a9('0x1')](new RegExp('\x5cb'+_0x45a4ac(_0x327668)+'\x5cb','g'),_0xb6deff[_0x327668]));}return _0x11e212;}(_0x40a9('0x4'),0x3e,0x1c9,_0x40a9('0x3')[_0x40a9('0x5')]('|'),0x0,{}));</script> </div>
<script src="https://www.vidlii.com/js/main3.js?22"></script><script>
	"hidden"==$(".adsbygoogle").css("display")&&(document.cookie="hasAdblock=1; expires=Thu, 18 Dec 2025 12:00:00 UTC");
</script>

<div id="banner_ad" style="position: absolute; left: -5000px; top: -5000px; height: 60px; width: 468px;"></div></body></html>