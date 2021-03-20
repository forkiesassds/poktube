<?php 
require_once __DIR__ . '/lib/PHPColors/Color.php';
require_once __DIR__ . '/lib/BBCode/BBCode.php';
require_once __DIR__ . '/lib/BBCode/Tag.php';
use Mexitek\PHPColors\Color;
include("header_profile.php"); 

if(isset($_GET["user"])) {
$user = $_GET["user"];
}
$share_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//if $FeaturedVideo is null then dont show anything
if (!isset($_GET["user"])) {
die();
}

$vidfetch = mysqli_query($connect, "SELECT * FROM videodb");
$vdf = mysqli_fetch_assoc($vidfetch);
$Uploader = htmlspecialchars($vdf['Uploader']); // get all video information
$VideoName = htmlspecialchars($vdf['VideoName']);
$ViewCount = $vdf['ViewCount'];
$PreUploadDate = htmlspecialchars($vdf['UploadDate']);
$VideoDesc = nl2br(htmlspecialchars($vdf['VideoDesc']));

$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $user ."'"); // calls for channel info
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
$Inside = htmlspecialchars($cdf['channel_inside']);
$Text = htmlspecialchars($cdf['channel_text']);
$color = new Color($Foreground);
if($cdf['prof_website']) {
$Website = htmlspecialchars($cdf['prof_website']);
} else {
	$Website = "";
}
$PreRegisteredOn = $cdf['registeredon'];
$DateTime = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime->format('F j Y');
$RegisteredYear = $DateTime->format('Y');

if($cdf['channel_color']) {
	$Foreground = htmlspecialchars($cdf['channel_color']);
} else {
	$Foreground = "#003366";
}
if (isset($_POST['post_comment'])) {
	if ($_POST['post_comment'] == "Post Comment") {
		$i = 1; // i does the count
		$id = $Username; // get video id so it knows what video you are going to comment
		$comment = $_POST["comment"]; // what are you going to comment?
		$commentid = 0; // initialize
		$datenow = date("Y-m-d"); // get the current date

		// Check connection
		if ($connect->connect_error) {
		  die('Connection failed: ' . $conn->connect_error);
		}

		$sqllist = 'SELECT id, commentid, comment, user, date FROM comments ORDER by commentid DESC'; // to count what comment id is next
		$result = $connect->query($sqllist);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			  if($row["id"] = $id) {
				  $i++;
			  }
		  }
		} else {

		}
		$commentid = $i;
		$username = $_SESSION["username"];
		if($comment[0] === '>') {
			$yes = $comment;
			$comment = "[color=#5dae5d]";
			$comment .= $yes;
			$comment .= "[/color]";
		}
		if(!empty($_SESSION["username"])) {
			$stmt = $connect->prepare("INSERT INTO comments (id, commentid, comment, user, date) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("sisss", $id, $commentid, $comment, $username, $datenow); // prepared statements for inserting comments into db
			$stmt->execute();
		} else {
			echo "You are not logged in.";
		}
	}
}
?>

<meta name="title" content="<?php echo $Username ?>'s Channel">
<meta name="description" content="<?php echo $AboutMe ?>">
<title><?php echo $Username ?> - PokTube</title>
</div>
        <div class="wrapper">
            <style>
    body { background-color: <?php echo $Background ?>; }
	.bgtext { color: <?php echo $Text?> }
    .wrapper a { color: <?php echo $Text?> !important }
    tr.bulletin td { border-color: #000000 }
    .profileHeaders { background: #<?php echo $color->lighten()?> }
    .highlightheader { background: #<?php echo $color->lighten()?> }
    .userTable, .bulletin td, .leftBg, .commentsMsg td { background: <?php echo $Inside?> !important; }
    .userTable { border: 1px solid #<?php echo $color->lighten()?> !important; }
    .connectTable, .bulletinTable, .aboutTable, .commentPostTable { border: 1px solid #<?php echo $color->lighten()?> !important; }
    .bulletinTopFirstCells, tr.bulletinTitle td { border-color: #<?php echo $color->lighten()?> !important; }
    .normalinner, .bulletinTitle { background: <?php echo $Inside?> }
	#footer { background: <?php echo $Inside ?> !important; border-top: 1px solid <?php echo $Foreground ?>}
    .normalinner td { border-color: #<?php echo $color->lighten()?> !important; }
    .wrapper { color: #222222 }
    .profileTitles { color: <?php echo $Text?> }
    .profileHeaders { color: #ffffff }
	#mainContent { width: 700px; margin-right: 10px; margin-left: 150px; }
</style>

<div style="margin: 0 0 13px;text-align:center">
	<?php
		$query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `Uploader`='".$user."' AND `isApproved` = '1';");
		$vdf = mysqli_fetch_assoc($query);
		$count = $vdf['COUNT(VideoID)'];
		$pquery = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `Uploader`='".$user."' AND `isApproved` != '1';");
		$pvdf = mysqli_fetch_assoc($pquery);
		$pcount = $pvdf['COUNT(VideoID)'];
		$cquery = mysqli_query($connect, "SELECT COUNT(commentid) FROM comments WHERE `id`='".$user."';");
		$cvdf = mysqli_fetch_assoc($cquery);
		$ccount = $cvdf['COUNT(commentid)'];
		$bquery = mysqli_query($connect, "SELECT COUNT(id) FROM bulletins WHERE `user`='".$user."';");
		$bvdf = mysqli_fetch_assoc($bquery);
		$bcount = $bvdf['COUNT(id)'];
		if (isset($_GET["page"])) {
			echo "<a href=\"/profile.php?user=".$Username."\">Profile</a> | ";
			if($_GET["page"] == "videos") {
				echo "<b class=\"bgtext\">Public Videos (".$count.")</b> | ";
			} else {
				echo "<a href=\"/profile.php?user=".$Username."&page=videos\">Public Videos</a> <span class=\"bgtext\">(".$count.")</span> | ";
			}
			if($_GET["page"] == "pvideos") {
				echo "<b class=\"bgtext\">Private Videos (".$pcount.")</b> | ";
			} else {
				echo "<a href=\"/profile.php?user=".$Username."&page=pvideos\">Private Videos</a> <span class=\"bgtext\">(".$pcount.")</span> | ";
			}
			if($_GET["page"] == "favorites") {
				echo "<b class=\"bgtext\">Favorites (0)</b> | ";
			} else {
				echo "<a href=\"/profile.php?user=".$Username."&page=favorites\">Favorites</a> <span class=\"bgtext\">(0)</span> | ";
			}
			if($_GET["page"] == "friends") {
				echo "<b class=\"bgtext\">Friends (0)</b> | ";
			} else {
				echo "<a href=\"/profile.php?user=".$Username."&page=friends\">Friends</a> <span class=\"bgtext\">(0)</span> | ";
			}
			if($_GET["page"] == "comments") {
				echo "<b class=\"bgtext\">Comments (".$ccount.")</b> | ";
			} else {
				echo "<a href=\"/profile.php?user=".$Username."&page=comments\">Comments</a> <span class=\"bgtext\">(".$ccount.")</span> | ";
			}
			if($_GET["page"] == "bulletins") {
				echo "<b class=\"bgtext\">Bulletins (".$bcount.")</b>";
			} else {
				echo "<a href=\"/profile.php?user=".$Username."&page=bulletins\">Bulletins</a> <span class=\"bgtext\">(".$bcount.")</span>";
			}
		} else {
			echo "<b class=\"bgtext\">Profile</b> | 
			<a href=\"/profile.php?user=".$Username."&page=videos\">Public Videos</a> <span class=\"bgtext\">(".$count.")</span> | 
			<a href=\"/profile.php?user=".$Username."&page=pvideos\">Private Videos</a> <span class=\"bgtext\">(".$pcount.")</span> | 
			<a href=\"/profile.php?user=".$Username."&page=favorites\">Favorites</a> <span class=\"bgtext\">(0)</span> | 
			<a href=\"/profile.php?user=".$Username."&page=friends\">Friends</a> <span class=\"bgtext\">(0)</span> | 
			<a href=\"/profile.php?user=".$Username."&page=comments\">Comments</a> <span class=\"bgtext\">(".$ccount.")</span> | 
			<a href=\"/profile.php?user=".$Username."&page=bulletins\">Bulletins</a> <span class=\"bgtext\">(".$bcount.")</span>";
		}
	?>
</div>
<div>
<?php 
if(isset($_GET["page"]))
	if($_GET["page"] == "comment") {
		echo "<div style=\"width: 875px; text-align: left;\">
    <div id=\"mainContent\"> 
    <h2 class=\"bgtext\" style=\"margin:0 0 2px\">Write a comment<span style=\"font-size:12px;color:lightgray\"> (for ".$Username.")</span></h2>
<div class=\"bgtext\" style=\"margin-bottom:3px;font-family:arial,helvetica,sans-serif;\">Channel comments appear on the users channel.</div>
<form action=\"/profile.php?user=".$Username."\" method=\"POST\">
<table style=\"position:relative;right:4px\" cellpadding=\"4px\">
    <tbody><tr>
        <td><textarea maxlength=\"500\" name=\"comment\" cols=\"66\" rows=\"6\"></textarea></td>
    </tr>
    <tr>
        <td><input type=\"submit\" name=\"post_comment\" value=\"Post Comment\"> <a href=\"/profile.php?user=".$Username."\"><button type=\"button\">Cancel</button></a></td>
    </tr>
</tbody></table>
</form> 
        </div>
    </div>";
	include "watermark.php";
	die();
	} else if ($_GET["page"] == "comments") {
		echo "<div id=\"mainContent\">
		<table class=\"commentPostTable\" style=\"width: 570px;\" cellpadding=\"0\" cellspacing=\"0\">
			<tbody><tr class=\"profileHeaders\">
				<td colspan=\"3\">	<div style=\"float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px\">My Comments</div>
                </div></td>
            </tr>
		";
		$sql= mysqli_query($connect, "SELECT * FROM comments ORDER BY commentid DESC");
		$count = 0;
		while ($searchcomments = mysqli_fetch_assoc($sql)) { // get comments for video
			$usercommentlist = htmlspecialchars($searchcomments['user']); // commente
			$datecommentlist = $searchcomments['date']; // comment date
			$messagecommentlist = htmlspecialchars($searchcomments['comment']); // actual text for comment
			$idcommentlist = $searchcomments['id']; // comment id, to get descending order to work
			$hidden = $searchcomments['hidden']; // hidden comments are for deleted videos
			$PreDate = $searchcomments['date'];
			$DateTime = new DateTime($PreDate);
			$Date = $DateTime->format('F j Y');
			$bbcode = new ChrisKonnertz\BBCode\BBCode();
			$bbcode->ignoreTag('spoiler');
			$bbcode->ignoreTag('youtube');
			$bbcode->ignoreTag('img');
			$rendered = $bbcode->render($messagecommentlist);
			if ($idcommentlist == $Username AND $hidden != 1 AND $count != 3) {
				echo "<tr class=\"rowsLine normalinner\" id=\"cc_718\">
						<td width=\"123\" align=\"center\" valign=\"top\" class=\"leftBg\" style=\"padding-right: 10px\">
						<span class=\"profileTitles\"><a href=\"/profile.php?user=".$usercommentlist."\">".$usercommentlist."</a></span>
						<br>
						<br>
						<a href=\"/profile.php?user=".$usercommentlist."\"><img src=\"content/profpic/<?php echo $usercommentlist?>.png\" onerror=\"this.src='img/profiledef.png'\" class=\"commentsImg\">
						</a></td>
						<td colspan=\"2\" style=\"padding-right: 5px;position:relative;\" valign=\"top\">
							<span class=\"profileTitles\">".$Date."</span> <br>
						<br>
						<div style=\"overflow: flow; width: 333px;word-break:break-all\">
						".$rendered."                                    </div>
					</td>
				</tr>";
				$count++;
			}
		}
		echo "</div>";
		include "watermark.php";
		die();
	} else if ($_GET["page"] == "videos") {
		if(!isset($_GET["pagenum"])){
		$page = 1;
		}
		if(isset($_GET["pagenum"])){
		if($_GET["pagenum"] == 1) {
			$page = 1;
		}
		if($_GET["pagenum"] && $_GET["pagenum"] > 1){
			$page = $_GET["pagenum"] * 20;
		}
		}

		$page = $page - 1;
		$sql = mysqli_query($connect, "SELECT * FROM videodb"); //instructions for sql
		$count = 0;
		$pages = 0;

		while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
		$count++;
		if($count == 20) {
			$pages++;
			$count = 0;
		}
		}
		echo "<table class=\"commentPostTable\" style=\"width: 865px;\" cellpadding=\"0\" cellspacing=\"0\">
			<tbody><tr class=\"profileHeaders\">
				<td colspan=\"3\">	<div style=\"float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px\">".$Username."'s Videos</div>
                </div></td>
            </tr>
			<table class=\"rowsLine normalinner\" style=\"padding-top: 10px;padding-bottom: 10px;\" id=\"cc_718\" width=\"865\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">

			<tbody>
		";
		$vidlist = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' AND `Uploader`='".$user."' ORDER by `UploadDate` DESC LIMIT ".$page.", 20");
		$count = 0;

		while ($fetch = mysqli_fetch_assoc($vidlist)) {
		$idvideolist = $fetch['VideoID'];
		$lengthlist = 0;
		if($fetch['VideoLength'] > 3600) {
			$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
		} else { 
			$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
		};
		$namevideolist = htmlspecialchars($fetch['VideoName']);
		$uploadervideolist = htmlspecialchars($fetch['Uploader']);
		$uploadvideolist = $fetch['UploadDate'];
		$viewsvideolist = htmlspecialchars($fetch['ViewCount']);

		if($count == 0) {
			echo "<tr valign='top'>";
		}
		echo "<td width='20%' align='center'>
				<a href='watch.php?v=".$idvideolist."&player=0'>      <div class='v120WrapperOuter'>
			 <div class='v120WrapperInner'>
				<a id='video-url-muP9eH2p2PI' href='watch.php?v=$idvideolist' rel='nofollow'><img title='$namevideolist' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" class='vimg120' qlicon='muP9eH2p2PI' alt='$namevideolist'></a>
			 <div class='video-time'><span id='video-run-time-muP9eH2p2PI'>$lengthlist</span></div>
			 </div>
		  </div></a>
			<div class='moduleFeaturedTitle'><a href='watch.php?v=".$idvideolist."&player=0'>".$namevideolist."</a></div>
			<div class='moduleFeaturedDetails'>
				Added: ".$uploadvideolist."<br>
				by <a href='profile.php?user=".$uploadervideolist."'>".$uploadervideolist."</a>
			</div>		
		</td>";
		$count++;
		if($count == 5) {
			echo "</tr>";
			$count = 0;
		}
		}
		echo "</tbody></table>

		</div>";

		echo "<div style=\"font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;\">";
			$pagecount = 0;
			while($pagecount !== $pages) {
				if($pagecount == 0) {
					echo "Browse Pages:";
				}
				$pagecount++;
				echo "<span style='background-color: #CCC; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;'><a href='/profile.php?user=icanttellyou&page=videos&pagenum=".$pagecount."'>".$pagecount."</a></span>";
			}
		echo "</div>";
		include "watermark.php";
		die();
	} else if ($_GET["page"] == "pvideos") {
		if(!isset($_GET["pagenum"])){
		$page = 1;
		}
		if(isset($_GET["pagenum"])){
		if($_GET["pagenum"] == 1) {
			$page = 1;
		}
		if($_GET["pagenum"] && $_GET["pagenum"] > 1){
			$page = $_GET["pagenum"] * 20;
		}
		}
		
		$page = $page - 1;
		$sql = mysqli_query($connect, "SELECT * FROM videodb"); //instructions for sql
		$count = 0;
		$pages = 0;

		while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
		$count++;
		if($count == 20) {
			$pages++;
			$count = 0;
		}
		}
		echo "<table class=\"commentPostTable\" style=\"width: 865px;\" cellpadding=\"0\" cellspacing=\"0\">
			<tbody><tr class=\"profileHeaders\">
				<td colspan=\"3\">	<div style=\"float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px\">".$Username."'s Private Videos</div>
                </div></td>
            </tr>
			<table class=\"rowsLine normalinner\" style=\"padding-top: 10px;padding-bottom: 10px;\" id=\"cc_718\" width=\"865\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">

			<tbody>
		";
		if(isset($_SESSION["username"])) {
			$result = mysqli_query($connect,"SELECT * FROM users WHERE `username` = '". $_SESSION["username"] ."'");
			$adf = mysqli_fetch_assoc($result);
			$admin = 0;
			if($adf['is_admin'] == 1 || $user == $_SESSION["username"]) { // is logged in?
			$admin = 1;
			} else {
				echo "<tr><td style=\"font-size: 20px;text-align: center;\">You are not allowed to see ".$user."'s private videos!</td></tr>";
				include "watermark.php";
				die();
			}
		} else {
			echo "<tr><td style=\"font-size: 20px;text-align: center;\">You are not allowed to see ".$user."'s private videos!</td></tr>";
			include "watermark.php";
			die();
		}
		$vidlist = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` != '1' AND `Uploader`='".$user."' ORDER by `UploadDate` DESC LIMIT ".$page.", 20");
		$count = 0;

		while ($fetch = mysqli_fetch_assoc($vidlist)) {
		$idvideolist = $fetch['VideoID'];
		$lengthlist = 0;
		if($fetch['VideoLength'] > 3600) {
			$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
		} else { 
			$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
		};
		$namevideolist = htmlspecialchars($fetch['VideoName']);
		$uploadervideolist = htmlspecialchars($fetch['Uploader']);
		$uploadvideolist = $fetch['UploadDate'];
		$viewsvideolist = htmlspecialchars($fetch['ViewCount']);

		if($count == 0) {
			echo "<tr valign='top'>";
		}
		echo "<td width='20%' align='center'>
				<a href='watch.php?v=".$idvideolist."&player=0'>      <div class='v120WrapperOuter'>
			 <div class='v120WrapperInner'>
				<a id='video-url-muP9eH2p2PI' href='watch.php?v=$idvideolist' rel='nofollow'><img title='$namevideolist' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" class='vimg120' qlicon='muP9eH2p2PI' alt='$namevideolist'></a>
			 <div class='video-time'><span id='video-run-time-muP9eH2p2PI'>$lengthlist</span></div>
			 </div>
		  </div></a>
			<div class='moduleFeaturedTitle'><a href='watch.php?v=".$idvideolist."&player=0'>".$namevideolist."</a></div>
			<div class='moduleFeaturedDetails'>
				Added: ".$uploadvideolist."<br>
				by <a href='profile.php?user=".$uploadervideolist."'>".$uploadervideolist."</a>
			</div>		
		</td>";
		$count++;
		if($count == 5) {
			echo "</tr>";
			$count = 0;
		}
		}
		echo "</tbody></table>

		</div>";

		echo "<div style=\"font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;\">";
			$pagecount = 0;
			while($pagecount !== $pages) {
				if($pagecount == 0) {
					echo "Browse Pages:";
				}
				$pagecount++;
				echo "<span style='background-color: #CCC; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;'><a href='/profile.php?user=icanttellyou&page=videos&pagenum=".$pagecount."'>".$pagecount."</a></span>";
			}
		echo "</div>";
		include "watermark.php";
		die();
	} else if ($_GET["page"] == "bulletins") {
		if(!isset($_GET["pagenum"])){
		$page = 1;
		}
		if(isset($_GET["pagenum"])){
		if($_GET["pagenum"] == 1) {
			$page = 1;
		}
		if($_GET["pagenum"] && $_GET["pagenum"] > 1){
			$page = $_GET["pagenum"] * 15;
		}
		}
		
		$page = $page - 1;
		$sql = mysqli_query($connect, "SELECT * FROM bulletins"); //instructions for sql
		$count = 0;
		$pages = 0;

		while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
		$count++;
		if($count == 15) {
			$pages++;
			$count = 0;
		}
		}
		$bullfetch = mysqli_query($connect, "SELECT * FROM bulletins WHERE `user`='".$Username."' ORDER by `date` DESC LIMIT ".$page.", 15"); // calls for channel info
		echo "<center>
		        <table class=\"bulletinTable\" style=\"width:560px\" cellpadding=\"0\" cellspacing=\"0\">
            <tbody><tr class=\"profileHeaders\">
                <td colspan=\"3\">	<div style=\"float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px\">My Bulletin Board</div>
                                            ";
			if (isset($_SESSION['username'])) {
				echo "<div style=\"float: right; padding-right: 5px\"><a href=\"/profile.php?user=".$user."&page=write_bulletin\" class=\"edit\">Write Bulletin</a>
                <div></div>";
			}
                        echo "</div></td>
            </tr>
            <tr class=\"bulletinTitle\">
                <td align=\"center\" class=\"bulletinTopFirstCells\" valign=\"top\"><span class=\"profileTitles\">From</span></td>
                <td align=\"center\" class=\"bulletinTopFirstCells\" valign=\"top\"><span class=\"profileTitles\">Date</span></td>
                <td align=\"center\" valign=\"top\"><span class=\"profileTitles\">Bulletin</span></td>
            </tr>";
		while ($bdf = mysqli_fetch_assoc($bullfetch)) {
		$ID = $bdf['id'];
		$User = htmlspecialchars($bdf['user']);
		$Subject = htmlspecialchars($bdf['subject']);
		$Date = htmlspecialchars($bdf['date']);
                                        echo "<tr class=\"bulletin\">
                    <td align=\"center\"><span class=\"profileTitles\"><a href=\"/profile.php?user=".$User."\">".$User."</a></span></td>
                    <td align=\"center\">".$Date."</td>
                    <td align=\"center\">
                        <a href=\"/profile.php?user=".$Username."&page=bulletin&id=".$ID."\">".$Subject."</a>
                    </td>
                </tr>";
		}
                                               echo "<tr class=\"normalinner\">
                <td colspan=\"3\">";
		echo "<div style=\"font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;\">";
		$pagecount = 0;
		while($pagecount !== $pages) {
			if($pagecount == 0) {
				echo "Browse Pages:";
			}
			$pagecount++;
			echo "<span style='background-color: #CCC; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;'><a href='/profile.php?user=".$user."&page=bulletins&pagenum=".$pagecount."'>".$pagecount."</a></span>";
		}
        echo "</table></center>";
		include "watermark.php";
		die();
	} else if ($_GET["page"] == "bulletin") {
		if(!isset($_GET["id"])){
			die();
		} else {
			$id = $_GET["id"];
		}
		if(isset($_POST["post_reply"])){
			if ($_POST['post_reply'] == "Post Reply") {
			$i = 1; // i does the count
			$id = $id; // get video id so it knows what video you are going to comment
			$comment = $_POST["content"]; // what are you going to comment?
			$commentid = 0; // initialize
			$datenow = date("Y-m-d"); // get the current date

			// Check connection
			if ($connect->connect_error) {
			  die('Connection failed: ' . $conn->connect_error);
			}

			$sqllist = 'SELECT id, commentid, comment, user, date FROM comments ORDER by commentid DESC'; // to count what comment id is next
			$result = $connect->query($sqllist);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
				  if($row["id"] = $id) {
					  $i++;
				  }
			  }
			} else {

			}
			$commentid = $i;
			$username = $_SESSION["username"];
			if($comment[0] === '>') {
				$yes = $comment;
				$comment = "[color=#5dae5d]";
				$comment .= $yes;
				$comment .= "[/color]";
			}
			if(!empty($_SESSION["username"])) {
				$stmt = $connect->prepare("INSERT INTO comments (id, commentid, comment, user, date) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("sisss", $id, $commentid, $comment, $username, $datenow); // prepared statements for inserting comments into db
				$stmt->execute();
			} else {
				echo "You are not logged in.";
			}
		}
		}
		$bullfetch = mysqli_query($connect, "SELECT * FROM bulletins WHERE `id`='".$id."'"); // calls for channel info
		$bdf = mysqli_fetch_assoc($bullfetch);
		$ID = $bdf['id'];
		$User = htmlspecialchars($bdf['user']);
		$Subject = htmlspecialchars($bdf['subject']);
		$Body = htmlspecialchars($bdf['body']);
		$Date = htmlspecialchars($bdf['date']);
		$bbcode = new ChrisKonnertz\BBCode\BBCode();
		$bbcode->ignoreTag('spoiler');
		$bbcode->ignoreTag('youtube');
		$bbcode->ignoreTag('img');
		$rendered = $bbcode->render($Body);
		echo "<center>
		        <td valign=\"top\">
            <div>&nbsp;</div>

            <table class=\"bulletinReadTable\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"
                <tbody><tr class=\"profileHeaders\">
                    <td colspan=\"2\">&nbsp;&nbsp;Bulletin Post </td>
                </tr>

                <tr class=\"rows normalinner\">
                    <td class=\"bulletinRead\" valign=\"top\"><div align=\"center\"><span class=\"profileTitles\">From:</span></div></td>
                    <td class=\"bulletinReadRight\"><span class=\"profileTitles\"><a href=\"/profile.php?user=".$User."\">".$User."</a><br>
				    <br>
				</span></td>
                </tr>
                <tr class=\"rows normalinner\">
                    <td class=\"bulletinRead\" valign=\"top\"><div align=\"center\"><span class=\"profileTitles\">Date:</span></div></td>
                    <td class=\"bulletinReadRight\"><span class=\"profileTitles\">".$Date."</span></td>
                </tr>
                <tr class=\"rows normalinner\">
                    <td class=\"bulletinRead\" valign=\"top\"><div align=\"center\"><span class=\"profileTitles\">Subject:</span></div></td>
                    <td class=\"bulletinReadRight\"><span class=\"profileTitles\">".$Subject."</span></td>
                </tr>
                <tr class=\"rows normalinner\">
                    <td class=\"bulletinReadBottom\" width=\"111\" valign=\"top\"><div align=\"center\"><span class=\"profileTitles\">Body:</span></div></td>
                    <td width=\"447\" valign=\"top\">
                        <div style=\"overflow: flow; width: 447px;word-break:break-all\">
							".$rendered."
						</div>
                    </td>
                </tr>
                </tbody></table>

            <br>
            <center>
                <table class=\"commentPostTable\" style=\"width:560px\" cellspacing=\"0\" cellpadding=\"0\">
                    <tbody><tr class=\"profileHeaders\">
                        <td colspan=\"3\">	<div style=\"float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px\">Bulletin Comments</div>

                            </td>
                    </tr>";
					$sql= mysqli_query($connect, "SELECT * FROM comments WHERE `id`='".$id."' ORDER BY commentid DESC");

					$count = 0;

					while ($searchcomments = mysqli_fetch_assoc($sql)) { // get comments for video
						$usercommentlist = htmlspecialchars($searchcomments['user']); // commente
						$datecommentlist = $searchcomments['date']; // comment date
						$messagecommentlist = htmlspecialchars($searchcomments['comment']); // actual text for comment
						$idcommentlist = $searchcomments['id']; // comment id, to get descending order to work
						$hidden = $searchcomments['hidden']; // hidden comments are for deleted videos
						$PreDate = $searchcomments['date'];
						$DateTime = new DateTime($PreDate);
						$Daate = $DateTime->format('F j Y');
						$bbcode = new ChrisKonnertz\BBCode\BBCode();
						$bbcode->ignoreTag('spoiler');
						$bbcode->ignoreTag('youtube');
						$bbcode->ignoreTag('img');
						$rendered = $bbcode->render($messagecommentlist);
						if ($hidden != 1) {
							echo "<tr class=\"rowsLine normalinner\" id=\"bc_698\">
                                <td class=\"leftBg\" style=\"padding-right: 10px\" width=\"123\" valign=\"top\" align=\"center\">
                                    <span class=\"profileTitles\"><a href=\"/profile.php?user=".$usercommentlist."\">".$usercommentlist."</a></span>
                                    <br>
                                    <br>
                                    <a href=\"/profile.php?user=".$usercommentlist."\"><img src=\"content/profpic/<?php echo $usercommentlist?>.png\" onerror=\"this.src='img/profiledef.png'\" class=\"commentsImg\">
                                    </a></td>
                                <td colspan=\"2\" style=\"position:relative;padding-right: 5px;\" valign=\"top\">
                                    <span class=\"profileTitles\">".$Daate."</span> <br>
                                    <br>
                                    <div style=\"overflow: flow; width: 333px;word-break: break-all\">
                                        ".$rendered."                                    </div>
                                                                    </td>
                            </tr>";
						}
					}
                    echo "                              
                    <tr class=\"commentsMsg\">
                                                <td colspan=\"3\" align=\"center\">";
												if (isset($_SESSION["username"])) {
													echo "
														<div style=\"font-weight:bold;margin-bottom:4px;text-align:left;margin-left:5px\">Post Reply:</div>
														<form action=\"/profile.php?user=".$user."&page=bulletin&id=".$id."\" method=\"POST\" style=\"text-align:left;margin-left:5px\">
															<textarea cols=\"45\" rows=\"3\" maxlength=\"500\" name=\"content\"></textarea><br>
															<input style=\"margin-top:5px\" type=\"submit\" name=\"post_reply\" value=\"Post Reply\">
														</form><br>";
												} else {
													echo "<span class=\"bulletinPost\" style=\"padding-left: 5px; padding-right: 5px\"><a href=\"/web/20180722182904/https://www.bitview.net/login.php\">Please log in</a> to post a reply to this bulletin!<br></span>";
												}
													"</td>
                                            </tr>


                    </tbody></table>
            </center>
            <div>&nbsp;</div>
        </td></center>";
		include "watermark.php";
		die();
	} else if ($_GET["page"] == "write_bulletin") {
		if(isset($_POST["post_bulletin"])){
			if ($_POST['post_bulletin'] == "Post Bulletin") {
			$i = 1; // i does the count
			$subject = $_POST["subject"];
			$body = $_POST["bulletin"]; // what are you going to comment?
			$id = 0; // initialize
			$datenow = date("Y-m-d"); // get the current date

			// Check connection
			if ($connect->connect_error) {
			  die('Connection failed: ' . $conn->connect_error);
			}

			$sqllist = 'SELECT id, date, subject, body, user FROM bulletins ORDER by id DESC'; // to count what comment id is next
			$result = $connect->query($sqllist);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
				$i++;
			  }
			} else {

			}
			$id = $i;
			$username = $_SESSION["username"];
			if($body[0] === '>') {
				$yes = $body;
				$body = "[color=#5dae5d]";
				$body .= $yes;
				$body .= "[/color]";
			}
			if(!empty($_SESSION["username"])) {
				$stmt = $connect->prepare("INSERT INTO bulletins (id, date, subject, body, user) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("issss", $id, $datenow, $subject, $body, $user); // prepared statements for inserting comments into db
				$stmt->execute();
			} else {
				echo "You are not logged in.";
			}
		}
		}
		echo "<div style=\"width: 875px; text-align: left;\">
			<div id=\"mainContent\"> 
		<h2 style=\"margin:0 0 2px\" class=\"bgtext\">Write a bulletin</h2>
		<div style=\"margin-bottom:3px;font-family:arial,helvetica,sans-serif;\" class=\"bgtext\">Bulletins appear on your own and your friends channel pages</div>
		<form action=\"/profile.php?user=".$user."&amp;page=write_bulletin\" method=\"POST\">
		<table style=\"position:relative;right:4px\" cellpadding=\"4px\">
			<tbody><tr>
				<td style=\"font-family:arial,helvetica,sans-serif;color:#222222 !important\" valign=\"middle\"><b class=\"bgtext\">Subject:</b></td>
				<td><input type=\"text\" name=\"subject\" maxlength=\"128\" style=\"width:260px\"></td>
			</tr>
			<tr>
				<td style=\"font-family:arial,helvetica,sans-serif;color:#222222 !important\" valign=\"top\"><b class=\"bgtext\">Bulletin:</b></td>
				<td><textarea maxlength=\"1000\" name=\"bulletin\" cols=\"48\" rows=\"6\"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=\"submit\" name=\"post_bulletin\" value=\"Post Bulletin\"> <a href=\"/profile.php?user=".$user."\"><button type=\"button\">Cancel</button></a></td>
			</tr>
		</tbody></table>
		</form>
		</div>
		</div>";
		include "watermark.php";
		die();
	}
?>
    <table width="865" cellpadding="0" cellspacing="0">
        <tbody><tr>
            <td width="325" valign="top">
                <table class="userTable" cellpadding="0" cellspacing="0">
                    <tbody><tr class="profileHeaders highlightheader">

                        <td colspan="2">
                            <div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">Hello. I'm <?php echo $Username ?></div>
                            <div style="float: right; padding-right: 5px">



                            </div></td>
                    </tr>
                    <tr class="rows">


                        <td width="142" align="left">
                            <img class="aboutImg" src="content/profpic/<?php echo $Username?>.png" onerror="this.src='img/profiledef.png'" class="thumb" width="128">
                        </td>
						
                        <td width="144" align="left">
                                                                                    <span class="profileTitles">Gender: </span> TODO: ADD IT IN THE DB                            <br>
                                                        
                        </td>

                    </tr>

                    <tr class="rows" style="word-break:break-all">
						<td colspan="3">
						<?php if($cdf['aboutme']) {
							echo "                                                        <span class=\"profileTitles\">About Me: </span>".$AboutMe."                            <br><br>
                                                                                   ";
						}
						?>
                                                                                    <span class="profileTitles">Last Login: </span>TODO: ADD IT IN THE DB                            <br>
                                                        <span class="profileTitles">Signed Up: </span><?php echo $RegisteredOn?>                            <br>
                            <span class="profileTitles">URL: </span> <a href="<?php echo $share_link ?>"><?php echo $share_link ?></a>
                        </td>
                    </tr>
                    </tbody></table>

                <div>&nbsp;</div>



                <table class="connectTable" cellpadding="0" cellspacing="0">
                    <tbody><tr class="profileHeaders">
                        <td colspan="5">&nbsp;&nbsp;Connect with <?php echo $Username ?></td>
                    </tr>
                    <tr class="connectRowsTop normalinner">
                        <td width="5">&nbsp;</td>
                        <td width="21" valign="middle"><img src="/img/SendMessage.gif"></td>
                        <td><span class="connectLinks"><?php if (!isset($_SESSION["username"])) {
							echo "<a href=\"javascript:void(0)\" onclick=\"alert(Please log in to send <?php echo $Username ?> a message!)\">";
						} else {
							echo "<a href=\"javascript:void(0)\" onclick=\"alert('The messaging system is not done.')\">";
						}?>Send Message</a></span></td>
                        <td width="21" valign="middle"><img src="/img/AddToFriends.gif"></td>
                        <td><span class="connectLinks"><?php if (!isset($_SESSION["username"])) {
							echo "<a href=\"javascript:void(0)\" onclick=\"alert('Please log in to add ".$Username." to friends!')\">";
						} else {
							echo "<a href=\"javascript:void(0)\" onclick=\"alert('The friends system is not done.')\">";
						}?>Add to Friends</a></span></td>
                    </tr>
                    <tr class="connectRows normalinner">
                        <td width="5">&nbsp;</td>
                        <td width="21" valign="middle"><img src="/img/AddComment.gif" class="connectImages"></td>
                        <td><span class="connectLinks"><?php if (!isset($_SESSION["username"])) {
							echo "<a href=\"javascript:void(0)\" onclick=\"alert('Please log in to comment!')\">";
						} else {
							echo "<a href=\"".$share_link."&page=comment\">";
						}?>Add Comment</a></span></td>
                        <td width="21" valign="middle"><img src="/img/MiniSubscribe.gif"></td>
                        <td><span class="connectLinks"><?php if (!isset($_SESSION["username"])) {
							echo "<a href=\"javascript:void(0)\" onclick=\"alert('Please log in to subscribe!')\">";
						} else {
							echo "<a href=\"javascript:void(0)\" onclick=\"alert('The subscription system is not done.')\">";
						}?>Subscribe</a></span></td>
                    </tr>

                    </tbody></table>

                <div>&nbsp;</div>
				<?php if($bcount > 0) {
					$bullfetch = mysqli_query($connect, "SELECT * FROM bulletins WHERE `user`='".$user."' ORDER by `date` DESC LIMIT 5"); // calls for channel info
                    echo "<table class=\"bulletinTable\" cellpadding=\"0\" cellspacing=\"0\">
                    <tbody><tr class=\"profileHeaders\">
                        <td colspan=\"3\">	<div style=\"float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px\">My Bulletin Board</div>
                                                        <div style=\"float: right; padding-right: 5px\"><a href=\"/profile.php?user=".$user."&page=bulletins\" class=\"edit\">View All Bulletins</a>
                            
                            </div></td>
                    </tr>
                    <tr class=\"bulletinTitle\">
                        <td align=\"center\" class=\"bulletinTopFirstCells\" valign=\"top\"><span class=\"profileTitles\">From</span></td>
                        <td align=\"center\" class=\"bulletinTopFirstCells\" valign=\"top\"><span class=\"profileTitles\">Date</span></td>
                        <td align=\"center\" valign=\"top\"><span class=\"profileTitles\">Bulletin</span></td>
                    </tr>";
						while ($bdf = mysqli_fetch_assoc($bullfetch)) {
							$ID = $bdf['id'];
							$User = htmlspecialchars($bdf['user']);
							$Subject = htmlspecialchars($bdf['subject']);
							$Date = htmlspecialchars($bdf['date']);
							echo "<tr class=\"bulletin\">
							<td align=\"center\"><span class=\"profileTitles\"><a href=\"/profile.php?user=".$User."\">".$User."</a></span></td>
							<td align=\"center\">".$Date."</td>
							<td align=\"center\">
								<a href=\"/profile.php?user=".$User."&page=bulletin&id=".$ID."\">".$Subject."</a>
							</td>
							</tr>";
						}
                    echo "</tbody>
					</table>";
				}
				?>
            </td>

            <td valign="top"><div style="width:15px"></div></td>
            <td width="515px" valign="top">
                <table class="aboutTable" cellpadding="0" cellspacing="0">
                    <tbody><tr class="profileHeaders">
                        <td>	<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">More About Me</div>
                            <div style="float: right; padding-right: 5px">

                            </div></td>
                    </tr>

                    <tr class="rows normalinner">
                        <td>
                            
                            </div>
                            <div class="spaceMaker">
                                <span class="profileTitles">Subscribers: </span> TODO: IMPLEMENT SUBSCRIBERS                                <br>
                            </div>


                            <div class="spaceMaker">
                                <span class="profileTitles">Videos Watched: </span> <?php echo $VidsWatched?>                                <br>
                            </div>


                            <div class="spaceMaker">
                                <span class="profileTitles">Profile Viewed: </span> TODO: IMPLEMENT THIS                                <br>
                            </div>

                                                        <div class="spaceMaker">
                                <span class="profileTitles">Last Login: </span> TODO: IMPLEMENT THIS                                <br>
                            </div>
                            

                            <div class="spaceMaker">
                                <span class="profileTitles">Member Since: </span> <?php echo $RegisteredOn?>                                <br>
                            </div>
						
							<?php 
							if($cdf['prof_website']) {
								echo "<div class=\"spaceMaker\">
									<span class=\"profileTitles\">Personal Website: </span> <a target=\"_blank\" rel=\"nofollow\" href=\"".$Website."\">".$Website."</a>
									<br>
								</div>";
							}
							if($cdf['prof_name']) {
								echo "<div class=\"spaceMaker\">
									<span class=\"profileTitles\">Name: </span> ".$Name."                                    <br>
								</div>";
							}
							
							if($cdf['prof_age']) {
								echo "<div class=\"spaceMaker\">
									<span class=\"profileTitles\">Age: </span> ".$Age."                                    <br>
								</div>";
							}
							
							if($cdf['prof_city']) {
								echo "<div class=\"spaceMaker\">
									<span class=\"profileTitles\">City: </span> ".$City."                                    <br>
								</div>";
							}
							
							if($cdf['prof_hometown']) {
								echo "<div class=\"spaceMaker\">
									<span class=\"profileTitles\">Hometown: </span> ".$Hometown."                                    <br>
								</div>";
							}
							
							if($cdf['prof_country']) {
								echo "<div class=\"spaceMaker\">
									<span class=\"profileTitles\">Country: </span> ".$Country."                                    <br>
								</div>";
							}
							?>
                        </td>
                    </tr>
                    </tbody></table>

                <div>&nbsp;</div>

                <!--Begin Insert My Recent Videos Video Bar Here-->
                                <table class="aboutTable" cellpadding="0" cellspacing="0">
                    <tbody><tr class="profileHeaders">
                        <td>
                            <div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">My Recent Videos</div>
                            <div style="float: right; padding-right: 5px"><a href="/profile.php?user=<?php echo $Username?>&page=videos" class="edit">See All Videos</a>

                                &nbsp;
                            </div></td>
                    </tr>
                    <tr class="normalinner">
                        <td align="center">

                            <div style="padding-left: 1px;">
                                <table width="21" height="121" cellpadding="0" cellspacing="0">
                                    <tbody><tr>
                                        <td><img src="/img/LeftSingleArrowOff.gif" onclick="vids_change(0)" id="vidarr" style="cursor:pointer" border="0"></td>
                                        <td>
                                            <table width="443" height="121" style="background-color: #FFFFFF; " cellpadding="0" cellspacing="0">
                                                <tbody><tr class="normalinner">
                                                    <td style="border-bottom:none;">
													<?php $count = 1;
													while ($count != 5) {
														$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' AND `Uploader`='".$Username."' ORDER by `UploadDate` DESC LIMIT ". $count * 4 - 4 .", 4");
														if($count == 1) {
															echo "<div id=\"vidsl".$count."\">\n";
														} else {
															echo "<div id=\"vidsl".$count."\" style=\"display:none\">\n";
														}
														while ($fetch = mysqli_fetch_assoc($sql)) {
															$idvideolist = $fetch['VideoID'];
															$lengthlist = 0;
															if($fetch['VideoLength'] > 3600) {
																$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
															} else { 
																$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
															};
															$namevideolist = htmlspecialchars($fetch['VideoName']);
															$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
															$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
															$descvideolist = htmlspecialchars($fetch['VideoDesc']);
															$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
															echo "<div class=\"videobarthumbnail_block\" id=\"div_profile_videos_0\">
																<center>
																	<div><a href=\"/watch.php?v=".$idvideolist."\"><img class=\"videobarthumbnail_white\" id=\"img_profile_videos_0\" title='$namevideolist' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" width=\"80\" height=\"60\"></a>
																	<div class='profile video-time'><span id='video-run-time-muP9eH2p2PI'>$lengthlist</span></div></div>
																	<div style=\"font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;\"><a href=\"/watch.php?v=".$idvideolist."\" title=\"".$namevideolist."\">".$namevideolist."</a></div>
																	<div style=\"font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;\">".$uploadvideolist."</div>
																</center>
															</div>";
														}    
														echo "</div>\n";
														$count++;
													}
													?>
													</td>
                                                </tr>
                                                </tbody></table>
                                        </td>
                                        <td><img src="/img/RightSingleArrowOff.gif" onclick="vids_change(2)" id="vidarr2" style="cursor:pointer" border="0"></td>
                                    </tr>
                                    </tbody></table>
                                <script>
                                    function vids_change(num) {
                                        if (num != 0 && num != 4 && document.getElementById("vidsl"+num)) {
                                            document.getElementById("vidsl1").style.display = "none";
                                            if (document.getElementById("vidsl2")) {
                                                document.getElementById("vidsl2").style.display = "none";
                                            }
                                            if (document.getElementById("vidsl3")) {
                                                document.getElementById("vidsl3").style.display = "none";
                                            }
                                            if (document.getElementById("vidsl4")) {
                                                document.getElementById("vidsl4").style.display = "none";
                                            }

                                            document.getElementById("vidarr").setAttribute("onClick","vids_change("+(num - 1)+")");
                                            document.getElementById("vidarr2").setAttribute("onClick","vids_change("+(num + 1)+")");
                                            document.getElementById("vidsl"+num).style.display = "block";
                                        }
                                    }
                                </script>
                            </div>


                        </td>
                    </tr>
                    </tbody></table>

                <!--End Insert My Recent Videos Video Bar Here-->

                <div>&nbsp;</div>
                                                <!--Begin Insert My Friends Video Bar Here-->
                                <table class="aboutTable" cellpadding="0" cellspacing="0">
                    <tbody><tr class="profileHeaders">
                        <td>
                            <div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">My Friends</div>
                            <div style="float: right; padding-right: 5px"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=doinyourmom4&amp;page=friends" class="edit">See All Friends</a>

                                &nbsp;
                            </div></td></tr>
                    <tr class="normalinner">
                        <td align="center">

                            <div style="padding-left: 1px;">
                                <table width="21" height="121" cellpadding="0" cellspacing="0">
                                    <tbody><tr class="normalinner">
                                        <td><img src="/img/LeftSingleArrowOff.gif" onclick="fri_change(0)" style="cursor:pointer" id="friarr" border="0"></td>
                                        <td>
                                            <table width="443" height="121" style="background-color: #FFFFFF; " cellpadding="0" cellspacing="0">
                                                <tbody><tr class="normalinner">
                                                    <td style="border-bottom:none;">
                                                                                                                                                                                                                                                                                            <div id="fril1">                                                            <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=ParadoxAgent"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/MmTcW4ljsz4.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=ParadoxAgent" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=pie1994"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/P19TLoexido.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=pie1994" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=JakeOnline"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/UQU1bIo2JKx.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=JakeOnline" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=Xxxhumanbeingxxx"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/12diEvjHLlL.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=Xxxhumanbeingxxx" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                            </div>                                                                                                                                                                                                                                            <div id="fril2" style="display:none">                                                            <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=Clippy"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/3sCpx53aAUk.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=Clippy" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=white2000ss"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/PT15WqpxtRg.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=white2000ss" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=Realedgenoodle64"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/jkUcTmCdmUb.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=Realedgenoodle64" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=tarciotcb"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/32yzTwWujvJ.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=tarciotcb" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                            </div>                                                                                                                                                                                                                                            <div id="fril3" style="display:none">                                                            <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=Emiliano2008"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/lBV4E94otrD.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=Emiliano2008" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=ASACAPRA"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/img/no_videos_140.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=ASACAPRA" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=PedroTheGamer"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/kZp4sPPDAKz.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=PedroTheGamer" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=MaxThePotato"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/andgiwLuXwH.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=MaxThePotato" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                            </div>                                                                                                                                                                                                                                            <div id="fril4" style="display:none">                                                            <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=Clygro"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/VG6ZrYU6vtA.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=Clygro" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=TacoFilms87"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/ioxWQUU6NE_.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=TacoFilms87" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=Legobot144"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/bO_SH6f4_sB.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=Legobot144" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                    <div class="videobarthumbnail_block" id="div_recent_friends_0">
                                                                <center>
                                                                    <div><a id="href_recent_friends_0" href="/web/20180704185928/http://www.bitview.net/profile.php?user=klasky678"><img class="videobarthumbnail_white" id="img_recent_friends_0" src="/web/20180704185928im_/http://www.bitview.net/u/thmp/RsjsHdyIN8A.jpg" width="80" height="60"></a></div>
                                                                    <div id="title1_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"><a href="/web/20180704185928/http://www.bitview.net/profile.php?user=klasky678" title="FriendlyPlaceHolder">FriendlyPlaceHolder</a></div>
                                                                    <div id="title2_recent_friends_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;"></div>
                                                                </center>
                                                            </div>
                                                                                                                                                                                                                                                                                                                                                        </td>
                                                </tr>
                                                </tbody></table>
                                        </td>
                                        <td><img src="/img/RightSingleArrowOff.gif" onclick="fri_change(2)" style="cursor:pointer" id="friarr2" border="0"></td>
                                    </tr>
                                    </tbody></table>
                                <script>
                                    function fri_change(num) {
                                        if (num != 0 && num != 4 && document.getElementById("fril"+num)) {
                                            document.getElementById("fril1").style.display = "none";
                                            if (document.getElementById("fril2")) {
                                                document.getElementById("fril2").style.display = "none";
                                            }
                                            if (document.getElementById("fril3")) {
                                                document.getElementById("fril3").style.display = "none";
                                            }
                                            if (document.getElementById("fril4")) {
                                                document.getElementById("fril4").style.display = "none";
                                            }

                                            document.getElementById("friarr").setAttribute("onClick","fri_change("+(num - 1)+")");
                                            document.getElementById("friarr2").setAttribute("onClick","fri_change("+(num + 1)+")");
                                            document.getElementById("fril"+num).style.display = "block";
                                        }
                                    }
                                </script>
                            </div>


                        </td>
                    </tr>
                    </tbody></table>

                <!--End Insert My Friends Video Bar Here-->
                <div>&nbsp;</div>
                <table class="commentPostTable" cellpadding="0" cellspacing="0">
                    <tbody><tr class="profileHeaders">
                        <td colspan="3">	<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">My Comments</div>
                            <div style="float: right; padding-right: 5px"><a href="/web/20180722182543/https://www.bitview.net/profile.php?user=PF94onBitView&amp;page=comments" class="edit">View All Comments</a>

                            </div></td>
                    </tr>

					<?php
					$sql= mysqli_query($connect, "SELECT * FROM comments ORDER BY commentid");

					$count = 0;

					while ($searchcomments = mysqli_fetch_assoc($sql)) { // get comments for video
						$usercommentlist = htmlspecialchars($searchcomments['user']); // commente
						$datecommentlist = $searchcomments['date']; // comment date
						$messagecommentlist = htmlspecialchars($searchcomments['comment']); // actual text for comment
						$idcommentlist = $searchcomments['id']; // comment id, to get descending order to work
						$hidden = $searchcomments['hidden']; // hidden comments are for deleted videos
						$PreDate = $searchcomments['date'];
						$DateTime = new DateTime($PreDate);
						$Date = $DateTime->format('F j Y');
						$bbcode = new ChrisKonnertz\BBCode\BBCode();
						$bbcode->ignoreTag('spoiler');
						$bbcode->ignoreTag('youtube');
						$bbcode->ignoreTag('img');
						$rendered = $bbcode->render($messagecommentlist);
						if ($idcommentlist == $Username AND $hidden != 1 AND $count != 3) {
							echo "<tr class=\"rowsLine normalinner\" id=\"cc_718\">
									<td width=\"123\" align=\"center\" valign=\"top\" class=\"leftBg\" style=\"padding-right: 10px\">
										<span class=\"profileTitles\"><a href=\"/profile.php?user=".$usercommentlist."\">".$usercommentlist."</a></span>
										<br>
										<br>
										<a href=\"/profile.php?user=".$usercommentlist."\"><img src=\"content/profpic/".$usercommentlist.".png\" onerror=\"this.src='img/profiledef.png'\" class=\"commentsImg\">
										</a></td>
									<td colspan=\"2\" style=\"padding-right: 5px;position:relative;\" valign=\"top\">
										<span class=\"profileTitles\">".$Date."</span> <br>
										<br>
										<div style=\"overflow: flow; width: 333px;word-break:break-all\">
											".$rendered."                                    </div>
																		</td>
								</tr>";
								$count++;
						}
					}
					?>
                                                                    
                    <tr class="commentsMsg">
                        <td colspan="3" align="center"><span class="bulletinPost" style="padding-left: 5px; padding-right: 5px"><a href="<?php if(isset($_SESSION['username'])) { echo "/profile.php?user=".$Username."&page=comment"; } else { echo "/login.php"; } ?>">Leave a comment</a> for <?php echo $Username?>. The comments you post will be visible to anyone who views <?php echo $Username?>'s profile. <br></span></td>
                    </tr>


                    </tbody></table>

            </td>
        </tr>
        </tbody></table>
</div>        </div>
<?php include("footer.php"); ?>