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
		<td width="350">
		<h1 class="header"><?php echo $VideoName ?></h1>
		<!---<div style="font-size: 13px; font-weight: bold; text-align:center;">
		<a href="#">Share</a>
		// <a href="#comment">Comment</a>
		// <a href="#" target="invisible" onclick="return FavoritesHandler();">Add to Favorites</a>
		// <a href="#">Contact Me</a>
		</div>-->	<tbody><tr valign="top">
		<td width="510" style="padding-right: 15px;">
		<br>
			<div width="640" height="380">
				<iframe style='outline: 0px solid transparent;' src='./player.php?v=<?php echo $vid ?>' width='650' height='380' frameBorder='0' scrolling='no' debug='true'></iframe>
			</div>
		</div>
		<div class="ui segment">
			<p><?php echo $VideoDesc ?></p>
			<div>
				<a href='profile.php?user=<?php echo $Uploader?>'><img class="ui avatar image" src="content/profpic/<?php echo $Uploader?>.png" onerror="this.src='img/profiledef.png'">
				<?php echo $Uploader ?><br/></a>
				Uploaded: <?php echo $UploadDate ?><br/>
				<a href="#comment">Comments</a>: <?php echo $commentcount ?>
			</div>
		</div>

		<table width="400" cellpadding="0" cellspacing="0" border="0" align="center">
	
					</div>
			</td>
		</tr>
	</tbody></table>
	
	<div class="ui blue center aligned inverted segment">
		Share this video! Copy and paste this link:
		<form name="linkForm" id="linkForm" class="ui input">
		  <input name="video_link" type="text" onclick="javascript:document.linkForm.video_link.focus();document.linkForm.video_link.select();" value="<?php echo $share_link; ?>" size="50" readonly="true" style="text-align: center;">
		</form>
	</div>
		
<table width="650">
<tbody>
<td>
<a name="comment"></a>
Comments (<?php echo $commentcount; ?>):

<div class="ui comments">
  <form class="ui reply form" name="comment_formmain_comment" id="comment_formmain_comment" method="post" action="comment.php">
    <div class="field">
	  <input type="hidden" name="video_id" value="<?php echo $vid; ?>">
      <textarea tabindex="2" name="comment" cols="80" rows="2"></textarea>
    </div>
    <button type="submit" name="add_comment_button" onclick="postThreadedComment(&#39;comment_formmain_comment&#39;);" class="ui primary submit labeled icon button">
      <i class="icon edit"></i> Add Comment
    </button>
  </form>
		
<?php
$sql= mysqli_query($connect, "SELECT * FROM comments ORDER BY commentid DESC");

$count = 0;

while ($searchcomments = mysqli_fetch_assoc($sql)) { // get comments for video
$usercommentlist = htmlspecialchars($searchcomments['user']); // comment
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
echo "<div class='comment'>
    <a class='avatar'>
      <img src='content/profpic/$usercommentlist.png' onerror=\"this.src='img/profiledef.png'\" width='35' height='35' style='height:35px;width:35px;'>
    </a>
    <div class='content'>
      <a class='author' href='profile.php?user=$usercommentlist'>$usercommentlist</a>
      <div class='metadata'>
        <div class='date'>$datecommentlist</div>
      </div>
      <div class='text'>
		$rendered
      </div>
      <div class='actions'>
        <a class='reply'>Reply (TODO)</a>
      </div>
    </div>
  </div>";
$count++; // count the amount of comments
}
}
if($count == 0) {
	echo "<p style='font-size: 15px;'>No comments found.</p>"; // echos "no comments found" if no comments
}
?>
</div>
</tbody></table>
		

		</td>
		<td width="280">
				<div style="padding-bottom: 10px;">
					<table width="280" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEEE">
						</table>
		</div>

<h4 class="ui top attached inverted header">
	<div id="homepage-featured-more-top">
		<span>Videos from <?php echo $Uploader ?></span>
	</div>
</h4>
<div class="ui bottom attached segment">
<div class="ui celled list">
					<?php				
$x = 1; 
$sql = mysqli_query($connect, "SELECT * FROM videodb ORDER by `UploadDate` DESC"); //instructions for sql

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
	if (!($fetch['isApproved'] == 2)) {
		echo "<div class='item'>
			<div class='image'>
				<div class='ui basic compact fitted segment'>
				  <div class='ui black bottom right attached label'>".$lengthlist."</div>
				  <a href='watch.php?v=$idvideolist'>
					<img width='90' height='70' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\">
				  </a>
				</div>
			</div>
			<div class='content'>
			  <a href='watch.php?v=$idvideolist' class='header'>$namevideolist</a>
			  <div class='extra'>
			  Uploaded on $uploadedvideolist<br>
			  <a href='profile.php?user=$uploadervideolist'><img class='ui avatar image' src='content/profpic/$uploadervideolist.png' onerror=\"this.src='img/profiledef.png'\">
			  <span>$uploadervideolist</span></a>
			  </div>
			</div>
		  </div>";
		$x++;
	}
}
}
?>
	</div>
</div>
<h4 class="ui top attached inverted header">
	<div id="homepage-featured-more-top">
		<span>Recommended Videos</span>
	</div>
</h4>
<div class="ui bottom attached segment">
<div class="ui celled list">
					<?php
$sql = mysqli_query($connect, "SELECT * FROM videodb ORDER BY rand() DESC"); //instructions for sql
$x = 1;
while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
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
if ($x == 9) {
	break;
}
if (!($fetch['isApproved'] == 2)) {
	echo "<div class='item'>
		<div class='image'>
			<div class='ui basic compact fitted segment'>
			  <div class='ui black bottom right attached label'>".$lengthlist."</div>
			  <a href='watch.php?v=$idvideolist'>
				<img width='90' height='70' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\">
			  </a>
			</div>
		</div>
		<div class='content'>
		  <a href='watch.php?v=$idvideolist' class='header'>$namevideolist</a>
		  <div class='extra'>
		  Uploaded on $uploadedvideolist<br>
		  <a href='profile.php?user=$uploadervideolist'><img class='ui avatar image' src='content/profpic/$uploadervideolist.png' onerror=\"this.src='img/profiledef.png'\">
		  <span>$uploadervideolist</span></a>
		  </div>
		</div>
	  </div>";
	  $x++;
	}
}
?>

					</td>
					<td><img src="./img/pixel.gif" width="5" height="1"></td>
				</tr>
				<tr>
				</tr>
			</tbody></table>
		
		</td>
	</tr>
</tbody></table>


		</td>
	</tr>
</tbody></table>
<?php include('footer.php') ?></body></html>
