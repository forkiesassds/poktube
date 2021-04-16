<?php 
include("header.php"); 

$id = $_GET["v"];
$vidInfo = json_decode(file_get_contents("https://www.bitview.net/api.php?ty=video&ta=".$id)); 
$video_title = str_replace("\"", "'", $vidInfo->title);
$desc = $vidInfo->description;
$tags = $vidInfo->tags;
$uploader = $vidInfo->upload_by;
$UserInfo = json_decode(file_get_contents("https://www.bitview.net/api.php?ty=user&ta=".$uploader)); 
$comments = $vidInfo->comment_num;
$views = $vidInfo->display_views;
$upload_date = $vidInfo->upload_date;
$user_videos = $UserInfo->videos;
$user_friends = $UserInfo->friends;

$URL = "http://www.bitview.net/embed.php?v=$id&wt=0";
$Fetched_Contents = file_get_contents($URL);
if (preg_match('/<source(.*?)src="(.*?).mp4(.*?)"/i', $Fetched_Contents, $MP4_Link)){
    $Complete_MP4_Link = "{$MP4_Link[2]}.mp4{$MP4_Link[3]}";
}
?>
<div class="tableSubTitle">BitView Frontend Prototype</div>
<p>This is the BitView Frontend. This isn't currently using the code from the actual watch page, but that's because it's really fucking clunky and I just want to test shit.</p>
<table width="930" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr>
		<td style="padding-bottom: 25px;" bgcolor="#FFFFFF">
<div align="center">
</div>
<table width="930" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr valign="top">
		<td style="padding-right: 15px;" width="515">
		<div id="watch-vid-title" class="title">
			<h1><?php echo $video_title?></h1>
		</div>
		<div style="font-size: 13px; font-weight: bold; text-align:center;">
     	</div></td></tr></tbody><tbody><tr valign="top">
		<td style="padding-right: 15px;" width="510">
			<video src="<?php $Complete_MP4_Link?>" poster="movie.jpg" controls>
	This is fallback content to display for user agents that do not support the video tag.
</video>
		
<br>
<!--todo: readd the box which contains some info, but it might all just be features unimplemented. maybe add video replies????-->
<a name="comment"></a>

		<div style="padding-bottom: 5px; font-weight: bold; color: #444;">Comment on this video:</div>
				<div id="div_main_comment">		<div style="padding-bottom: 5px; font-weight: bold; color: #444; display: none;">Comment on this video:</div>		<form name="comment_formmain_comment" id="comment_formmain_comment" method="post" action="comment.php"><input type="hidden" name="video_id" value="8a9wg0Zd36q"><textarea tabindex="2" name="comment" cols="78" rows="3"></textarea>			<br>			<input type="submit" name="add_comment_button" class="button" value="Post Comment" onclick="postThreadedComment('comment_formmain_comment');">			<input type="button" name="discard_comment_button" value="Discard" style="display: none" onclick="hideCommentReplyForm('main_comment',false);">		</form></div>
		
		
<br>
		
<h2>Comments (2):</h2>
<div class="commentEntry" id="comment_LdOoXgR5prs">
				<div class="commentHead">
				<div id="watch-channel-icon" class="user-thumb-small"><a href="/profile.php?user=konqi" onmousedown=""><img src="content/profpic/konqi.png" onerror="this.src=" img="" profiledef.png''="" alt="Channel Icon"></a></div>
					<b><a href="profile.php?user=konqi">konqi</a></b>
					<span class="smallText"> 2021-01-30 </span>
				</div>
				<div class="commentBody">
					so this is epic
				</div>
			</div><div class="commentEntry" id="comment_LdOoXgR5prs">
				<div class="commentHead">
				<div id="watch-channel-icon" class="user-thumb-small"><a href="/profile.php?user=chaziz" onmousedown=""><img src="content/profpic/chaziz.png" onerror="this.src=" img="" profiledef.png''="" alt="Channel Icon"></a></div>
					<b><a href="profile.php?user=chaziz">chaziz</a></b>
					<span class="smallText"> 2021-01-29 </span>
				</div>
				<div class="commentBody">
					HOLY SHIT IT WORKS
				</div>
			</div>		

		</td>
		<td width="280">
		
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
				<a href="/profile.php?user=chaziz" onmousedown=""><img src="img/profiledef.png" onerror="this.src='img/profiledef.png'" alt="Channel Icon"></a>
			</div>
					<span class="smallLabel">Added on</span> <b class="smallText">January 29, 2021</b><br>
					<span class="smallLabel">by</span> <b><a href="/profile.php?user=chaziz">chaziz</a></b>
					<span class="xsmallText">
							(4 videos)
						<!-- 1 hour ago) -->
						<!-- 38 favorites -->
					</span>
				</div>


		</div> <!-- end uploaderInfo -->
		
		
        <div id="vidNameDescDiv">
        	<!-- <b>Vblog - how to be popular on youtube</b>
			(<span class="runtime">06:27</span>)<br/> -->
			<span id="vidDescBegin">
			a			</span>
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
            <input name="video_link" type="text" value="http://localhost:90/watch.php?v=8a9wg0Zd36q" class="vidURLField" onclick="javascript:document.urlForm.video_link.focus();document.urlForm.video_link.select();" readonly="true">
            </td>
            </tr>
            <tr><td><span class="smallLabel">Embed</span></td>
            <td>
            <input name="embed_code" type="text" value="<iframe width='650' height='380' src='http://localhost:90/embed.php?v=8a9wg0Zd36q' frameborder='0' allowfullscreen></iframe>" class="vidURLField" onclick="javascript:document.urlForm.embed_code.focus();document.urlForm.embed_code.select();" readonly="true">
            </td></tr>
            </tbody></table>
            </form>
        </div>
        
        
        <div id="subscribeDiv" class="smallText" style="line-height: 26px;">
		
        <a class="action-button" href="javascript:void(0)" onclick="alert('Why are you trying to subscribe to yourself?')" title="subscribe to chaziz's channel" style="line-height: 13px;">					<span class="action-button-leftcap"></span>
								<span class="action-button-text">Subscribe</span>
								<span class="action-button-rightcap" style="margin-right: 5px;"></span></a> to chaziz's channel 
        </div>
        
	</div>
	<br>
	<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content"><span class="headerTitleLite">Explore More Videos</span></div>
	</div>
	

	<div id="exploreDiv" class="contentBox">

		<table id="exSubNavTable"><tbody><tr>
		<td><a href="#" id="exRelatedLink" class="selectedNavLink" onclick="selectNavLink('exRelatedLink'); return false;">Related</a></td>
		<!--<td align="center"><a href="#" id="exPlaylistLink" class="unSelectedNavLink eLink" onclick="showRelatedPlaylistContent(); return false;">Playlists</a></td>-->
		<td align="right"><a href="#" id="exUserLink" class="unSelectedNavLink eLink" onclick="selectNavLink('exUserLink'); return false;"><span class="smallText">chaziz's</span> Videos</a></td>
		</tr></tbody></table>
		

			<div id="exRelatedDiv" style="display: block;">
				<table class="showingTable"><tbody><tr>
	<td class="smallText">Showing 1-20 of 10</td>
	<td class="smallText" align="right"><a href="/web/20060624045545/http://www.youtube.com/results?related=winekone%20filthywhore%20utnow%20morbeck%20boh3m3%20strip%20dance%20panties%20popular%20utube%20users%20mime%20beard%20kevin%20smith%20topless">See All Videos</a></td>
	</tr></tbody></table>

		<div id="side_results" class="exploreContent" name="side_results">
	
		<div class="vWatchEntry">
			<div class="vNowPlaying">
		<table><tbody><tr>
		<td><div class="img">
				<a href="http://localhost:90/watch.php?v=8a9wg0Zd36q"><img class="vimgSm" src="content/thumbs/8a9wg0Zd36q.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="http://localhost:90/watch.php?v=8a9wg0Zd36q">A scrapped PF94 YTP from mid-2018</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=?php echo $Username ?>">chaziz</a><br>
			</div>
				<div class="smallText">
				<b>&lt;&lt; Now Playing</b>
				</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vNowPlaying -->
		</div> <!-- end vWatchEntry -->
		
				<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=SynEdsa1zWK"><img class="vimgSm" src="content/thumbs/SynEdsa1zWK.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=SynEdsa1zWK">The funny</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=AverageRetard">AverageRetard</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=kQX0huz-3Fb"><img class="vimgSm" src="content/thumbs/kQX0huz-3Fb.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=kQX0huz-3Fb">sex</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=chaziz">chaziz</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=WSQ2RtTrDIm"><img class="vimgSm" src="content/thumbs/WSQ2RtTrDIm.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=WSQ2RtTrDIm">test</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=chaziz">chaziz</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=QHy0XcM9BVE"><img class="vimgSm" src="content/thumbs/QHy0XcM9BVE.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=QHy0XcM9BVE">Another Test</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=konqi">konqi</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=0v2LH9FkTRb"><img class="vimgSm" src="img/default.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=0v2LH9FkTRb">BFB Intro!</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=konqi">konqi</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=wLyb4h1f5SC"><img class="vimgSm" src="img/default.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=wLyb4h1f5SC">Secks with The Children</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=konqi">konqi</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=Od9SekaBvo3"><img class="vimgSm" src="content/thumbs/Od9SekaBvo3.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=Od9SekaBvo3">When the suffer</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=konqi">konqi</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=fc2ayqsOtIK"><img class="vimgSm" src="content/thumbs/fc2ayqsOtIK.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=fc2ayqsOtIK">GoFaggort</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=konqi">konqi</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
		<table><tbody><tr>
		<td><div class="img">
				<a href="/watch.php?v=zksyfohptgd"><img class="vimgSm" src="img/default.png" onerror="this.src='img/default.png'"></a></div></td>
		<td><div class="title"><b><a href="/watch.php?v=zksyfohptgd">squareBracket Trailer</a></b><br>
			<span class="runtime">00:00</span>
			</div>
			<div class="facets">
				<span class="grayText">From:</span> <a href="/profile.php?user=chaziz">chaziz</a><br>
			</div>
			</td>
		</tr></tbody></table>
		</div> <!-- end vWatchEntry -->	
	</div>

			<table class="showingTable"><tbody><tr>
	<td class="smallText">Showing 1-20 of 10</td>
	<td class="smallText" align="right"><a href="/web/20060624045545/http://www.youtube.com/results?related=winekone%20filthywhore%20utnow%20morbeck%20boh3m3%20strip%20dance%20panties%20popular%20utube%20users%20mime%20beard%20kevin%20smith%20topless">See All Videos</a></td>
	</tr></tbody></table>
			</div> <!-- end exRelatedDiv -->
			
			
			<div id="exPlaylistDiv" style="display: none;">
				Loading...
			</div> <!-- end exPlaylistDiv -->
			
			
			<div id="exUserDiv" style="display: none">
			<table class="showingTable"><tbody><tr>
	<td class="smallText">Showing 1-4 of 4</td>
	<td class="smallText" align="right"><a href="/profile.php?user=chaziz&amp;page=videos">See All Videos</a></td>
	</tr></tbody></table>

		<div id="side_results" class="exploreContent" name="side_results" onscroll="render_full_side()">
	
					<div class="vWatchEntry">
			<table><tbody><tr>
			<td><div class="img">
					<a href="/watch.php?v=kQX0huz-3Fb"><img class="vimgSm" src="content/thumbs/kQX0huz-3Fb.png" onerror="this.src='img/default.png'"></a></div></td>
			<td><div class="title"><b><a href="/watch.php?v=kQX0huz-3Fb">sex</a></b><br>
				<span class="runtime">00:00</span>
				</div>
				<div class="facets">
					<span class="grayText">From:</span> <a href="/profile.php?user=chaziz">chaziz</a><br>
				</div>
				</td>
			</tr></tbody></table>
			</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
			<table><tbody><tr>
			<td><div class="img">
					<a href="/watch.php?v=WSQ2RtTrDIm"><img class="vimgSm" src="content/thumbs/WSQ2RtTrDIm.png" onerror="this.src='img/default.png'"></a></div></td>
			<td><div class="title"><b><a href="/watch.php?v=WSQ2RtTrDIm">test</a></b><br>
				<span class="runtime">00:00</span>
				</div>
				<div class="facets">
					<span class="grayText">From:</span> <a href="/profile.php?user=chaziz">chaziz</a><br>
				</div>
				</td>
			</tr></tbody></table>
			</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
			<table><tbody><tr>
			<td><div class="img">
					<a href="/watch.php?v=zksyfohptgd"><img class="vimgSm" src="img/default.png" onerror="this.src='img/default.png'"></a></div></td>
			<td><div class="title"><b><a href="/watch.php?v=zksyfohptgd">squareBracket Trailer</a></b><br>
				<span class="runtime">00:00</span>
				</div>
				<div class="facets">
					<span class="grayText">From:</span> <a href="/profile.php?user=chaziz">chaziz</a><br>
				</div>
				</td>
			</tr></tbody></table>
			</div> <!-- end vWatchEntry -->		<div class="vWatchEntry">
				<div class="vNowPlaying">
			<table><tbody><tr>
			<td><div class="img">
					<a href="http://localhost:90/watch.php?v=8a9wg0Zd36q"><img class="vimgSm" src="content/thumbs/8a9wg0Zd36q.png" onerror="this.src='img/default.png'"></a></div></td>
			<td><div class="title"><b><a href="http://localhost:90/watch.php?v=8a9wg0Zd36q">A scrapped PF94 YTP from mid-2018</a></b><br>
				<span class="runtime">00:00</span>
				</div>
				<div class="facets">
					<span class="grayText">From:</span> <a href="/profile.php?user=chaziz>">chaziz</a><br>
				</div>
					<div class="smallText">
					<b>&lt;&lt; Now Playing</b>
					</div>
				</td>
			</tr></tbody></table>
			</div> <!-- end vNowPlaying -->
			</div> <!-- end vWatchEntry -->
			</div> 
						<table class="showingTable"><tbody><tr>
	<td class="smallText">Showing 1-4 of 4</td>
	<td class="smallText" align="right"><a href="/profile.php?user=chaziz&amp;page=videos">See All Videos</a></td>
	</tr></tbody></table>
			<!-- end exUserDiv -->

		
	</div> <!-- end exploreDiv -->
	
	

	
</div> <!-- end aboutExploreDiv -->
		
		</td>
	</tr>
</tbody></table>


		</td>
	</tr>
</tbody></table>
<?php 
include("footer.php"); 
?>