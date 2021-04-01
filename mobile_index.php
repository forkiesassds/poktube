<!DOCTYPE html PUBLIC "-//WAPFORUM/DTD XHTML Mobile 1.0//EN" "http://wapforum.org/DTD/xhtml.mobile.dtd">
<?php include "db.php"?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>Recently Featured</title>
	<link href="mobile_base.css" rel="stylesheet" type="text/css">
</head>
<body vlink="#FFDF8C" link="#FFDF8C" bgcolor="#333333" alink="#FFDF8C">

	<table width="100%"><tbody><tr>
		<td valign="top"><a id="top"></a><a href="#browse">Menu</a>
		</td>
		<td valign="top" align="right"><div id="logoDiv">
			<a href="index.php"><img src="logo_mobile.png" alt="SquareBracket logo" border="0"></a>
		</div></td>
	</tr></tbody></table>


<table class="promoBanner">
	<tbody><tr>
		<td>Welcome to the squareBracket mobile website</td>
	</tr>
</tbody></table>

	<div class="vList">
		<?php
$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY RAND() DESC LIMIT 10"); //instructions for sql, also WHERE with ORDER BY works, icty, you said that it didn't in FEB 24 2021, you're wrong.

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
$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolist = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
$categoryvideolist = htmlspecialchars($fetch['VideoCategory']);
echo "<div class='vEntry'>
			<table>
				<tbody><tr valign='top'>
				<td>
							<a href='https://web.archive.org/web/20071016051140/rtsp://rtsp.youtube.com/youtube/videos/1R-V846_Mm8/video.3gp?w=1'><img src='/content/thumbs/$idvideolist.png' onerror=\"this.src='img/default_mobile.png'\" alt='video' class='vSmallStill' width='40' height='30' border='0'></a>
	
				</td>
				<td class='vInfo'>
					<div class='vTitle'><a href='/web/20071016051140/http://m.youtube.com/details?v=1R-V846_Mm8&amp;s=mrf&amp;p=1&amp;w=1'>$namevideolist</a></div>
					<div class='vRuntime'>$lengthlist&nbsp;&nbsp;&nbsp; <font color='#FF0000'>
</font></div>
				</td>
				</tr>
			</tbody></table>
		</div>";
};
//<a href='watch.php?v=$idvideolist&player=1'>Flash Player</a> - <a href='watch.php?v=$idvideolist&player=2'>ActiveX</a>
?>
	</div>


<div id="botPagination">	<div class="vPager">
		Pg. 1
		|
			<a href="/web/20071016051140/http://m.youtube.com/index?s=mrf&amp;p=2&amp;w=1">Next&gt;</a>
	</div>
</div>

	<div id="menu">
		<a id="browse"></a>
		<div class="pageTitle">Menu</div>

		<form action="/web/20071016051140/http://m.youtube.com/results?w=1" method="get">
			<div class="menuItem">
				<img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/1_key.gif" alt="1." width="11" height="11">
				<a id="search"></a>
					<input accesskey="1" name="q" type="text" size="7" class="searchTextField">
					<input name="submit" type="submit" value="Find">
			</div>
		</form>

		<div class="menuItem"><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/2_key.gif" alt="2." width="11" height="11" border="0"> <a accesskey="2" href="/web/20071016051140/http://m.youtube.com/?s=mrf&amp;w=1">Featured</a></div>
		<div class="menuItem"><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/3_key.gif" alt="3." width="11" height="11" border="0"> <a accesskey="3" href="/web/20071016051140/http://m.youtube.com/?s=mmr&amp;w=1">Recently Added</a></div>
		<div class="menuItem"><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/4_key.gif" alt="4." width="11" height="11" border="0"> <a accesskey="4" href="/web/20071016051140/http://m.youtube.com/?s=mmp&amp;w=1">Most Viewed</a></div>
		<div class="menuItem"><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/5_key.gif" alt="5." width="11" height="11" border="0"> <a accesskey="5" href="/web/20071016051140/http://m.youtube.com/?s=mtr&amp;w=1">Top Rated</a></div>
		<div class="menuItem"><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/6_key.gif" alt="6." width="11" height="11" border="0"> <a accesskey="6" href="/web/20071016051140/http://m.youtube.com/?s=mmf&amp;w=1">Top Favorites</a></div>
		<div class="menuItem"><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/7_key.gif" alt="7." width="11" height="11" border="0"> <a accesskey="7" href="/web/20071016051140/http://m.youtube.com/?s=mrfp&amp;w=1">People</a></div>
		<div class="menuItem"><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/8_key.gif" alt="8." width="11" height="11" border="0"> <a accesskey="8" href="/web/20071016051140/http://m.youtube.com/?s=mrfe&amp;w=1">Entertainment</a></div>
		<div class="menuItem"><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/9_key.gif" alt="9." width="11" height="11" border="0"> <a accesskey="9" href="/web/20071016051140/http://m.youtube.com/?s=mrfm&amp;w=1">Grab Bag</a></div>

		
		<div><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/icn_home_11x11.gif" alt="home icon" width="11" height="11" border="0"> <a href="/web/20071016051140/http://m.youtube.com/?w=1">Home</a></div>
		<div><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/icn_back_11x11.gif" alt="back to top icon " width="11" height="11" border="0"> <a href="#top">Back to Top</a></div>
		<div><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/icn_help_11x11.gif" alt="help icon" width="11" height="11" border="0"> <a href="/web/20071016051140/http://m.youtube.com/help?w=1">Help</a></div>
		<div><img src="/web/20071016051140im_/http://m.youtube.com/img/mobile/icn_help_11x11.gif" alt="terms icon" width="11" height="11" border="0"> <a href="/web/20071016051140/http://m.youtube.com/terms?w=1">Terms and Privacy Policy</a></div>
		
	</div>




	<div class="footer">Copyright © 2007 YouTube, Inc.</div>
	<div class="footer">Switch to: <a href="https://web.archive.org/web/20071016051140/http://www.youtube.com/?nomobile=1&amp;w=1">Classic View</a></div>
	


</body></html>