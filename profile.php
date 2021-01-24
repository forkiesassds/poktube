<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>YouTube - Your Digital Video Repository</title>
<link rel="icon" href="/web/20050701000942im_/http://www.youtube.com/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/web/20050701000942im_/http://www.youtube.com/favicon.ico" type="image/x-icon">
<link href="styles_alt.css" rel="stylesheet" type="text/css">
<link rel="alternate" type="application/rss+xml" title="YouTube " "="" recently="" added="" videos="" [rss]"="" href="https://web.archive.org/web/20050701000942/http://www.youtube.com/rss/global/recently_added.rss">
</head>

<?php
include "header2.php";
error_reporting(1); //fixing the query issue breaks comment sections.
?>
<?php
$mysqli = new mysqli("localhost", "root", "", "users");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM `users` WHERE `username` = \"" . $_GET['user'] . "\"";;
$result = $mysqli->query($query);

/* numeric array */
$row = $result->fetch_array(MYSQLI_NUM);
printf ("%s (title name: %s)\n %s %s %s", $row[0], $row[1], $row[2], $row[3], $row[4], $_GET['user']);

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>

<?php
  $connect = new mysqli("localhost", "root", "", "video");
  $SQL = "SELECT * FROM `videos` WHERE `video_id` = " . $_GET['v'];
  $query = mysqli_query($SQL);
  $result = mysqli_fetch_array($query);
  $uploadtime = date("F jS, Y", strtotime($row[3]));
?>

<div class="page_title">User Profile</div>
<div style="overflow:hidden;width:800px;margin:0 auto">
    <div style="width:500px;float:right;margin:0 15px 0 0;border:1px solid #CCCCCC">
        <div style="padding: 15px 15px 15px 15px">
            <div style="font-size: 18px; font-weight: bold; color: #CC6633; margin-bottom: 2px;">
                Hello. I'm <?php echo $result[$row[1]] ?? $row[1];?>.
            </div>
            <div class="profile_info">
                Signed up:
            </div>
            <?php echo $uploadtime ?? $uploadtime;?>                             <div class="profile_info">
                    Name:
                </div>
                <?php echo $result[$row[5]] ?? $row[5];?>                                        <div class="profile_info">
                    Gender:
                </div>
                <?php echo $result[$row[6]] ?? $row[6];?>                                    <div class="profile_info">
                    About Me:
                </div>
                <?php echo $result[$row[7]] ?? $row[7];?>                                    <div class="profile_info">
                    Hobbies:
                </div>
                If bitview was a script I'd buy it                                        <div class="profile_info">
                    Favorite Books:
                </div>
                But good thing it's not a script                                        <div class="profile_info">
                    Favorite Music:
                </div>
                Because it's easier to use                    </div>
    </div>
    <div style="width:258px;float:left">
        <div style="background:#e5ecf9;border-radius:4px;padding:12px;text-align:center">
                            <div style="font-size:14px;font-weight:bold;color:#003366"><?php echo $result[$row[1]] ?? $row[1];?></div>
                <a href="/web/20171203212115/http://www.bitview.net/watch.php?v=ELorde6F2Sf">
                    <img src="pfp/<?php echo $result[$row[1]] ?? $row[1];?>.png" class="thumb" width="128" height="128">
                </a>
        </div>
        <div style="background:#eeeedd;border-radius:4px;padding:8px;margin: 17px auto 0;width:65%">
            <div style="font-size:14px;font-weight:bold;margin:0 0 8px;color:#666633">
                Latest 4 users
            </div>
                            <div style="border-bottom:1px dashed #CCCC66;margin:0 0 8px;padding:0 0 10px">
                    <div style="margin: 0 0 5px;font-weight:bold;font-size:12px">
                        <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=OrBuLon">OrBuLon</a>
                    </div>
                    <div>
                        <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=OrBuLon&amp;page=videos"><img src="/web/20171203212115im_/http://www.bitview.net/img/icon_vid.gif" style="vertical-align:text-bottom"></a> (<a href="/web/20171203212115/http://www.bitview.net/profile.php?user=OrBuLon&amp;page=videos">0</a>) <div style="display:inline-block;display:inline;margin:0 3px">|</div> <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=OrBuLon&amp;page=favorites"><img src="/web/20171203212115im_/http://www.bitview.net/img/icon_fav.gif" style="vertical-align:text-bottom"></a> (<a href="/web/20171203212115/http://www.bitview.net/profile.php?user=OrBuLon&amp;page=favorites">0</a>)
                    </div>
                </div>
                            <div style="border-bottom:1px dashed #CCCC66;margin:0 0 8px;padding:0 0 10px">
                    <div style="margin: 0 0 5px;font-weight:bold;font-size:12px">
                        <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Clygro">Clygro</a>
                    </div>
                    <div>
                        <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Clygro&amp;page=videos"><img src="/web/20171203212115im_/http://www.bitview.net/img/icon_vid.gif" style="vertical-align:text-bottom"></a> (<a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Clygro&amp;page=videos">1</a>) <div style="display:inline-block;display:inline;margin:0 3px">|</div> <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Clygro&amp;page=favorites"><img src="/web/20171203212115im_/http://www.bitview.net/img/icon_fav.gif" style="vertical-align:text-bottom"></a> (<a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Clygro&amp;page=favorites">1</a>)
                    </div>
                </div>
                            <div style="border-bottom:1px dashed #CCCC66;margin:0 0 8px;padding:0 0 10px">
                    <div style="margin: 0 0 5px;font-weight:bold;font-size:12px">
                        <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=ng1">ng1</a>
                    </div>
                    <div>
                        <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=ng1&amp;page=videos"><img src="/web/20171203212115im_/http://www.bitview.net/img/icon_vid.gif" style="vertical-align:text-bottom"></a> (<a href="/web/20171203212115/http://www.bitview.net/profile.php?user=ng1&amp;page=videos">1</a>) <div style="display:inline-block;display:inline;margin:0 3px">|</div> <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=ng1&amp;page=favorites"><img src="/web/20171203212115im_/http://www.bitview.net/img/icon_fav.gif" style="vertical-align:text-bottom"></a> (<a href="/web/20171203212115/http://www.bitview.net/profile.php?user=ng1&amp;page=favorites">0</a>)
                    </div>
                </div>
                            <div style="border-bottom:1px dashed #CCCC66;margin:0 0 8px;padding:0 0 10px">
                    <div style="margin: 0 0 5px;font-weight:bold;font-size:12px">
                        <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Winduss">Winduss</a>
                    </div>
                    <div>
                        <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Winduss&amp;page=videos"><img src="/web/20171203212115im_/http://www.bitview.net/img/icon_vid.gif" style="vertical-align:text-bottom"></a> (<a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Winduss&amp;page=videos">0</a>) <div style="display:inline-block;display:inline;margin:0 3px">|</div> <a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Winduss&amp;page=favorites"><img src="/web/20171203212115im_/http://www.bitview.net/img/icon_fav.gif" style="vertical-align:text-bottom"></a> (<a href="/web/20171203212115/http://www.bitview.net/profile.php?user=Winduss&amp;page=favorites">0</a>)
                    </div>
                </div>
                        <div>
                <div style="font-weight:bold;margin-bottom:5px">Icon Key:</div>
                <div style="margin:0 0 6px">
                    <img src="/web/20171203212115im_/http://www.bitview.net/img/icon_vid.gif" style="vertical-align: text-bottom"> - Videos
                </div>
                <div>
                    <img src="/web/20171203212115im_/http://www.bitview.net/img/icon_fav.gif" style="vertical-align: text-bottom"> - Favorites
                </div>
            </div>
        </div>
    </div>
</div>

</body></html>