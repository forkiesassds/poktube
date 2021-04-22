<?php
require_once __DIR__ . '/lib/BBCode/BBCode.php';
require_once __DIR__ . '/lib/BBCode/Tag.php';
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
$Background = htmlspecialchars($cdf['channel_bg']);
$PreRegisteredOn = $cdf['registeredon'];
$DateTime = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime->format('F j Y');
$RegisteredYear = $DateTime->format('Y');
}
?>
<html>
<link rel="stylesheet" href="watch_yts1149717226.css" type="text/css">
<style>
#masthead {
    width: 100%;
}
</style>
<script>
function openDiv (elName) {
	var theElemenet = document.getElementById(elName);
	if (theElemenet) {
		theElemenet.style.display = "block";
	}
}
function closeDiv (elName) {
	var theElemenet = document.getElementById(elName);
	if (theElemenet) {
		theElemenet.style.display = "none";
	}
}

function selectLink (elName) {
	var theElement = document.getElementById(elName);
	if (theElement) {
		theElement.className = "selectedNavLink";
	}
}
function unSelectLink (elName) {
	var theElement = document.getElementById(elName);
	if (theElement) {
		theElement.className = "unSelectedNavLink";
	}
}

function blurElement (elName) {
	var theElement = document.getElementById(elName);
	if (theElement) {
		theElement.blur();
	}
}

function selectNavLink (linkName) {
	if (linkName == "exRelatedLink") {
		closeDiv("exUserDiv");
		closeDiv("exPlaylistDiv");
		openDiv("exRelatedDiv");
		unSelectLink("exPlaylistLink");
		unSelectLink("exUserLink");
		selectLink("exRelatedLink");
		blurElement("exRelatedLink");
	}
	if (linkName == "exPlaylistLink") {
		closeDiv("exRelatedDiv");
		closeDiv("exUserDiv");
		openDiv("exPlaylistDiv");
		unSelectLink("exUserLink");
		unSelectLink("exRelatedLink");
		selectLink("exPlaylistLink");
		blurElement("exPlaylistLink");
	}
	if (linkName == "exUserLink") {
		closeDiv("exRelatedDiv");
		closeDiv("exPlaylistDiv");
		openDiv("exUserDiv");
		unSelectLink("exPlaylistLink");
		unSelectLink("exRelatedLink");
		selectLink("exUserLink");
		blurElement("exUserLink");
	}
}

function showRelatedVideosContent() {
	selectNavLink('exRelatedLink');
}

function showRelatedPlaylistContent() {
	selectNavLink('exPlaylistLink');
}

function showRelatedUserContent() {
	selectNavLink('exUserLink');
}
</script>
<title><?php echo $VideoName ?> - SquareBracket</title>
<meta name="title" content="<?php echo $VideoName ?> - squareBracket">
<meta name="description" content="<?php echo $VideoDesc ?>">
<body><table width="930" cellpadding="0" cellspacing="0" border="0" align="center">
	<tbody><tr>
		<td bgcolor="#FFFFFF" style="padding-bottom: 25px;">
<script>
	function getFormVars(form) 
	{	var formVars = new Array();
		for (var i = 0; i < form.elements.length; i++)
		{
			var formElement = form.elements[i];
			formVars[formElement.name] = formElement.value;
		}
		return urlEncodeDict(formVars);
	}

	function showCommentReplyForm(form_id, reply_parent_id, is_main_comment_form) {
		if(!CheckLogin()) 
			return false;
		printCommentReplyForm(form_id, reply_parent_id, is_main_comment_form);
	}
	function printCommentReplyForm(form_id, reply_parent_id, is_main_comment_form) {

		var div_id = "div_" + form_id;
		var reply_id = "reply_" + form_id;
		var reply_comment_form = "comment_form" + form_id;
		
		if (is_main_comment_form)
			discard_visible="style='display: none'";
		else
			discard_visible="";
		
		var innerHTMLContent = '\
		<div style="padding-bottom: 5px; font-weight: bold; color: #444; display: none;">Comment on this video:</div>\
		<form name="' + reply_comment_form + '" id="' + reply_comment_form + '" method="post" action="comment_servlet" >\
			<input type="hidden" name="video_id" value="pTrJLz2Nwsg">\
			<input type="hidden" name="add_comment" value="">\
			<input type="hidden" name="form_id" value="' + reply_comment_form + '">\
			<input type="hidden" name="reply_parent_id" value="' + reply_parent_id + '">\
			<textarea tabindex="2" name="comment" cols="55" rows="3"></textarea>\
			<br>\
			Attach a video:\
			<select name="field_reference_video">\
				<option value="">- Your Videos -</option>\
				<option value="">- Your Favorite Videos -</option>\
			</select>\
			<input type="button" name="add_comment_button" \
								value="Post Comment" \
								onclick="postThreadedComment(\'' + reply_comment_form + '\');">\
			<input type="button" name="discard_comment_button"\
								value="Discard" ' + discard_visible + '\
								onclick="hideCommentReplyForm(\'' + form_id + '\',false);">\
		</form></div>';
		if(!is_main_comment_form) {
			toggleVisibility(reply_id, false);
		}
		toggleVisibility(div_id, true);
		setInnerHTML(div_id, innerHTMLContent);
	}
</script>
<div align="center">





</div>

<table width="930" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td width="515" style="padding-right: 15px;">
		<div id="watch-vid-title" class="title">
			<h1><?php echo $VideoName ?></h1>
		</div>
		<div style="font-size: 13px; font-weight: bold; text-align:center;">
     	<tbody><tr valign="top">
		<td width="510" style="padding-right: 15px;">
			<div width="640" height="380">
				<iframe style='outline: 0px solid transparent;' src='./player.php?v=<?php echo $vid ?>' width='650' height='380' frameBorder='0' scrolling='no' debug='true'></iframe>
			</div>
		</div>
<br>
<!--todo: readd the box which contains some info, but it might all just be features unimplemented. maybe add video replies????-->
<a name="comment"></a>

		<div style="padding-bottom: 5px; font-weight: bold; color: #444;">Comment on this video:</div>
				<div id="div_main_comment">		<div style="padding-bottom: 5px; font-weight: bold; color: #444; display: none;">Comment on this video:</div>		<form name="comment_formmain_comment" id="comment_formmain_comment" method="post" action="comment.php"><input type="hidden" name="video_id" value="<?php echo $vid; ?>"><textarea tabindex="2" name="comment" cols="78" rows="3"></textarea>			<br>			<input type="submit" name="add_comment_button" class="button" value="Post Comment" onclick="postThreadedComment(&#39;comment_formmain_comment&#39;);">			<input type="button" name="discard_comment_button" value="Discard" style="display: none" onclick="hideCommentReplyForm(&#39;main_comment&#39;,false);">		</form></div>
		
		
<br>
		
<h2>Comments (<?php echo $commentcount; ?>):</h2>
<?php
$sql= mysqli_query($connect, "SELECT * FROM comments ORDER BY commentid DESC");

$count = 0;

while ($searchcomments = mysqli_fetch_assoc($sql)) { // get comments for video
$usercommentlist = htmlspecialchars($searchcomments['user']); // commente
$datecommentlist = $searchcomments['date']; // comment date
$messagecommentlist = htmlspecialchars($searchcomments['comment']); // actual text for comment
$idcommentlist = $searchcomments['id']; // comment id, to get descending order to work
$hidden = $searchcomments['hidden']; // hidden comments are for deleted videos

$bbcode = new ChrisKonnertz\BBCode\BBCode();
$bbcode->ignoreTag('spoiler');
$bbcode->ignoreTag('youtube');
$bbcode->ignoreTag('img');
$rendered = $bbcode->render($messagecommentlist);
if ($idcommentlist == $vid AND $hidden != 1) {
echo "<div class='commentEntry' id='comment_LdOoXgR5prs'>
				<div class='commentHead'>
				<div id='watch-channel-icon' class='user-thumb-small'><a href='/profile.php?user=$usercommentlist' onmousedown=''><img src='content/profpic/$usercommentlist.png' onerror='this.src='img/profiledef.png'' alt='Channel Icon'></a></div>
					<b><a href='profile.php?user=$usercommentlist'>$usercommentlist</a></b>
					<span class='smallText'> $datecommentlist </span>
				</div>
				<div class='commentBody'>
					$rendered
				</div>
			</div>";
$count++; // count the amount of comments
}
}
if($count == 0) {
	echo "<p style='padding: 10px; font-size: 15px;'>No comments found.</p>"; // echos "no comments found" if no comments
}
?>
		

		</td>
		<td width="280">
		</div>
		<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content"><span class="headerTitleLite">About This Video</span></div>
	</div>
	<div id="aboutVidDiv" class="contentBox">
		<div id="uploaderInfo">
				<div>
				<div id="watch-channel-icon" class="user-thumb-medium">
				<a href="/profile.php?user=<?php echo $Uploader ?>" onmousedown=""><img src="content/profpic/<?php echo $Uploader ?>.png" onerror="this.src='img/profiledef.png'" alt="Channel Icon"></a>
			</div>
					<span class="smallLabel">Added on</span> <b class="smallText"><?php echo $UploadDate ?></b><br>
					<span class="smallLabel">by</span> <b><a href="/profile.php?user=<?php echo $Uploader ?>"><?php echo $Uploader ?></a></b>
					<span class="xsmallText">
							(<?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `Uploader`='".$Uploader."' AND `isApproved` = '1';");
		$vdf_alt = mysqli_fetch_assoc($query);
		echo $vdf_alt['COUNT(VideoID)'];?> videos)
						<!-- 1 hour ago) -->
						<!-- 38 favorites -->
					</span>
				</div>


		</div> <!-- end uploaderInfo -->
		
		
        <div id="vidNameDescDiv">
        	<!-- <b>Vblog - how to be popular on youtube</b>
			(<span class="runtime">06:27</span>)<br/> -->
			<span id="vidDescBegin">
			<?php echo $VideoDesc ?>
			</span>
		</div>
		
		<div id="vidTagsWrapper">
			<div id="vidTagsLabel" class="label">Tags:</div>
			<div id="vidTagsDiv">
			<span id="vidTagsBegin">
<a href="#">not</a> &nbsp; <a href="#">implemented!</a></span>
			</div> <!-- end vidTagsDiv -->
		</div> <!-- end vidTagsWrapper -->
		
		<div id="vidURLDiv">
            <form name="urlForm" id="urlForm">
            <table id="vidURLTable">
            <tbody><tr><td><span class="label">URL</span></td>
            <td>
            <input name="video_link" type="text" value="<?php echo $share_link ?>" class="vidURLField" onclick="javascript:document.urlForm.video_link.focus();document.urlForm.video_link.select();" readonly="true">
            </td>
            </tr>
            <tr><td><span class="smallLabel">Embed</span></td>
            <td>
            <input name="embed_code" type="text" value="<iframe width='650' height='380' src='<?php echo $embed_link?>' frameborder='0' allowfullscreen></iframe>" class="vidURLField" onclick="javascript:document.urlForm.embed_code.focus();document.urlForm.embed_code.select();" readonly="true">
            </td></tr>
            </tbody></table>
            </form>
        </div>
        
        
        <div id="subscribeDiv" class="smallText" style="line-height: 26px;">
		
        <a class="action-button"		<?php 
                            if(!isset($_SESSION['username'])) {
								echo "href=\"javascript:void(0)\" onclick=\"alert('Log in to subscribe!')\" title=\"subscribe to $Username's channel\" style=\"line-height: 13px;\">					<span class=\"action-button-leftcap\"></span>
								<span class=\"action-button-text\">Subscribe</span>
								<span class=\"action-button-rightcap\" style=\"margin-right: 5px;\"></span></a> to $Username's channel";
							} else if ($Uploader == $_SESSION['username']) {
								echo "href=\"javascript:void(0)\" onclick=\"alert('Why are you trying to subscribe to yourself?')\" title=\"subscribe to $Username's channel\" style=\"line-height: 13px;\">					<span class=\"action-button-leftcap\"></span>
								<span class=\"action-button-text\">Subscribe</span>
								<span class=\"action-button-rightcap\" style=\"margin-right: 5px;\"></span></a> to $Username's channel";
							} else {
								$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $_SESSION['username'] ."'"); // calls for channel info
								$cdf = mysqli_fetch_assoc($chanfetch);
								$Subscriptions = $cdf['subscriptions'];
								$learray = json_decode($Subscriptions);
								//sphagetti code, but this makes it shut up if using an existing db.
								if(!isset($Subscriptions) OR $Subscriptions == "") {
									echo "href=\"/subscribe.php?user=".$Uploader."\" title=\"subscribe to $Username's channel\" style=\"line-height: 13px;\">					<span class=\"action-button-leftcap\"></span>
									<span class=\"action-button-text\">Subscribe</span>
									<span class=\"action-button-rightcap\" style=\"margin-right: 5px;\"></span></a> to $Username's channel";
								} else if(count(json_decode($Subscriptions)) == 0) {
									echo "href=\"/subscribe.php?user=".$Uploader."\" title=\"subscribe to $Username's channel\" style=\"line-height: 13px;\">					<span class=\"action-button-leftcap\"></span>
									<span class=\"action-button-text\">Subscribe</span>
									<span class=\"action-button-rightcap\" style=\"margin-right: 5px;\"></span></a> to $Username's channel";
								} else if (in_array($Uploader, $learray)) {
									echo "href=\"/unsubscribe.php?user=".$Uploader."\" title=\"unsubscribe from $Username's channel\" style=\"line-height: 13px;\">					<span class=\"action-button-leftcap\"></span>
									<span class=\"action-button-text\">Unsubscribe</span>
									<span class=\"action-button-rightcap\" style=\"margin-right: 5px;\"></span></a> from $Username's channel";
								} else {
									echo "href=\"/subscribe.php?user=".$Uploader."\" title=\"subscribe to $Username's channel\" style=\"line-height: 13px;\">					<span class=\"action-button-leftcap\"></span>
									<span class=\"action-button-text\">Subscribe</span>
									<span class=\"action-button-rightcap\" style=\"margin-right: 5px;\"></span></a> to $Username's channel";
								}
							}
                            ?> 
        </div>
        
	</div>
	<br/>
	<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content"><span class="headerTitleLite">Explore More Videos</span></div>
	</div>
	</div>

	<div id="exploreDiv" class="contentBox">

		<table id="exSubNavTable"><tr>
		<td><a href="#" id="exRelatedLink" class="selectedNavLink" onclick="selectNavLink('exRelatedLink'); return false;">Related</a></td>
		<!--<td align="center"><a href="#" id="exPlaylistLink" class="unSelectedNavLink eLink" onclick="showRelatedPlaylistContent(); return false;">Playlists</a></td>-->
		<td align="right"><a href="#" id="exUserLink" class="unSelectedNavLink eLink" onclick="selectNavLink('exUserLink'); return false;"><span class="smallText"><?php echo $Username?>'s</span> Videos</a></td>
		</tr></table>
		

			<div id="exRelatedDiv" style="display: block;">
				<table class="showingTable"><tr>
	<td class="smallText">Showing 1-20 of <?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `isApproved` = '1';");
		$vdf_alt = mysqli_fetch_assoc($query);
		echo $vdf_alt['COUNT(VideoID)'];?></td>
	<td align="right" class="smallText"><a href="/web/20060624045545/http://www.youtube.com/results?related=winekone%20filthywhore%20utnow%20morbeck%20boh3m3%20strip%20dance%20panties%20popular%20utube%20users%20mime%20beard%20kevin%20smith%20topless">See All Videos</a></td>
	</tr></table>

		<div id="side_results" class="exploreContent" name="side_results">
	
		<div class="vWatchEntry">
			<div class="vNowPlaying">
		<table><tr>
		<td><div class="img">
				<a href="<?php echo $share_link ?>"><img class="vimgSm" src='content/thumbs/<?php echo $vid ?>.png' onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="<?php echo $share_link ?>"><?php echo $VideoName ?></a></b><br/>
			<span class="runtime"><?php echo $length ?></span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=<?php echo $Username ?>"><?php echo $Username ?></a><br/>
			</div>
				<div class="smallText">
				<b>&lt;&lt; Now Playing</b>
				</div>
			</div></td>
		</tr></table>
		</div> <!-- end vNowPlaying -->
		</div> <!-- end vWatchEntry -->
		
		<?php				
		$x = 1; 
		$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY RAND() DESC"); //instructions for sql

		while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
		if ($x == 20) {
			break;
		}
		$idvideolist = $fetch['VideoID'];
		$lengthlist = 0;
		if($fetch['VideoLength'] > 3600) {
			$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
		} else { 
			$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
		};
		$namevideolist = htmlspecialchars($fetch['VideoName']);
		$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
		$viewsvideolist = $fetch['ViewCount'];
		$uploadedvideolist = htmlspecialchars($fetch['UploadDate']);

		if ($idvideolist !== $vid) {
		echo "		<div class=\"vWatchEntry\">
		<table><tr>
		<td><div class=\"img\">
				<a href=\"/watch.php?v=$idvideolist\"><img class=\"vimgSm\" src='content/thumbs/$idvideolist.png' onerror=\"this.src='img/default.png'\"/></a></div></td>
		<td><div class=\"title\"><b><a href=\"/watch.php?v=$idvideolist\">$namevideolist</a></b><br/>
			<span class=\"runtime\">$lengthlist</span>
			</div>
			<div class=\"facets\">
				<span class=\"grayText\">From:</span> <a href=\"/profile.php?user=$uploadervideolist\">$uploadervideolist</a><br/>
			</div>
			</div></td>
		</tr></table>
		</div> <!-- end vWatchEntry -->";
		$x++;
		}
		}
		?>
	
	</div>

			<table class="showingTable"><tr>
	<td class="smallText">Showing 1-20 of <?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `isApproved` = '1';");
		$vdf_alt = mysqli_fetch_assoc($query);
		echo $vdf_alt['COUNT(VideoID)'];?></td>
	<td align="right" class="smallText"><a href="/web/20060624045545/http://www.youtube.com/results?related=winekone%20filthywhore%20utnow%20morbeck%20boh3m3%20strip%20dance%20panties%20popular%20utube%20users%20mime%20beard%20kevin%20smith%20topless">See All Videos</a></td>
	</tr></table>
			</div> <!-- end exRelatedDiv -->
			
			
			<div id="exPlaylistDiv" style="display: none;">
				Loading...
			</div> <!-- end exPlaylistDiv -->
			
			
			<div id="exUserDiv" style="display: none">
			<table class="showingTable"><tr>
	<td class="smallText"><?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `isApproved` = '1' AND `Uploader`='".$Username."';");
		$vdf_alt = mysqli_fetch_assoc($query);
		if ($vdf_alt['COUNT(VideoID)'] < 75) {
			echo "Showing 1-".$vdf_alt['COUNT(VideoID)']." of ".$vdf_alt['COUNT(VideoID)'];
		} else {
			echo "Showing 1-75 of ".$vdf_alt['COUNT(VideoID)'];
		}?></td>
	<td align="right" class="smallText"><a href="/profile.php?user=<?php echo $Username?>&page=videos">See All Videos</a></td>
	</tr></table>

		<div id="side_results" class="exploreContent" name="side_results" onscroll="render_full_side()">
	
			<?php				
			$x = 1; 
			$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' AND `Uploader`='".$Username."' ORDER by `UploadDate` DESC"); //instructions for sql

			while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
			if ($x == 76) {
				break;
			}
			$idvideolist = $fetch['VideoID'];
			$lengthlist = 0;
			if($fetch['VideoLength'] > 3600) {
				$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
			} else { 
				$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
			};
			$namevideolist = htmlspecialchars($fetch['VideoName']);
			$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
			$viewsvideolist = $fetch['ViewCount'];
			$uploadedvideolist = htmlspecialchars($fetch['UploadDate']);

			if ($idvideolist !== $vid) {
			echo "		<div class=\"vWatchEntry\">
			<table><tr>
			<td><div class=\"img\">
					<a href=\"/watch.php?v=$idvideolist\"><img class=\"vimgSm\" src='content/thumbs/$idvideolist.png' onerror=\"this.src='img/default.png'\"/></a></div></td>
			<td><div class=\"title\"><b><a href=\"/watch.php?v=$idvideolist\">$namevideolist</a></b><br/>
				<span class=\"runtime\">$lengthlist</span>
				</div>
				<div class=\"facets\">
					<span class=\"grayText\">From:</span> <a href=\"/profile.php?user=$uploadervideolist\">$uploadervideolist</a><br/>
				</div>
				</div></td>
			</tr></table>
			</div> <!-- end vWatchEntry -->";
			$x++;
			} else {
				echo "		<div class=\"vWatchEntry\">
				<div class=\"vNowPlaying\">
			<table><tr>
			<td><div class=\"img\">
					<a href=\"$share_link\"><img class=\"vimgSm\" src='content/thumbs/$vid.png' onerror=\"this.src='img/default.png'\"></a></div></td>
			<td><div class=\"title\"><b><a href=\"$share_link\">$VideoName</a></b><br/>
				<span class=\"runtime\">$length</span>
				</div>
				<div class=\"facets\">
					<span class=\"grayText\">From:</span> <a href=\"/profile.php?user=$Username>\">$Username</a><br/>
				</div>
					<div class=\"smallText\">
					<b>&lt;&lt; Now Playing</b>
					</div>
				</div></td>
			</tr></table>
			</div> <!-- end vNowPlaying -->
			</div> <!-- end vWatchEntry -->";
			}
			}
			?>

			</div> 
						<table class="showingTable"><tr>
	<td class="smallText"><?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `isApproved` = '1' AND `Uploader`='".$Username."';");
		$vdf_alt = mysqli_fetch_assoc($query);
		if ($vdf_alt['COUNT(VideoID)'] < 75) {
			echo "Showing 1-".$vdf_alt['COUNT(VideoID)']." of ".$vdf_alt['COUNT(VideoID)'];
		} else {
			echo "Showing 1-75 of ".$vdf_alt['COUNT(VideoID)'];
		}?></td>
	<td align="right" class="smallText"><a href="/profile.php?user=<?php echo $Username?>&page=videos">See All Videos</a></td>
	</tr></table>
			<!-- end exUserDiv -->

		
	</div> <!-- end exploreDiv -->
	
	

	
</div> <!-- end aboutExploreDiv -->
		
		</td>
	</tr>
</tbody></table>


		</td>
	</tr>
</tbody></table>
<?php include('footer.php') ?></body></html>
