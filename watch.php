<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>YouTube - Your Digital Video Repository</title>
<link rel="icon" href="/web/20050701000942im_/http://www.youtube.com/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/web/20050701000942im_/http://www.youtube.com/favicon.ico" type="image/x-icon">
<link href="http://localhost/poktube/styles_alt.css" rel="stylesheet" type="text/css">
<link rel="alternate" type="application/rss+xml" title="YouTube " "="" recently="" added="" videos="" [rss]"="" href="https://web.archive.org/web/20050701000942/http://www.youtube.com/rss/global/recently_added.rss">
</head>

<?php
include "header2.php";
error_reporting(0); //fixing the query issue breaks comment sections.
?>
<?php
$mysqli = new mysqli("localhost", "root", "", "video");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM `videos` WHERE `video_id` = " . $_GET['v'];;
$result = $mysqli->query($query);

/* numeric array */
$row = $result->fetch_array(MYSQLI_NUM);
//printf ("%s (title name: %s)\n %s %s %s (tags: %s) [uploaded: %s]", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $_GET['v']);

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>

<?php
  $connect = new mysqli("localhost", "root", "", "video");
  $SQL = "SELECT * FROM `videos` WHERE `video_id` = " . $_GET['v'];
  $AAAA = "UPDATE videos SET views = 1 WHERE video_id = " . $_GET['v'];
  $query = mysqli_query($SQL);
  $result = mysqli_fetch_array($query);
  $result = mysqli_fetch_array($query2);
  $uploadtime = date("F jS, Y", strtotime($row[6]));
?>

<?php
  $connect = new mysqli("localhost", "root", "", "video");
  $AAAA = "UPDATE videos SET views = 5 WHERE video_id = " . $_GET['v'];
  $query = mysqli_query($AAAA);
  $result = mysqli_fetch_array($query);
?>

<div class="page_title">
    <?php echo $result[$row[1]] ?? $row[1];?></div>
        <div style="width:800px;margin:0 auto">
    <div style="width:480px;margin:0 15px 0 0;float:left">
        <div class="share_links">
            <a href="https://web.archive.org/web/20171203210958/mailto:/?subject=BitView (Classic 2005 YouTube clone)&amp;body=http://www.bitview.net/watch.php?v=bdqvxjDXaTd">Share</a>
             //
            <a href="#comments">Comment</a>
             //
            <a href="/web/20171203210958/http://www.bitview.net/a/favorite_video.php?v=bdqvxjDXaTd">Add to Favorites</a>
             //
                            <a href="/web/20171203210958/http://www.bitview.net/send_message.php?to=Adel123Essam">Contact Me</a>
                                </div>
        <div style="width:427px;height:360px" class="videocontainer" id="video_height" oncontextmenu="return false;">
    <script>
        function v_play() {
            if (player.ended || player.paused) {
                player.play();
                document.getElementById("left").style.backgroundImage = "url('img/ply0.png')";
            } else {
                player.pause();
                document.getElementById("left").style.backgroundImage = "url('img/ply1.png')";
            }
        }

        function v_mute() {
            if (player.muted) {
                document.getElementById("right").style.backgroundImage = "url('img/vol1.png')";
                player.muted = false;
            } else {
                document.getElementById("right").style.backgroundImage = "url('img/vol0.png')";
                player.muted = true;
            }
        }
    </script>
    <div style="overflow:hidden">
    <video id="video_player" autoplay="" width="427" height="320">
        <source src="videos/<?php echo $result[$row[2]] ?? $row[2];?>" type="video/mp4">
        <object type="application/x-shockwave-flash" data="Late2005.swf" width="427" height="320">
            <param name="movie" value="Late2005.swf">
            <param name="allowFullScreen" value="false">
            <param name="FlashVars" value="flv=videos/<?php echo $result[$row[2]] ?? $row[2];?>">
        </object>
    </video>
    </div>
    <div id="video_controls" style="display: block;">
        <div id="left" onclick="v_play()" style="background-image: url(img/ply1.png);"></div>
        <div id="right" onclick="v_mute()"></div>
        <div id="mid"><div id="midin" style="width: 1.96057%;"></div></div>
    </div>
    <script>document.getElementById("video_controls").style.display = "block"</script>
</div>
<script>
    player = document.getElementById('video_player');
    if(!player.canPlayType || !player.canPlayType('video/mp4').replace(/no/, '')) {
        document.getElementById("video_controls").outerHTML = "";
        document.getElementById("video_height").style.height = "330px";
    }
    player.addEventListener('timeupdate', function() {
        var percentage = (100 / player.duration) * player.currentTime;
        document.getElementById('midin').style.width = percentage + "%";
    }, false);
    progressBar = document.getElementById("mid");
    progressBar.addEventListener("click", function(e) {
        player.currentTime = (e.offsetX / this.offsetWidth) * player.duration;
        if (player.ended || player.paused) {
            player.play();
            document.getElementById("left").style.backgroundImage = "url('img/ply0.png')";
        }
    });
    player.addEventListener("ended", function() {
        document.getElementById("left").style.backgroundImage = "url('img/ply1.png')";
    });

</script>        <div style="width:427px;margin:0 auto">
                            <div class="videodescription">
                    <?php echo $result[$row[3]] ?? $row[3];?>                </div>
                                        <div style="font-size: 12px;margin: 5px 0px 10px 0px;color: #333333;">
                    Tags //
                                        <?php echo $result[$row[5]] ?? $row[5];?>
                                    </div>
                        <div style="font-size:11px;color:#333333">
                <div style="margin:0 0 5px 0">
                    Added: <?php echo $uploadtime ?? $uploadtime;?> by <img src="pfp/<?php echo $result[$row[4]] ?? $row[4];?>.png" width="32" height="32"> <a href="profile.php?user=<?php echo $result[$row[4]] ?? $row[4];?>"><?php echo $result[$row[4]] ?? $row[4];?></a> //
                    <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=Adel123Essam&amp;page=videos">Videos</a> (2) | <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=Adel123Essam&amp;page=favorites">Favorites</a> (3)
                </div>
                <div>
                    Views: <?php echo $result[$row[7]] ?? $row[7];?> | <a href="#comments">Comments</a>: 3                </div>
            </div>
        </div>
        <div style="background-image:#E5ECF9;background:#E5ECF9;padding:7px 0 21px;margin:15px 0 10px 0;text-align:center">
                            <div style="font-size:11px;font-weight:bold;color:#CC6600;padding:5px 0 5px 0">Share this video! Copy and paste this link:</div>
                <input size="50" type="text" readonly="readonly" id="embed_link" style="font-size:10px;text-align:center" value="<?php echo $_SERVER['REQUEST_URI']?>" onclick="document.getElementById('embed_link').select();document.getElementById('embed_link').focus()">
                    </div>
        <div style="padding-bottom:5px;font-weight:bold;color:#444">Comment on this video:</div>
        <br>
        <a name="comments"></a>
		<div class="comments"></div>
<script>
const comments_page_id = <?php echo $result[$row[0]] ?? $row[0];?>; // This number should be unique on every page
fetch("comments.php?page_id=" + comments_page_id).then(response => response.text()).then(data => {
	document.querySelector(".comments").innerHTML = data;
	document.querySelectorAll(".comments .write_comment_btn, .comments .reply_comment_btn").forEach(element => {
		element.onclick = event => {
			event.preventDefault();
			document.querySelectorAll(".comments .write_comment").forEach(element => element.style.display = 'none');
			document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "']").style.display = 'block';
			document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "'] input[name='name']").focus();
		};
	});
	document.querySelectorAll(".comments .write_comment form").forEach(element => {
		element.onsubmit = event => {
			event.preventDefault();
			fetch("comments.php?page_id=" + comments_page_id, {
				method: 'POST',
				body: new FormData(element)
			}).then(response => response.text()).then(data => {
				element.parentElement.innerHTML = data;
			});
		};
	});
});
</script>

                        </div>
    <div style="width:305px;float:left">
        <div class="videos_box" style="width:98%">
            <div class="videos_box_head">
                <div style="display:table;width:100%">
                    <div style="font-size:12px;display:table-cell">
                        More videos                   </div>
                    <div style="font-size:12px;color:#444;font-weight:normal;text-align:right;display:table-cell">
                        <a href="/web/20171203210958/http://www.bitview.net/results.php?search=Review++Classic++Old+good+days++BitView++2005+YouTube++Old+School++Nostalgia">See more Results</a>
                    </div>
                </div>
            </div>
                                                <div class="videos_box_in" style="padding-bottom:9px">
                        <div style="float:left;width:115px;margin:0 10px 0 0">
                            <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=xh1zmlaPxfv">
                                <img src="/web/20171203210958im_/http://www.bitview.net/u/thmp/xh1zmlaPxfv.jpg" class="thumb" width="100" height="75">
                            </a>
                        </div>
                        <div style="float:left;width:159px">
                            <div class="v_video_title">
                                <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=xh1zmlaPxfv">la muerte de edgar</a>
                            </div>
                            <div style="font-size:11px;color:#444;margin:3px 0 5px">
                                <div style="padding:0 0 2px 0">Added: December 03, 2017</div>
                                <div style="padding:0 0 2px 0">By: <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=paris201">paris201</a></div>
                                <div style="padding:0 0 2px 0">Views: 11</div>
                                <div style="padding:0 0 2px 0">Comments: 0</div>
                            </div>
                        </div>
                    </div>
                                    <div class="videos_box_in" style="padding-bottom:9px">
                        <div style="float:left;width:115px;margin:0 10px 0 0">
                            <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=gl747iaisf2">
                                <img src="/web/20171203210958im_/http://www.bitview.net/u/thmp/gl747iaisf2.jpg" class="thumb" width="100" height="75">
                            </a>
                        </div>
                        <div style="float:left;width:159px">
                            <div class="v_video_title">
                                <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=gl747iaisf2">first tts spanish bitview video</a>
                            </div>
                            <div style="font-size:11px;color:#444;margin:3px 0 5px">
                                <div style="padding:0 0 2px 0">Added: December 03, 2017</div>
                                <div style="padding:0 0 2px 0">By: <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=paris201">paris201</a></div>
                                <div style="padding:0 0 2px 0">Views: 7</div>
                                <div style="padding:0 0 2px 0">Comments: 0</div>
                            </div>
                        </div>
                    </div>
                                    <div class="videos_box_in" style="padding-bottom:9px">
                        <div style="float:left;width:115px;margin:0 10px 0 0">
                            <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=UfGFX0ujlRJ">
                                <img src="/web/20171203210958im_/http://www.bitview.net/u/thmp/UfGFX0ujlRJ.jpg" class="thumb" width="100" height="75">
                            </a>
                        </div>
                        <div style="float:left;width:159px">
                            <div class="v_video_title">
                                <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=UfGFX0ujlRJ">Camcorder testing</a>
                            </div>
                            <div style="font-size:11px;color:#444;margin:3px 0 5px">
                                <div style="padding:0 0 2px 0">Added: December 03, 2017</div>
                                <div style="padding:0 0 2px 0">By: <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=IDontKnowDraw">IDontKnowDraw</a></div>
                                <div style="padding:0 0 2px 0">Views: 8</div>
                                <div style="padding:0 0 2px 0">Comments: 1</div>
                            </div>
                        </div>
                    </div>
                                    <div class="videos_box_in" style="padding-bottom:9px">
                        <div style="float:left;width:115px;margin:0 10px 0 0">
                            <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=jy1e0lOjcKQ">
                                <img src="/web/20171203210958im_/http://www.bitview.net/u/thmp/jy1e0lOjcKQ.jpg" class="thumb" width="100" height="75">
                            </a>
                        </div>
                        <div style="float:left;width:159px">
                            <div class="v_video_title">
                                <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=jy1e0lOjcKQ">EL CHICHICUILOTE</a>
                            </div>
                            <div style="font-size:11px;color:#444;margin:3px 0 5px">
                                <div style="padding:0 0 2px 0">Added: December 03, 2017</div>
                                <div style="padding:0 0 2px 0">By: <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=LKY2DSN">LKY2DSN</a></div>
                                <div style="padding:0 0 2px 0">Views: 12</div>
                                <div style="padding:0 0 2px 0">Comments: 3</div>
                            </div>
                        </div>
                    </div>
                                    <div class="videos_box_in" style="padding-bottom:9px">
                        <div style="float:left;width:115px;margin:0 10px 0 0">
                            <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=PRi64r2OziO">
                                <img src="/web/20171203210958im_/http://www.bitview.net/u/thmp/PRi64r2OziO.jpg" class="thumb" width="100" height="75">
                            </a>
                        </div>
                        <div style="float:left;width:159px">
                            <div class="v_video_title">
                                <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=PRi64r2OziO">How to Customize your YouTube channel (OLD YOUTUBE)</a>
                            </div>
                            <div style="font-size:11px;color:#444;margin:3px 0 5px">
                                <div style="padding:0 0 2px 0">Added: December 03, 2017</div>
                                <div style="padding:0 0 2px 0">By: <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=Adel123Essam">Adel123Essam</a></div>
                                <div style="padding:0 0 2px 0">Views: 27</div>
                                <div style="padding:0 0 2px 0">Comments: 3</div>
                            </div>
                        </div>
                    </div>
                                    <div class="videos_box_in" style="padding-bottom:9px">
                        <div style="float:left;width:115px;margin:0 10px 0 0">
                            <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=L7qUVvGqicT">
                                <img src="/web/20171203210958im_/http://www.bitview.net/u/thmp/L7qUVvGqicT.jpg" class="thumb" width="100" height="75">
                            </a>
                        </div>
                        <div style="float:left;width:159px">
                            <div class="v_video_title">
                                <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=L7qUVvGqicT">BitView Review (BitReView)</a>
                            </div>
                            <div style="font-size:11px;color:#444;margin:3px 0 5px">
                                <div style="padding:0 0 2px 0">Added: December 03, 2017</div>
                                <div style="padding:0 0 2px 0">By: <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=KnotSnappy">KnotSnappy</a></div>
                                <div style="padding:0 0 2px 0">Views: 40</div>
                                <div style="padding:0 0 2px 0">Comments: 7</div>
                            </div>
                        </div>
                    </div>
                                    <div class="videos_box_in" style="padding-bottom:9px">
                        <div style="float:left;width:115px;margin:0 10px 0 0">
                            <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=NZquot8mx2Z">
                                <img src="/web/20171203210958im_/http://www.bitview.net/u/thmp/NZquot8mx2Z.jpg" class="thumb" width="100" height="75">
                            </a>
                        </div>
                        <div style="float:left;width:159px">
                            <div class="v_video_title">
                                <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=NZquot8mx2Z">Jake Nye The Science Guy</a>
                            </div>
                            <div style="font-size:11px;color:#444;margin:3px 0 5px">
                                <div style="padding:0 0 2px 0">Added: December 03, 2017</div>
                                <div style="padding:0 0 2px 0">By: <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=KnotSnappy">KnotSnappy</a></div>
                                <div style="padding:0 0 2px 0">Views: 22</div>
                                <div style="padding:0 0 2px 0">Comments: 1</div>
                            </div>
                        </div>
                    </div>
                                    <div class="videos_box_in" style="padding-bottom:9px">
                        <div style="float:left;width:115px;margin:0 10px 0 0">
                            <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=9xFyXt6JKhP">
                                <img src="/web/20171203210958im_/http://www.bitview.net/u/thmp/9xFyXt6JKhP.jpg" class="thumb" width="100" height="75">
                            </a>
                        </div>
                        <div style="float:left;width:159px">
                            <div class="v_video_title">
                                <a href="/web/20171203210958/http://www.bitview.net/watch.php?v=9xFyXt6JKhP">BitView Promo</a>
                            </div>
                            <div style="font-size:11px;color:#444;margin:3px 0 5px">
                                <div style="padding:0 0 2px 0">Added: December 02, 2017</div>
                                <div style="padding:0 0 2px 0">By: <a href="/web/20171203210958/http://www.bitview.net/profile.php?user=BigMushroomFan">BigMushroomFan</a></div>
                                <div style="padding:0 0 2px 0">Views: 95</div>
                                <div style="padding:0 0 2px 0">Comments: 6</div>
                            </div>
                        </div>
                    </div>
                                    </div>
        <div style="width:198px ;margin:13px 0 0 0">
            <div style="font-weight:bold;color:#676767;margin:10px 0px 5px 0px">
                Related Tags:
            </div>
            <div style="padding: 0px 0px 5px 0px;color:#8e8e8e">
                                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= How-to"> How-to</a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= BitReView"> BitReView</a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search=muerte ">muerte </a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search=Jake">Jake</a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= Brent"> Brent</a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search=2005 youtube">2005 youtube</a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= viejo "> viejo </a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= bitview "> bitview </a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= bitview "> bitview </a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= 2005 "> 2005 </a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= Science"> Science</a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search=spanish ">spanish </a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search=share ">share </a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= The"> The</a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= KnotSnappy"> KnotSnappy</a></div>
                                            <div style="padding:0 0 6px 0">» <a href="/web/20171203210958/http://www.bitview.net/results.php?search= BMF"> BMF</a></div>
                                                </div>
        </div>
    </div>
</div>
<div style="clear:both"></div>        <div class="footer">
    <a href="/web/20171203210958/http://www.bitview.net/whats_new.php">What's New</a> | <a href="/web/20171203210958/http://www.bitview.net/about.php">About Us</a> | <a href="/web/20171203210958/http://www.bitview.net/help.php">Help</a> | <a href="/web/20171203210958/http://www.bitview.net/terms.php">Terms of Use</a> | <a href="/web/20171203210958/http://www.bitview.net/privacy.php">Privacy Policy</a> | Copyright © 2017 BitView
</div>    

</body></html>