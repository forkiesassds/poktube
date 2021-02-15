<html><!-- machid: 62 --><head>

	
	<title>YouTube - Broadcast Yourself.</title>

	<link rel="stylesheet" href="styles_yts1146707330.css" type="text/css">
	<link rel="stylesheet" href="base_yts1152842891.css" type="text/css">
	<link rel="stylesheet" href="watch_yts1152671111.css" type="text/css">
	<link rel="icon" href="/web/20060719070832im_/http://youtube.com/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/web/20060719070832im_/http://youtube.com/favicon.ico" type="image/x-icon">
	
	<meta name="description" content="Share your videos with friends and family">
	<meta name="keywords" content="video,sharing,camera phone,video phone">

	<link rel="alternate" title="YouTube - [RSS]" href="/web/20060719070832/http://youtube.com/rssls">

	<script type="text/javascript" src="/web/20060719070832js_/http://youtube.com/js/ui.js"></script>
</head>

<body onload="performOnLoadFunctions();">
<?php
$mysqli = new mysqli("localhost", "root", "", "video");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM `videos` WHERE `video_id` = 1";
$result = $mysqli->query($query);

/* numeric array */
$row = $result->fetch_array(MYSQLI_NUM);
printf ("%s (title name: %s)\n %s %s %s", $row[0], $row[1], $row[2], $row[3], $row[4]);

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>

<?php
  $SQL = mysqli_connect("localhost", "root", "", "video");
  $query = mysqli_query($SQL,"SELECT * FROM videos");
  $result = mysqli_fetch_array($query);
?>
<div id="baseDiv">
			<div id="logoTagDiv">
		<a href="/web/20060719070832/http://youtube.com/"><img src="logo_tagline_sm.gif" alt="YouTube" width="250" height="48" border="0"></a>
	</div>

		<div id="utilDiv">
			<a href="/web/20060719070832/http://youtube.com/signup"><strong>Sign Up</strong></a>
			<span class="utilDelim">|</span>
			<a href="/web/20060719070832/http://youtube.com/signup?next=/">Log In</a>
			<span class="utilDelim">|</span>
			<a href="/web/20060719070832/http://youtube.com/browse?s=rw">Viewing History</a>
			<span class="utilDelim">|</span>
			<a href="/web/20060719070832/http://youtube.com/t/help_center">Help</a>
	</div>
	<form name="logoutForm" method="post" action="/web/20060719070832/http://youtube.com/index">
		<input type="hidden" name="action_logout" value="1">
	</form>

	
	<div id="searchDiv">
				<form name="searchForm" id="searchForm" method="get" action="/web/20060719070832/http://youtube.com/results">
			<input tabindex="1" type="text" name="search" maxlength="128" id="searchField" value="">&nbsp;
			<select name="search_type">
				<option value="search_videos">Videos</option>
				<option value="search_users">Channels</option>
				<option value="search_groups">Groups</option>
				<option value="search_playlists">Playlists</option>
			</select>
			<input type="submit" name="search" value="Search">
		</form>
	

	</div>

	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr><td>
		<div id="gNavDiv">
		<!-- thank you Spiffy Corners (http://www.spiffycorners.com/) for the rounded corner goodness.  RESPECT!  -->
				
				<div class="ltab">
				<b class="rcs">
				<b class="rcs1"><b></b></b>
				<b class="rcs2"><b></b></b>
				<b class="rcs3"></b>
				<b class="rcs4"></b>
				<b class="rcs5"></b>
				</b> <div class="tabContent selected">
				<a href="/web/20060719070832/http://youtube.com/index">Home</a>
				</div>
				</div>
				
				<div class="tab">
				<b class="rc">
				<b class="rc1"><b></b></b>
				<b class="rc2"><b></b></b>
				<b class="rc3"></b>
				<b class="rc4"></b>
				<b class="rc5"></b>
				</b> <div class="tabContent">
				<a href="/web/20060719070832/http://youtube.com/browse?s=mp">Videos</a>
				</div>
				</div>
				
				<div class="tab">
				<b class="rc">
				<b class="rc1"><b></b></b>
				<b class="rc2"><b></b></b>
				<b class="rc3"></b>
				<b class="rc4"></b>
				<b class="rc5"></b>
				</b> <div class="tabContent">
				<a href="/web/20060719070832/http://youtube.com/members?ms30">Channels</a>
				</div>
				</div>
				
				<div class="tab">
				<b class="rc">
				<b class="rc1"><b></b></b>
				<b class="rc2"><b></b></b>
				<b class="rc3"></b>
				<b class="rc4"></b>
				<b class="rc5"></b>
				</b> <div class="tabContent">
				<a href="/web/20060719070832/http://youtube.com/groups_main">Groups</a>
				</div>
				</div>
				
				<div class="tab">
				<b class="rc">
				<b class="rc1"><b></b></b>
				<b class="rc2"><b></b></b>
				<b class="rc3"></b>
				<b class="rc4"></b>
				<b class="rc5"></b>
				</b> <div class="tabContent">
				<a href="/web/20060719070832/http://youtube.com/categories">Categories</a>
				</div>
				</div>
				
				<div class="rtab">
				<b class="rc">
				<b class="rc1"><b></b></b>
				<b class="rc2"><b></b></b>
				<b class="rc3"></b>
				<b class="rc4"></b>
				<b class="rc5"></b>
				</b> <div class="tabContent">
				<a href="/web/20060719070832/http://youtube.com/my_videos_upload">Upload</a>
				</div>
				</div>
		</div>
	</td></tr>
	<tr><td>
		<div id="gSubNavDiv">&nbsp;
				<a href="/web/20060719070832/http://youtube.com/my_videos">My Videos</a>
						<span style="padding: 0px 8px;">|</span>
				<a href="/web/20060719070832/http://youtube.com/my_favorites">My Favorites</a>
						<span style="padding: 0px 8px;">|</span>
				<a href="/web/20060719070832/http://youtube.com/my_friends?sort=n">My Friends</a>
						<span style="padding: 0px 8px;">|</span>
				<a href="/web/20060719070832/http://youtube.com/my_messages">My Inbox</a>
						<span style="padding: 0px 8px;">|</span>
				<a href="/web/20060719070832/http://youtube.com/subscription_center">My Subscriptions</a>
						<span style="padding: 0px 8px;">|</span>
				<a href="/web/20060719070832/http://youtube.com/my_playlists">My Playlists</a>
						<span style="padding: 0px 8px;">|</span>
				<a href="/web/20060719070832/http://youtube.com/groups_my">My Groups</a>
						<span style="padding: 0px 8px;">|</span>
				<a href="/web/20060719070832/http://youtube.com/profile">My Profile</a>
			&nbsp;
		</div>
	</td></tr>
	</tbody></table>

<script type="text/javascript" src="/web/20060719070832js_/http://youtube.com/js/video_bar_yts1151040842.js"></script>

<script language="JavaScript">
</script>

<div id="hpMainContent">
			<div class="hpContentBlock">
		<!-- <div id="hpSVidAboutLink"><a href="#">Advertise on YouTube</a></div> -->
		<div id="hpSVidHeader">Director Videos</div>
		<div>
			<div class="hpSVidEntry " style="margin-bottom: 0px;">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/cthru?C6C162tm_9DUSDhY8JQAr1d_FHkHyuav6EBql0UD5KUxBnTO2xDDNSf0i_cinz6G7H0Dj8fZ7YNuadS8UIzxyhpYsSRikJHzze5od8gZks-nBFskuxE0aBTIk6M1qRgwzOzWv5iA-SI4eeqP7yzxZhrupYeW87C4L6FbuHK9cDFcueybKeDf004SdQ7dX79huf-3XCiR2wI=" target="_parent"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static7.sjl.youtube.com/vi/x7GscL5GYy0/2.jpg" class="vimg80"></a></div>
				<div class="vtitle xsmallText">
				
				<a href="/web/20060719070832/http://youtube.com/cthru?C6C162tm_9DUSDhY8JQAr1d_FHkHyuav6EBql0UD5KUxBnTO2xDDNSf0i_cinz6G7H0Dj8fZ7YNuadS8UIzxyhpYsSRikJHzze5od8gZks-nBFskuxE0aBTIk6M1qRgwzOzWv5iA-SI4eeqP7yzxZhrupYeW87C4L6FbuHK9cDFcueybKeDf004SdQ7dX79huf-3XCiR2wI=" target="_parent">My circus video</a>
				</div>
				
				
			</div>
			<div class="hpSVidEntry " style="margin-bottom: 0px;">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/cthru?iRXcIIYutHlR9713lnBQPy6Pe0_Thse45EeGZ21vS1tQjmx_beoAGY5yhZeMCWmcgmnVJGoKc51bphEwGKlKqUCOLjE9WbpyeNrcXqHn8LtCd_fWL6HXbc-Oxs8vncijWXHhdN7-BmofqUhiQrXpdhocR1tjgAQCNy1ru-An3Ry20L1JIjIQEU2-cxxC76dP4ZVIJDIE-iY=" target="_parent"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static14.sjl.youtube.com/vi/UMf40daefsI/2.jpg" class="vimg80"></a></div>
				<div class="vtitle xsmallText">
				
				<a href="/web/20060719070832/http://youtube.com/cthru?iRXcIIYutHlR9713lnBQPy6Pe0_Thse45EeGZ21vS1tQjmx_beoAGY5yhZeMCWmcgmnVJGoKc51bphEwGKlKqUCOLjE9WbpyeNrcXqHn8LtCd_fWL6HXbc-Oxs8vncijWXHhdN7-BmofqUhiQrXpdhocR1tjgAQCNy1ru-An3Ry20L1JIjIQEU2-cxxC76dP4ZVIJDIE-iY=" target="_parent">Mortal Kombat Theme</a>
				</div>
				
				
			</div>
			<div class="hpSVidEntry " style="margin-bottom: 0px;">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/cthru?24kyhjZsIZNslw-2OT9nKOzdjp7VtvBn2sDQZJvLR_9eFzZyp4JeS_vnu2vzFWXuvfO3hU1Jmf0TegHUrrXz2u9ocoT8Sx79HxqS3zTPalJPH6KvFP5F2-91DWis5LExaxPtJryiLDx84yflAKTAgEYy3DqlYgqu1E0_mUQUG57aB3dmjMCQV_LJ-fOkvtEj_RGk9hV1t-E=" target="_parent"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static12.sjl.youtube.com/vi/7u93g20ecf8/2.jpg" class="vimg80"></a></div>
				<div class="vtitle xsmallText">
				
				<a href="/web/20060719070832/http://youtube.com/cthru?24kyhjZsIZNslw-2OT9nKOzdjp7VtvBn2sDQZJvLR_9eFzZyp4JeS_vnu2vzFWXuvfO3hU1Jmf0TegHUrrXz2u9ocoT8Sx79HxqS3zTPalJPH6KvFP5F2-91DWis5LExaxPtJryiLDx84yflAKTAgEYy3DqlYgqu1E0_mUQUG57aB3dmjMCQV_LJ-fOkvtEj_RGk9hV1t-E=" target="_parent">A Day At The Races: Towers of London</a>
				</div>
				
				
			</div>
			<div class="hpSVidEntry " style="margin-bottom: 0px;">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/cthru?1BLecIAyvAhi-fS4GpOWlPNP72tyn_flSxtCHasHZq87kbITLA6XeblknHz7NlO1cMmuVQt0vs5eU3ivTzmURIDBdgRoM030Yp7svcQ-018mEO5O5KfrLNok3ewJmpDuezQy8uIMM6-icVKU8HV4AIVsibDPlsuq_tSag9KFB47qg-4qDOrrnAWI7Y87upW4gRbQU21zbeM=" target="_parent"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static2.sjl.youtube.com/vi/u1z6OCRJVks/2.jpg" class="vimg80"></a></div>
				<div class="vtitle xsmallText">
				
				<a href="/web/20060719070832/http://youtube.com/cthru?1BLecIAyvAhi-fS4GpOWlPNP72tyn_flSxtCHasHZq87kbITLA6XeblknHz7NlO1cMmuVQt0vs5eU3ivTzmURIDBdgRoM030Yp7svcQ-018mEO5O5KfrLNok3ewJmpDuezQy8uIMM6-icVKU8HV4AIVsibDPlsuq_tSag9KFB47qg-4qDOrrnAWI7Y87upW4gRbQU21zbeM=" target="_parent">The Five Second Rule</a>
				</div>
				
				
			</div>
		<div class="lclear" style="height: 1px;"></div>
		</div>
	</div> <!-- end hpContentBlock -->

 
		<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content">		<div class="headerTitle">
			<div class="headerTitleRight">
				<a href="/web/20060719070832/http://youtube.com/browse?s=mp">See More Videos</a>
			</div>
			<span>Featured Videos</span>
		</div>
</div>
	</div>

	<div class="vListBox">
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
			
				<td><a href="video.php?v=<?php echo $result[$row[0]] ?? $row[0];?>"><img src="pfp\<?php echo $result[$row[4]] ?? $row[4];?>.png" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="video.php?v=<?php echo $result[$row[0]] ?? $row[0];?>"><?php echo $result[$row[1]] ?? $row[1];?></a><br>
						<span class="runtime">04:46</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDesc4wGR4-SeuJ0">
	<?php echo $result[$row[3]] ?? $row[3];?>
	</span>
		<span id="RemainvidDesc4wGR4-SeuJ0" style="display: none"><?php echo $result[$row[3]] ?? $row[3];?></span>
		<span id="MorevidDesc4wGR4-SeuJ0" class="smallText">... (<a href="#" class="eLink" onclick="showInline('RemainvidDesc4wGR4-SeuJ0'); hideInline('MorevidDesc4wGR4-SeuJ0'); hideInline('BeginvidDesc4wGR4-SeuJ0'); showInline('LessvidDesc4wGR4-SeuJ0'); return false;">more</a>)</span>
		<span id="LessvidDesc4wGR4-SeuJ0" style="display: none" class="smallText">(<a href="#" class="eLink" onclick="hideInline('RemainvidDesc4wGR4-SeuJ0'); hideInline('LessvidDesc4wGR4-SeuJ0'); showInline('BeginvidDesc4wGR4-SeuJ0'); showInline('MorevidDesc4wGR4-SeuJ0'); return false;">less</a>)</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=Star" class="dg">Star</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Wars" class="dg">Wars</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Comedy" class="dg">Comedy</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Spin-off" class="dg">Spin-off</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Parody" class="dg">Parody</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Darth" class="dg">Darth</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Vader" class="dg">Vader</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Supermarket" class="dg">Supermarket</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=lightsaber" class="dg">lightsaber</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=force" class="dg">force</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Channel" class="dg">Channel</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=101" class="dg">101</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Madison" class="dg">Madison</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=WI" class="dg">WI</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Wisconsin" class="dg">Wisconsin</a></div>
						<span class="grayText">Added:</span> 1 week ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=23&amp;sort=video_view_count" class="dg">Comedy</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=blamesocietyfilms"><?php echo $result[$row[4]] ?? $row[4];?></a><br>
						<span class="grayText">Views:</span> 379,054
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
	</nobr>
		<div class="rating">4823 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=hs_OchfmBc8"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static15.sjl.youtube.com/vi/hs_OchfmBc8/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=hs_OchfmBc8">Funky Blues Harmonica!!</a><br>
						<span class="runtime">02:18</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDeschs_OchfmBc8">
	harmonica gives man the blues<br><br> 
learn how to do this..check out <br><br> 
my profile for more info. and subscribe
	</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=harmonica" class="dg">harmonica</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=blues" class="dg">blues</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=explosion" class="dg">explosion</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=mouth" class="dg">mouth</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Ronnie" class="dg">Ronnie</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Shellist" class="dg">Shellist</a></div>
						<span class="grayText">Added:</span> 1 week ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=10&amp;sort=video_view_count" class="dg">Music</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=RonnieShellist">RonnieShellist</a><br>
						<span class="grayText">Views:</span> 62,954
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
	</nobr>
		<div class="rating">785 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=ScqCsden5Xk"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static15.sjl.youtube.com/vi/ScqCsden5Xk/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=ScqCsden5Xk">Crowd during Punchline set yells "YOUTUBE"</a><br>
						<span class="runtime">00:04</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDescScqCsden5Xk">
	I totally got the crowd to yell "Youtube" at the show in Sayreville, New Jersey. I think I should officially be the King of Youtube for this video...or this video should at least be featured!
	</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=Punchline" class="dg">Punchline</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=New" class="dg">New</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Jersey" class="dg">Jersey</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Youtube" class="dg">Youtube</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=bologna" class="dg">bologna</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=crowd" class="dg">crowd</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=jumping" class="dg">jumping</a></div>
						<span class="grayText">Added:</span> 2 days ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=10&amp;sort=video_view_count" class="dg">Music</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=cmxpunch">cmxpunch</a><br>
						<span class="grayText">Views:</span> 69,524
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
	</nobr>
		<div class="rating">558 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=EtOoQFa5ug8"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static14.sjl.youtube.com/vi/EtOoQFa5ug8/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=EtOoQFa5ug8">DJ Ted Stevens Techno Remix: "A Series of Tubes"</a><br>
						<span class="runtime">03:10</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDescEtOoQFa5ug8">
	Paul Holcomb from The Bold Headed Broadcast mixed this techno version of Ted Stevens' now infamous "Series Of Tubes" speech and Gavin (that is me) from 13tongimp.com made a video out of it.
	</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=ted" class="dg">ted</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=stevens" class="dg">stevens</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=internet" class="dg">internet</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=net" class="dg">net</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=neutrality" class="dg">neutrality</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=tubes" class="dg">tubes</a></div>
						<span class="grayText">Added:</span> 4 days ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=10&amp;sort=video_view_count" class="dg">Music</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=13tongimp">13tongimp</a><br>
						<span class="grayText">Views:</span> 46,241
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
	</nobr>
		<div class="rating">273 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=TyXn7rkumdE"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static1.sjl.youtube.com/vi/TyXn7rkumdE/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=TyXn7rkumdE">Ozzy02</a><br>
						<span class="runtime">00:42</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDescTyXn7rkumdE">
	Here is Ozzy and his mirror friend xD
	</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=ozzy" class="dg">ozzy</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=pug" class="dg">pug</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=puppy" class="dg">puppy</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=dog" class="dg">dog</a></div>
						<span class="grayText">Added:</span> 2 weeks ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=15&amp;sort=video_view_count" class="dg">Pets &amp; Animals</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=dmcwebd">dmcwebd</a><br>
						<span class="grayText">Views:</span> 72,193
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
	</nobr>
		<div class="rating">515 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=3Xo5GY4kDXg"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static11.sjl.youtube.com/vi/3Xo5GY4kDXg/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=3Xo5GY4kDXg">Ron Patrick Jet VW 4-06</a><br>
						<span class="runtime">01:12</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDesc3Xo5GY4kDXg">
	Ron Patrick's Jet-powered VW Beetle
	</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=Jet" class="dg">Jet</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Car" class="dg">Car</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=VW" class="dg">VW</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=volkswagen" class="dg">volkswagen</a></div>
						<span class="grayText">Added:</span> 2 months ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=2&amp;sort=video_view_count" class="dg">Autos &amp; Vehicles</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=RalphVideo">RalphVideo</a><br>
						<span class="grayText">Views:</span> 100,034
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
	</nobr>
		<div class="rating">683 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=mWKHFZOTGXY"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static15.sjl.youtube.com/vi/mWKHFZOTGXY/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=mWKHFZOTGXY">Cannon Firing 101</a><br>
						<span class="runtime">02:28</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDescmWKHFZOTGXY">
	Drama Nutz proudly presents, how to (or rather not to) fire a cannon...Enjoy!!
	</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=Cannon" class="dg">Cannon</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Firing" class="dg">Firing</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Drama" class="dg">Drama</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Nutz" class="dg">Nutz</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Education" class="dg">Education</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=101" class="dg">101</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Stupid" class="dg">Stupid</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=Dangerous" class="dg">Dangerous</a></div>
						<span class="grayText">Added:</span> 2 days ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=24&amp;sort=video_view_count" class="dg">Entertainment</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=DCG23">DCG23</a><br>
						<span class="grayText">Views:</span> 296,487
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
	</nobr>
		<div class="rating">1844 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=wFlYw9awR5o"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static1.sjl.youtube.com/vi/wFlYw9awR5o/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=wFlYw9awR5o">war</a><br>
						<span class="runtime">01:23</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDescwFlYw9awR5o">
	16.7.06 war in haifa. hisbllah attak haifa
	</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=haifa" class="dg">haifa</a></div>
						<span class="grayText">Added:</span> 2 days ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=25&amp;sort=video_view_count" class="dg">News &amp; Blogs</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=1000red">1000red</a><br>
						<span class="grayText">Views:</span> 263,177
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
	</nobr>
		<div class="rating">1240 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=rZb2VlDyYvk"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static1.sjl.youtube.com/vi/rZb2VlDyYvk/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=rZb2VlDyYvk">UFO Over New York City</a><br>
						<span class="runtime">00:43</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDescrZb2VlDyYvk">
	"UFOs over New York and I ain't too surprised."-John Lennon<br><br> 
If I hadn't seen it with my own eyes, I wouldn't believe it myself!!! Can someone please explain to me what this is??? Thanks in advance. My friend Dino Sorbello (www.tripwave.com) shot it out his window overlooking the east village. What is the explanation?<br><br> 
<br><br> 
This page dedicated to Andy
	</span>
		<span id="RemainvidDescrZb2VlDyYvk" style="display: none">"UFOs over New York and I ain't too surprised."-John Lennon<br><br> 
If I hadn't seen it with my own eyes, I wouldn't believe it myself!!! Can someone please explain to me what this is??? Thanks in advance. My friend Dino Sorbello (www.tripwave.com) shot it out his window overlooking the east village. What is the explanation?<br><br> 
<br><br> 
This page dedicated to Andy Kaufman, Lynne Margulies, Alan Abel, Loren Coleman and Timothy Green Beckley. I'd dedicate it to John A. Keel too but he'd probably be insulted! <br><br> 
<br><br> 
This UFO footage is featured in the movie "Punk Rock Zombie Kung Fu Catfight" ( http://www.peterbernard.com/przkfcf ) which I made under my real name.<br><br> 
Breaking a cardinal Andy Kaufman rule, I'm going to tell you I'm really Peter Bernard, and on YouTube I make cartoons called Power People with actors in the U.S. and England.<br><br> 
For more by me please go to http://www.powerpeopleonline.com<br><br> 
or subscribe to my videos here under the name pbmachinima. Thanks!</span>
		<span id="MorevidDescrZb2VlDyYvk" class="smallText">... (<a href="#" class="eLink" onclick="showInline('RemainvidDescrZb2VlDyYvk'); hideInline('MorevidDescrZb2VlDyYvk'); hideInline('BeginvidDescrZb2VlDyYvk'); showInline('LessvidDescrZb2VlDyYvk'); return false;">more</a>)</span>
		<span id="LessvidDescrZb2VlDyYvk" style="display: none" class="smallText">(<a href="#" class="eLink" onclick="hideInline('RemainvidDescrZb2VlDyYvk'); hideInline('LessvidDescrZb2VlDyYvk'); showInline('BeginvidDescrZb2VlDyYvk'); showInline('MorevidDescrZb2VlDyYvk'); return false;">less</a>)</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=UFO" class="dg">UFO</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=flying" class="dg">flying</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=saucer" class="dg">saucer</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=new" class="dg">new</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=york" class="dg">york</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=city" class="dg">city</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=nyc" class="dg">nyc</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=peterbernard" class="dg">peterbernard</a></div>
						<span class="grayText">Added:</span> 3 days ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=26&amp;sort=video_view_count" class="dg">Science &amp; Technology</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=johnnysaucer">johnnysaucer</a><br>
						<span class="grayText">Views:</span> 637,701
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
	</nobr>
		<div class="rating">2587 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
		<div class="vEntry">
			<table class="vTable"><tbody><tr>
				<td><a href="/web/20060719070832/http://youtube.com/watch?v=WOPHMidcxhQ"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static1.sjl.youtube.com/vi/WOPHMidcxhQ/2.jpg" class="vimg"></a></td>
				<td class="vinfo">
					<div class="vtitle">
						<a href="/web/20060719070832/http://youtube.com/watch?v=WOPHMidcxhQ">The Jaegerr Report episode 1</a><br>
						<span class="runtime">03:38</span>
					</div>
					<div class="vdesc">	<span id="BeginvidDescWOPHMidcxhQ">
	Retarded spoof on the colbert report =)
	</span>
</div>
					<div class="vfacets">
						<div class="vtagLabel"><span class="grayText">Tags:</span></div>
						<div class="vtagValue"><a href="/web/20060719070832/http://youtube.com/results?search=spoof" class="dg">spoof</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=retarded" class="dg">retarded</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=galipoka" class="dg">galipoka</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=colbert" class="dg">colbert</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=report" class="dg">report</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=colbertreport" class="dg">colbertreport</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=colber" class="dg">colber</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=repor" class="dg">repor</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=colberrepor" class="dg">colberrepor</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=jaegerr" class="dg">jaegerr</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=myhump" class="dg">myhump</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=black" class="dg">black</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=eyed" class="dg">eyed</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=peas" class="dg">peas</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=bep" class="dg">bep</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=my" class="dg">my</a> &nbsp; <a href="/web/20060719070832/http://youtube.com/results?search=hump" class="dg">hump</a></div>
						<span class="grayText">Added:</span> 1 month ago &nbsp;&nbsp;
						<span class="grayText">in Category:</span> <a href="/web/20060719070832/http://youtube.com/results?channel=23&amp;sort=video_view_count" class="dg">Comedy</a><br>
						<span class="grayText">From:</span> <a href="/web/20060719070832/http://youtube.com/profile?user=galipoka">galipoka</a><br>
						<span class="grayText">Views:</span> 281,678
					</div>
								<nobr>
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_half.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
			<img class="rating" src="/web/20060719070832im_/http://youtube.com/img/star_sm_bg.gif">
	</nobr>
		<div class="rating">3658 ratings</div>
	



				</td>
			</tr></tbody></table>
		</div> <!-- vEntry -->
	</div> <!-- end vListBox -->
	<div class="footerBox">
		<div style="padding: 3px 0px; text-align: right;"><a href="/web/20060719070832/http://youtube.com/browse?s=mp">See More Videos</a></div>
	</div>
</div> <!-- end hpMainCol -->

<div id="hpSideContent">
	
	<div class="hpContentBlock">
	</div>

		<div class="hpContentBlock">
			<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content"><span class="headerTitle">Broadcast Yourself on YouTube</span></div>
	</div>

		<div class="contentBox">
			
			<table class="hpAboutTable">
			<tbody><tr>
				<td class="label"><a href="/web/20060719070832/http://youtube.com/browse?s=mp">Watch</a></td>
				<td class="desc">Instantly find and watch millions of fast streaming videos.</td>
			</tr>
			<tr>
				<td class="label"><a href="my_videos_upload">Upload</a></td>
				<td class="desc">Quickly upload and tag videos in almost any video format.</td>
			</tr>
			<tr>
				<td class="label"><a href="my_friends_invite">Share</a></td>
				<td>Easily share your videos with family, friends, or co-workers.</td>
			</tr>
			</tbody></table>
			

			<div style="border-top: 1px solid #CCC; margin-top: 6px; padding-top: 6px;">
			<h3 style="margin: 0px 0px 5px 0px;">Member Login</h3>
			<table>
				<form method="post" name="loginForm" id="loginForm" action="signup"></form>
				<input type="hidden" name="action_login" value="1">
				<tbody><tr>
				<td><b>User Name:</b></td>
				<td data-children-count="1"><input tabindex="1" type="text" name="username" value="" class="hpLoginField" data-kwimpalastatus="alive" data-kwimpalaid="1611289767578-1"></td>
				</tr>
				<tr>
				<td><b>Password:</b></td>
				<td data-children-count="1"><input tabindex="2" type="password" name="password" class="hpLoginField" data-kwimpalastatus="alive" data-kwimpalaid="1611289767578-0"></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>
					<div style="float: right;"><b><a href="/web/20060719070832/http://youtube.com/signup">Sign Up</a></b></div><b>
					<div><input type="submit" value="Login"></div>
					<div class="hpLoginForgot smallText">
					<b>Forgot:</b> <a href="forgot_username">Username</a> | <a href="/web/20060719070832/http://youtube.com/forgot">Password</a>
					</div>
				</b></td>
				</tr>
				
			</tbody></table>
				
			</div>
		</div>
		</div> <!-- end hpContentBlock -->
	
	
	<div class="hpContentBlock">
			<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content">			<div class="headerTitle">What's New at YouTube</div>
</div>
	</div>

		<div class="contentBox">
			<p><b><a href="/web/20060719070832/http://youtube.com/signup?signup_type=m">Musicians</a></b><br>
			Are you a musician? <a href="/web/20060719070832/http://youtube.com/signup?signup_type=m">Signup</a> for our new musician account or <a href="/web/20060719070832/http://youtube.com/convert_to_musician">login</a> to convert your existing account.</p>
			<p><b><a href="/web/20060719070832/http://youtube.com/signup?next=my_profile_blogs">Post Videos to Your Blog</a></b><br>
			Full video embeds now supported by LiveJournal</p>
			<p><b><a href="/web/20060719070832/http://youtube.com/t/jobs">We're Hiring!</a></b><br>
			Sys Admins, Web Developers and Engineers apply within.</p>
			
			<div style="float: right;"><a href="/web/20060719070832/http://youtube.com/blog">Read our Blog</a></div>
			<div><a href="/web/20060719070832/http://youtube.com/t/explore_youtube">Explore YouTube</a></div>
		</div>
	</div> <!-- end hpContentBlock -->
	
	
	<div class="hpContentBlock">
		<div class="contentBox" style="font-weight: bold; text-align: center;">
		Enter NBC's
		<a href="/web/20060719070832/http://youtube.com/group/theoffice">The Office</a><br>
		Make Your Own Promo Contest!
		</div>
	</div>


	
	
	
	<div class="hpContentBlock">
			<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content"><span class="headerTitle">Active Channels</span></div>
	</div>

		<div class="contentBox">
			<div class="hpChannelEntry v80hEntry">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/profile?user=takato94"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static9.sjl.youtube.com/vi/KMChLDxofeo/2.jpg" class="vimg" style="background: #333;"></a></div>
				<div class="vinfo">
					<b><a href="/web/20060719070832/http://youtube.com/profile?user=takato94">takato94</a></b>
					<div class="vfacets">113 Videos | 199 Subscribers</div>
				</div>
				<div class="clear"></div>
			</div> <!-- end hpChannelEntry -->
						<div class="hpChannelEntry v80hEntry">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/profile?user=akaLOWKEYY"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static12.sjl.youtube.com/vi/SAMUJVF4R_g/2.jpg" class="vimg" style="background: #333;"></a></div>
				<div class="vinfo">
					<b><a href="/web/20060719070832/http://youtube.com/profile?user=akaLOWKEYY">akaLOWKEYY</a></b>
					<div class="vfacets">43 Videos | 290 Subscribers</div>
				</div>
				<div class="clear"></div>
			</div> <!-- end hpChannelEntry -->
						<div class="hpChannelEntry v80hEntry">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/profile?user=WorldCupBlog"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static11.sjl.youtube.com/vi/yLQma-7I5T8/2.jpg" class="vimg" style="background: #333;"></a></div>
				<div class="vinfo">
					<b><a href="/web/20060719070832/http://youtube.com/profile?user=WorldCupBlog">WorldCupBlog</a></b>
					<div class="vfacets">164 Videos | 206 Subscribers</div>
				</div>
				<div class="clear"></div>
			</div> <!-- end hpChannelEntry -->
						<div class="hpChannelEntry v80hEntry">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/profile?user=hair2hair"><img src="https://web.archive.org/web/20060719070832im_/http://sjl-static1.sjl.youtube.com/vi/55yuVZ4l1ls/2.jpg" class="vimg" style="background: #333;"></a></div>
				<div class="vinfo">
					<b><a href="/web/20060719070832/http://youtube.com/profile?user=hair2hair">hair2hair</a></b>
					<div class="vfacets">13 Videos | 328 Subscribers</div>
				</div>
				<div class="clear"></div>
			</div> <!-- end hpChannelEntry -->
			
			<div style="text-align: right;"><a href="/web/20060719070832/http://youtube.com/members?ms30">See More Channels</a></div>
		</div>
	</div> <!-- end hpContentBlock -->


	<div class="hpContentBlock">
			<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content"><span class="headerTitle">Active Groups</span></div>
	</div>

		<div class="contentBox">
			<div class="hpGroupEntry v80hEntry">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/group/BlogContest"><img class="vimg" src="https://web.archive.org/web/20060719070832im_/http://sjl-static7.sjl.youtube.com/vi/Z71M_CUpLk4/2.jpg"></a></div>
				<div class="vinfo">
					<b><a href="/web/20060719070832/http://youtube.com/group/BlogContest">BlogContest</a></b>
					
					<div class="vfacets"> 33 Videos | 81 Topics</div>
				</div>
				<div class="clear"></div>
			</div> <!-- end hpGroupEntry -->
						<div class="hpGroupEntry v80hEntry">
				<div class="vstill"><a href="/web/20060719070832/http://youtube.com/group/punk"><img class="vimg" src="https://web.archive.org/web/20060719070832im_/http://sjl-static3.sjl.youtube.com/vi/hpfWi_V8DA0/2.jpg"></a></div>
				<div class="vinfo">
					<b><a href="/web/20060719070832/http://youtube.com/group/punk">punk</a></b>
					
					<div class="vfacets"> 1005 Videos | 195 Topics</div>
				</div>
				<div class="clear"></div>
			</div> <!-- end hpGroupEntry -->
			
			<div style="text-align: right;"><a href="/web/20060719070832/http://youtube.com/groups_main">See More Groups</a></div>
		</div>
	</div> <!-- end hpContentBlock -->
	
	
	
</div> <!-- end hpSideCol -->



	<div id="footerDiv">
		<a href="/web/20060719070832/http://youtube.com/advertise">Advertise With Us</a> | <a href="/web/20060719070832/http://youtube.com/t/about">About Us</a> |
		<a href="/web/20060719070832/http://youtube.com/t/help_center">Help Center</a> | <a href="/web/20060719070832/http://youtube.com/t/safety">Safety Tips</a> | <a href="/web/20060719070832/http://youtube.com/dev">Developers</a> |
		<a href="/web/20060719070832/http://youtube.com/t/terms">Terms of Use</a> | <a href="/web/20060719070832/http://youtube.com/t/privacy">Privacy Policy</a> | <a href="/web/20060719070832/http://youtube.com/t/jobs">Jobs</a>
		<br><br>
		Copyright © 2006 YouTube, Inc.&nbsp;&nbsp;&nbsp;&nbsp;<a href="/web/20060719070832/http://youtube.com/rssls"><img src="/web/20060719070832im_/http://youtube.com/img/rss.gif" style="vertical-align: text-top;" width="36" height="14" border="0"></a>
	</div> <!-- end footerDiv -->

	
	
	
</div> <!-- end baseDiv -->


</body></html>