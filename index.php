<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>YouTube - Your Digital Video Repository</title>
<link rel="icon" href="/web/20050701000942im_/http://www.youtube.com/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/web/20050701000942im_/http://www.youtube.com/favicon.ico" type="image/x-icon">
<link href="styles_alt.css" rel="stylesheet" type="text/css">
<link rel="alternate" type="application/rss+xml" title="YouTube " "="" recently="" added="" videos="" [rss]"="" href="https://web.archive.org/web/20050701000942/http://www.youtube.com/rss/global/recently_added.rss">
</head>

<?php
include "header.php";
error_reporting(2); //we don't fucking care.
?>

<?php
$mysqli = new mysqli("localhost", "root", "", "video");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'video';
try {
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error
    exit('Failed to connect to database!');
}

$query = "SELECT * FROM `videos` WHERE `video_id` order by RAND() LIMIT 5";
$result = $mysqli->query($query);

/* numeric array */
$row = $result->fetch_array(MYSQLI_NUM);

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>

<?php
  $connect = new mysqli("localhost", "root", "", "video");
  $SQL = "SELECT * FROM `videos` WHERE `video_id` order by RAND() LIMIT 5";
  $query = mysqli_query($SQL);
  $result = mysqli_fetch_array($query);
  $stmt = $pdo->prepare('SELECT COUNT(*) AS total_comments FROM comments WHERE page_id =' . $row[0]);
  $stmt->execute([ $_GET['page_id'] ]);
  $uploadtime = date("M jS Y", strtotime($row[6]));
  $comments_info = $stmt->fetch(PDO::FETCH_ASSOC);
?>
        <div class="main">
    <img src="img/logo.png" alt="PokTube">
    <div class="slogan">
        Your Digital Video Repository
    </div>
    <form action="results.php" method="get" data-children-count="1">
        <input type="text" size="35" name="search" maxlength="128" class="search_box"><br>
        <input type="submit" value="Search Videos">
    </form>
    <div class="big_links">
        <a href="my_videos_upload.php">Upload Videos</a>   <div class="big_links_seperator">//</div>   <a href="videos.php">Browse Videos</a><img src="new.gif" alt="New">
    </div><!--
            <div class="home_tags">
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= Kelly"> Kelly</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= Brent"> Brent</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= 11pixels"> 11pixels</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=Bitview">Bitview</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= Test"> Test</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=it kinda sucks">it kinda sucks</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=palaryzer">palaryzer</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= music"> music</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= finger"> finger</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= eleven"> eleven</a> :
                            <a style="font-size: 17px" href="/web/20171203210931/http://www.bitview.net/results.php?search=nuclear power">nuclear power</a> :
                            <a style="font-size: 17px" href="/web/20171203210931/http://www.bitview.net/results.php?search= thorium"> thorium</a> :
                            <a style="font-size: 17px" href="/web/20171203210931/http://www.bitview.net/results.php?search= uranium"> uranium</a> :
                            <a style="font-size: 17px" href="/web/20171203210931/http://www.bitview.net/results.php?search= fission"> fission</a> :
                            <a style="font-size: 17px" href="/web/20171203210931/http://www.bitview.net/results.php?search= science"> science</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=arkansas">arkansas</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= say yogurt in the discord Jan"> say yogurt in the discord Jan</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= i am trying to break the homepage screen to see if it works and if not then i will cry"> i am trying to break the homepage screen to see if it works and if not then i will cry</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=0">0</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=muerte ">muerte </a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= edgar "> edgar </a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= dead "> dead </a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=2005 youtube">2005 youtube</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=2005 Youtube">2005 Youtube</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=funy">funy</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=videos">videos</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=Me At The Zoo">Me At The Zoo</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= Bad Film"> Bad Film</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= Funny"> Funny</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= Comedy"> Comedy</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= Parody"> Parody</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=scary">scary</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=Windows NT 3.51">Windows NT 3.51</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= NT"> NT</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= New Technology"> New Technology</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= zombo.com"> zombo.com</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= zombocom"> zombocom</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= welcome to zombocom"> welcome to zombocom</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= NT 3.51"> NT 3.51</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=perspective films">perspective films</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=dab">dab</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search=Welcome ">Welcome </a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= new channel "> new channel </a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= first video"> first video</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= Review"> Review</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= BitReView"> BitReView</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= (BitReView)"> (BitReView)</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= KnotSnappy"> KnotSnappy</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= video"> video</a> :
                            <a style="font-size: 12px" href="/web/20171203210931/http://www.bitview.net/results.php?search= original"> original</a> :
                        <div style="font-size: 14px; font-weight: bold; margin-top: 10px;"><a href="/web/20171203210931/http://www.bitview.net/tags.php">See More Tags</a></div>
        </div>-->
                <div class="videos_box">
            <div class="videos_box_head">
                <div style="float:left">
                    Featured Videos
                </div>
                <div style="float:right">
                    <a href="videos.php">See More Videos</a>
                </div>
            </div>
            <div class="videos_box_in">
                            <div class="videos_box_sct">
                    <a href="watch.php?v=<?php echo $result[$row[0]] ?? $row[0];?>">
                        <img src="thumbnail\<?php echo $result[$row[0]] ?? $row[0];?>.png" class="thumb" width="120" height="90"> <!-- this is a fucking poor way of loading thumbnails, make them jpegs once this goes public. -->
                    </a>
                    <div>
                        <a href="watch.php?v=<?php echo $result[$row[0]] ?? $row[0];?>" class="videos_box_title"><?php echo $result[$row[1]] ?? $row[1];?></a>
                        <div class="videos_info">
                            Added: <?php echo $uploadtime ?? $uploadtime;?><br>
                            by <a href="profile.php?user=<?php echo $result[$row[4]] ?? $row[4];?>"><?php echo $result[$row[4]] ?? $row[4];?></a>
                        </div>
                        <div class="videos_info">
                            Views: <?php echo $result[$row[7]] ?? $row[7];?> | Comments: <?=$comments_info['total_comments']?>                        </div>
                    </div>
                </div>
				<?php
$sql = mysqli_query($connect, "SELECT * FROM videodb ORDER BY ViewCount DESC LIMIT 10"); //instructions for sql

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$idvideolist = $fetch['VideoID'];
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolist = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
echo "<div class='moduleEntry'>
						<table width='565' cellpadding='0' cellspacing='0' border='0'>
							<tbody><tr valign='top'>
								<td><a href='watch.php?v=$idvideolist'><img src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" class='moduleEntryThumb' width='120' height='90'></a>
								</td>
								<td width='100%'>
									<div class='moduleEntryTitle'>
										<a href='watch.php?v=".$idvideolist."'>".$namevideolist."</a>
									</div>
										<div class='moduleEntryDescription'>
									".$descvideolist."
									</div>
							
									<div class='moduleEntryDetails'>
										Added: ".$uploadvideolist." by <a href='profile.php?user=".$uploadervideolist."'>".$uploadervideolist."</a>
									</div>
									<div class='moduleEntryDetails'>
										Views: ".$viewsvideolist." // Comments: [not ''indexed'' yet]
										</div>
									<nobr>
			<img style='border:0px; padding:0px; margin:0px; vertical-align:middle;' src='img/star_sm_bg.gif'>
			<img style='border:0px; padding:0px; margin:0px; vertical-align:middle;' src='img/star_sm_bg.gif'>
			<img style='border:0px; padding:0px; margin:0px; vertical-align:middle;' src='img/star_sm_bg.gif'>
			<img style='border:0px; padding:0px; margin:0px; vertical-align:middle;' src='img/star_sm_bg.gif'>
			<img style='border:0px; padding:0px; margin:0px; vertical-align:middle;' src='img/star_sm_bg.gif'>
	</nobr>


								</td>
							</tr>
						</tbody></table>
					</div>";
}
?>
                            <!--<div class="videos_box_sct">
                    <a href="/web/20171203210931/http://www.bitview.net/watch.php?v=bdqvxjDXaTd">
                        <img src="/web/20171203210931im_/http://www.bitview.net/u/thmp/bdqvxjDXaTd.jpg" class="thumb" width="120" height="90">
                    </a>
                    <div>
                        <a href="/web/20171203210931/http://www.bitview.net/watch.php?v=bdqvxjDXaTd" class="videos_box_title">BitView (Classic 2005 YouTube clone)</a>
                        <div class="videos_info">
                            Added: Dec 03, 2017<br>
                            by <a href="/web/20171203210931/http://www.bitview.net/profile.php?user=Adel123Essam">Adel123Essam</a>
                        </div>
                        <div class="videos_info">
                            Views: 42 | Comments: 3                        </div>
                    </div>
                </div>
                            <div class="videos_box_sct">
                    <a href="/web/20171203210931/http://www.bitview.net/watch.php?v=32BsLMvNye3">
                        <img src="/web/20171203210931im_/http://www.bitview.net/u/thmp/32BsLMvNye3.jpg" class="thumb" width="120" height="90">
                    </a>
                    <div>
                        <a href="/web/20171203210931/http://www.bitview.net/watch.php?v=32BsLMvNye3" class="videos_box_title">BitView - Overview</a>
                        <div class="videos_info">
                            Added: Dec 03, 2017<br>
                            by <a href="/web/20171203210931/http://www.bitview.net/profile.php?user=Oldcpv3">Oldcpv3</a>
                        </div>
                        <div class="videos_info">
                            Views: 19 | Comments: 1                        </div>
                    </div>
                </div>
                            <div class="videos_box_sct">
                    <a href="/web/20171203210931/http://www.bitview.net/watch.php?v=L7qUVvGqicT">
                        <img src="/web/20171203210931im_/http://www.bitview.net/u/thmp/L7qUVvGqicT.jpg" class="thumb" width="120" height="90">
                    </a>
                    <div>
                        <a href="/web/20171203210931/http://www.bitview.net/watch.php?v=L7qUVvGqicT" class="videos_box_title">BitView Review (BitReView)</a>
                        <div class="videos_info">
                            Added: Dec 03, 2017<br>
                            by <a href="/web/20171203210931/http://www.bitview.net/profile.php?user=KnotSnappy">KnotSnappy</a>
                        </div>
                        <div class="videos_info">
                            Views: 40 | Comments: 7                        </div>
                    </div>
                </div>
                            <div class="videos_box_sct">
                    <a href="/web/20171203210931/http://www.bitview.net/watch.php?v=fHBNhQKRdiN">
                        <img src="/web/20171203210931im_/http://www.bitview.net/u/thmp/fHBNhQKRdiN.jpg" class="thumb" width="120" height="90">
                    </a>
                    <div>
                        <a href="/web/20171203210931/http://www.bitview.net/watch.php?v=fHBNhQKRdiN" class="videos_box_title">Hi I'm opti</a>
                        <div class="videos_info">
                            Added: Dec 03, 2017<br>
                            by <a href="/web/20171203210931/http://www.bitview.net/profile.php?user=opti">opti</a>
                        </div>
                        <div class="videos_info">
                            Views: 16 | Comments: 3                        </div>
                    </div>-->
                </div>
                        </div>
        </div>
    </div>        <div class="footer">
    <a href="/web/20171203210931/http://www.bitview.net/whats_new.php">What's New</a> | <a href="/web/20171203210931/http://www.bitview.net/about.php">About Us</a> | <a href="/web/20171203210931/http://www.bitview.net/help.php">Help</a> | <a href="/web/20171203210931/http://www.bitview.net/terms.php">Terms of Use</a> | <a href="/web/20171203210931/http://www.bitview.net/privacy.php">Privacy Policy</a> | Copyright © 2021 PokTube
</div>    

</body>

</body></html>