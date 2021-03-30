<?php
require_once __DIR__ . '/lib/BBCode/BBCode.php';
require_once __DIR__ . '/lib/BBCode/Tag.php';
include("header.php");
$share_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
$Uploader = htmlspecialchars($vdf['Uploader']); // get all video information
$VideoName = htmlspecialchars($vdf['VideoName']);
$ViewCount = $vdf['ViewCount'];
$PreUploadDate = htmlspecialchars($vdf['UploadDate']);
$VideoDesc = nl2br(htmlspecialchars($vdf['VideoDesc']));
$VideoCategory = htmlspecialchars($vdf['VideoCategory']);
$VideoFile = $vdf['VideoFile'];
$DateTime = new DateTime($PreUploadDate);
$length = 0;
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
<title><?php echo $VideoName ?> - PokTube</title>
<meta name="title" content="<?php echo $VideoName ?> - PokTube">
<meta name="description" content="<?php echo $VideoDesc ?>">
<body><table width="950" cellpadding="0" cellspacing="0" border="0" align="center">
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

<table width="895" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td width="515" style="padding-right: 15px;">
		<div id="watch-vid-title" class="title">
			<h1><?php echo $VideoName ?></h1>
		</div>
		<div style="font-size: 13px; font-weight: bold; text-align:center;">
		<a href="#">Share</a>
		// <a href="#comment">Comment</a>
		// <a href="#" target="invisible" onclick="return FavoritesHandler();">Add to Favorites</a>
		// <a href="#">Contact Me</a>
     	<tbody><tr valign="top">
		<td width="510" style="padding-right: 15px;">
		<br>
			<div width="640" height="380">
				<iframe style='outline: 0px solid transparent;' src='./player.php?v=<?php echo $vid ?>' width='650' height='380' frameBorder='0' scrolling='no' debug='true'></iframe>
			</div>
		</div>
		
		<table width="640" cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody><tr>
                    <td>

                        <div class="watchDescription">
                                                        <?php echo $VideoDesc ?>.                                                    </div>

                        <div style="font-size: 11px; padding-bottom: 18px;">
                            Added on <?php echo $PreUploadDate ?> by <a href="profile.php?user=<?php echo $Uploader ?>"><?php echo $Uploader ?></a>
                        </div>

                    </td>
                </tr>
                </tbody></table>
		
		<table width="640" cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody><tr valign="top">
                    <td style="border-right: 1px dotted #AAAAAA; padding-right: 5px;" width="245">
                        <div style="font-weight: bold; color:#003399; padding-bottom: 7px;">Video Details //</div>

                        <div style="font-size: 11px; padding-bottom: 10px;">
                            Runtime: <?php echo $length ?> | <a href="#comment">Comments</a>: <?php echo $commentcount ?>                        </div>
                                                <div style="padding-bottom: 10px;"><span style="background-color: #FFFFAA; padding: 2px;">Category:</span>&nbsp;
                            <?php echo $VideoCategory ?></div>

                        <div style="font-size: 11px; padding-bottom: 10px;">
                                                                                </div>

                    </td>
                    <td style="padding-left: 10px;" width="240">
                        <div style="font-weight: bold; font-size: 12px; color:#003399; padding-bottom: 7px;">User Details //</div>

                        <div style="font-size: 11px; padding-bottom: 10px;">
                            <a href="profile_videos.php?user=<?php echo $Uploader ?>">Videos</a>: <?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `Uploader`='".$Uploader."' AND `isApproved` = '1';");
		$vdf_alt = mysqli_fetch_assoc($query);
		echo $vdf_alt['COUNT(VideoID)'];?>          </div>

<img style="float: left; margin: 0px 5px 10px 0px; padding: 5px 0px 0px 0px;" src="content/profpic/<?php echo $Uploader?>.png" onerror="this.src='img/profiledef.png'" class="thumb" width="48" height="48">
                        <div style="padding-bottom: 10px;">
                            <span style="background-color: #FFFFAA; padding: 2px;">User Name:</span>&nbsp; <a href="profile.php?user=<?php echo $Uploader ?>"><?php echo $Uploader ?></a>
                        </div>
						
						<div style="padding-bottom: 5px;">
                            <img src="/img/SubscribeIcon.gif" align="absmiddle">&nbsp;
                            <a <?php 
                            if(!isset($_SESSION['username'])) {
								echo "href=\"javascript:void(0)\" onclick=\"alert('Log in to subscribe!')\"> subscribe </a> to";
							} else if ($Uploader == $_SESSION['username']) {
								echo "href=\"javascript:void(0)\" onclick=\"alert('Why are you trying to subscribe to yourself?')\"> subscribe </a> to";
							} else {
								$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $_SESSION['username'] ."'"); // calls for channel info
								$cdf = mysqli_fetch_assoc($chanfetch);
								$Subscriptions = $cdf['subscriptions'];
								$learray = json_decode($Subscriptions);
								//sphagetti code, but this makes it shut up if using an existing db.
								if(!isset($Subscriptions) OR $Subscriptions == "") {
									echo "href=\"/subscribe.php?user=".$Uploader."\"> subscribe </a> to";
								} else if(count(json_decode($Subscriptions)) == 0) {
									echo "href=\"/subscribe.php?user=".$Uploader."\"> subscribe </a> to";
								} else if (in_array($Uploader, $learray)) {
									echo "href=\"/unsubscribe.php?user=".$Uploader."\"> unsubscribe </a> from";
								} else {
									echo "href=\"/subscribe.php?user=".$Uploader."\"> subscribe </a> to";
								}
							}
                            ?>
                             <?php echo $Uploader ?>'s videos
                        </div>
                        
                        <div style="padding-bottom: 10px;">
                                                        <div style="padding-bottom: 10px;">(Last signed in text, placeholder)</div>
                                                        <div style="font-weight: bold; padding-bottom: 10px;">
                                <a href="">Send Me a Private Message!</a>
                            </div>
                        </div></td>
                </tr>
                </tbody></table>

		<table width="400" cellpadding="0" cellspacing="0" border="0" align="center"> <?php //what does this table even do! ?>
	
					</div>
			</td>
		</tr>
	</tbody></table>

<!-- google_ad_section_end -->

	<!-- watchTable -->

<table style="table-layout: fixed;" width="640" cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody><tr>
                    <td>
                        <form name="linkForm" id="linkForm">
                            <table style="table-layout:fixed;" width="640" cellspacing="0" cellpadding="0" border="0">
                                <tbody><tr>
                                    <td width="33%">
                                        <div style="font-weight: bold; font-size: 12px; color:#003399; padding-bottom: 7px;" align="left">
                                            Share Details // &nbsp;<a href="sharing.php">Help?</a>
                                        </div>
                                    </td>
                                    <td width="67%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><span style="background-color: #FFFFAA; padding: 2px;">Video URL (Permalink):</span><font style="color: #000000;">&nbsp;&nbsp;</font></td>
                                    <td valign="top">
                                        <input name="video_link" type="text" onclick="javascript:document.linkForm.video_link.focus();document.linkForm.video_link.select();" value="<?php echo $share_link; ?>" style="width: 300px;" readonly="true">
                                        <div style="font-size: 11px;">(E-mail or link it)<br><br></div>
                                    </td>
                                </tr>
                                </tr>
                                <tr>


                                </tr>
                                                                </tbody></table>
                        </form>
                    </td>
                </tr>
                </tbody></table>
<br>
<a name="comment"></a>

		<div style="padding-bottom: 5px; font-weight: bold; color: #444;">Comment on this video:</div>
				<div id="div_main_comment">		<div style="padding-bottom: 5px; font-weight: bold; color: #444; display: none;">Comment on this video:</div>		<form name="comment_formmain_comment" id="comment_formmain_comment" method="post" action="comment.php"><input type="hidden" name="video_id" value="<?php echo $vid; ?>"><textarea tabindex="2" name="comment" cols="78" rows="3"></textarea>			<br>			<input type="submit" name="add_comment_button" value="Post Comment" onclick="postThreadedComment(&#39;comment_formmain_comment&#39;);">			<input type="button" name="discard_comment_button" value="Discard" style="display: none" onclick="hideCommentReplyForm(&#39;main_comment&#39;,false);">		</form></div>
		
		
<br>
		
<table width="650">
<tbody><tr>
<td>
	<table class="commentsTitle" width="100%">
	<tbody><tr>
		<td>Comments (<?php echo $commentcount; ?>): </td>
	</tr></tbody></table>
</td>
</tr>
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
echo "<tr>
<td>
      			<a name='8n9OjARLLDs'>
					<table class='parentSection' cellspacing='0' cellpadding='0' id='comment_8n9OjARLLDs' width='100%' style='margin-left: 0px'>
					<tbody><tr valign='top'>
						<td>
							<div class='userStats'>
							<img src='content/profpic/$usercommentlist.png' onerror='this.src='img/profiledef.png'' class='thumb' width='32' height='32'>
								<span style='vertical-align: top;'><a href='profile.php?user=".$usercommentlist."'>".$usercommentlist."</a>
								 - (".$datecommentlist.")</span>
							</div>
							<span>".$rendered."</span>
						</td>
					</tr>
				</tbody></table>
			</a></td>
</tr>";
$count++; // count the amount of comments
}
}
if($count == 0) {
	echo "<tr><td><center><p style='padding: 10px; font-size: 15px;'>No comments found.</p></center></td></tr>"; // echos "no comments found" if no comments
}
?>
</tbody></table>
		

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
					<span class="smallLabel">Added on</span> <b class="smallText">June 08, 2006, 08:11 AM</b><br>
					<span class="smallLabel">by</span> <b><a href="/web/20060624045545/http://www.youtube.com/profile?user=Blunty3000">Blunty3000</a></b>
					<span class="xsmallText">
							(75 videos)
						<!-- 1 hour ago) -->
						<!-- 38 favorites -->
					</span>
				</div>


		</div> <!-- end uploaderInfo -->
		
		
        <div id="vidNameDescDiv">
        	<!-- <b>Vblog - how to be popular on youtube</b>
			(<span class="runtime">06:27</span>)<br/> -->
			<span id="vidDescBegin">
			I talk, mostly about how to be popular on youtube, but also about the beard, smoking, users worth watching, and I dance, poorly! amongst other things
			</span>
		</div>
		
		<div id="vidTagsWrapper">
			<div id="vidTagsLabel" class="label">Tags:</div>
			<div id="vidTagsDiv">
			<span id="vidTagsBegin">
<a href="/web/20060624045545/http://www.youtube.com/results?search=winekone">winekone</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=filthywhore">filthywhore</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=utnow">utnow</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=morbeck">morbeck</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=boh3m3">boh3m3</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=strip">strip</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=dance">dance</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=panties">panties</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=popular">popular</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=utube">utube</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=users">users</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=mime">mime</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=beard">beard</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=kevin">kevin</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=smith">smith</a> &nbsp; <a href="/web/20060624045545/http://www.youtube.com/results?search=topless">topless</a>			</span>
			</div> <!-- end vidTagsDiv -->
		</div> <!-- end vidTagsWrapper -->
		
		<div id="vidURLDiv">
            <form name="urlForm" id="urlForm">
            <table id="vidURLTable">
            <tbody><tr><td><span class="label">URL</span></td>
            <td>
            <input name="video_link" type="text" value="http://www.youtube.com/watch?v=RFxh75UJcCE" class="vidURLField" onclick="javascript:document.urlForm.video_link.focus();document.urlForm.video_link.select();" readonly="true">
            </td>
            </tr>
            <tr><td><span class="smallLabel">Embed</span></td>
            <td>
            <input name="embed_code" type="text" value="<object width=&quot;425&quot; height=&quot;350&quot;><param name=&quot;movie&quot; value=&quot;http://www.youtube.com/v/RFxh75UJcCE&quot;></param><embed src=&quot;http://www.youtube.com/v/RFxh75UJcCE&quot; type=&quot;application/x-shockwave-flash&quot; width=&quot;425&quot; height=&quot;350&quot;></embed></object>" class="vidURLField" onclick="javascript:document.urlForm.embed_code.focus();document.urlForm.embed_code.select();" readonly="true">
            </td></tr>
            </tbody></table>
            </form>
        </div>
        
        
        <div id="subscribeDiv" class="smallText">
        <a href="/web/20060624045545/http://www.youtube.com/subscription_center?add_user=Blunty3000" title="subscribe to Blunty3000's videos"><img src="/img/sub_button.gif" class="alignMid" alt="subscribe" title="subscribe to Blunty3000's videos" width="81" border="0"></a> to Blunty3000's videos
        </div>
        
	</div>
			Videos from <?php echo $Uploader ?>

							<div id="side_results" name="side_results">
					<?php				
$x = 1; 
$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER by `UploadDate` DESC"); //instructions for sql

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
if ($x == 9) {
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

if ($uploadervideolist == $Uploader && $idvideolist !== $vid) {
echo "<div class='vWatchEntry'>
		<table><tbody><tr>
		<td><div class='img'>
				<a href='watch?v=$idvideolist'><img class='vimgSm'img src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\"></a></div></td>
		<td><div class='title'><b><a href='watch?v=$idvideolist'>$namevideolist</a></b><br>
			<span class='runtime'>$lengthlist</span>
			</div>
			<div class='facets'>
				<span class='grayText'>From:</span> <a href='profile.php?user=$uploadervideolist'>$uploadervideolist</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div>";
$x++;
}
}
?>
			
			<br/>
			
			Recommended Videos

							<div id="side_results" name="side_results">
					<?php
$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY rand() DESC LIMIT 8"); //instructions for sql

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
if($fetch['VideoLength'] > 3600) {
	$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
} else { 
	$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
};
$idvideolist = $fetch['VideoID'];
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$viewsvideolist = $fetch['ViewCount'];
$uploadedvideolist = htmlspecialchars($fetch['UploadDate']);

echo "<div class='vWatchEntry'>
		<table><tbody><tr>
		<td><div class='img'>
				<a href='watch?v=$idvideolist'><img class='vimgSm'img src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\"></a></div></td>
		<td><div class='title'><b><a href='watch?v=$idvideolist'>$namevideolist</a></b><br>
			<span class='runtime'>$lengthlist</span>
			</div>
			<div class='facets'>
				<span class='grayText'>From:</span> <a href='profile.php?user=$uploadervideolist'>$uploadervideolist</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div>";
}
?>
		
		</td>
	</tr>
</tbody></table>


		</td>
	</tr>
</tbody></table>
<?php include('footer.php') ?></body></html>
