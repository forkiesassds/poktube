<?php
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

if(isset($_GET["player"])) {
if(($_GET["player"]) == 2){
	$player = 2;
} else {
	if(($_GET["player"]) == 1){
	$player = 1;
} else {
	if(($_GET["player"]) == 0){
	$player = 0;
} else {
	$player = null;
}
}
}
} else {
	$player = 0;
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

//$viewnew = $ViewCount + 1;

//$updateQuery = "UPDATE videodb SET ViewCount='". $viewnew ."' WHERE VideoID='". $vid ."'";
//mysqli_query($connect,$updateQuery);

//$ViewCount = $viewnew;

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
<div id="watch-vid-title" class="title">
	<h1><?php echo $VideoName ?></h1>
</div>


<div id="watch-this-vid">
   <div id="watch-player-div" class="flash-player">
      <div width="640" height="380">
				<iframe style='outline: 0px solid transparent;' src='./player.php?v=<?php echo $vid ?>&player=<?php echo $player; ?>' width='650' height='380' frameBorder='0' scrolling='no' debug='true'></iframe>
			</div>
   </div>
   <script type="text/javascript">
      var fo = writeMoviePlayer("watch-player-div");
   </script>
   <div id="watch-main-area" class="watch-main-area-with-extras">
   <div id="watch-comments-stats">
      <div class="watch-tab-contents">
         <div id="watch-tab-commentary-body" class="watch-tab-body watch-tab-sel">
            <div id="watch-comments-summary">
               Video Responses: <span id="watch-comments-numresponses">636</span>
               Text Comments: <span class="number-of-comments">67,043</span>
            </div>
            <div class="expand-panel expanded small-expand-panel">
               <div class="floatR">
                  <a class="hLink bold" href="	/login?next=/video_response_upload%3Fv%3DmuP9eH2p2PI
                     " onclick="urchinTracker('/Events/VideoWatch/PostVideoResponseSignIn');">Sign in to post a Video Response</a>
               </div>
               <a href="#" onclick="togglePanel(this.parentNode); this.blur(); return false;" class="expand-header"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="" class="arrow">Video Responses <span class="expand-header-stat">(636)</span></a>
               <div id="watch-video-responses-children" class="expand-content">
                  <div class="floatL SingleArrowBox">
                     <a href="#" onclick="this.blur();return false"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="LeftSingleArrow hand" onclick="shiftLeft('video_responses')"></a>
                  </div>
                  <div class="floatL SingleArrowContainerBox">
                     <div id="div_video_responses_0" class="watch-video-response">
                        <div class="v90WideEntry">
                           <div class="v90WrapperOuter">
                              <div class="v90WrapperInner">
                                 <a id="href_video_responses_0" onmousedown="urchinTracker('/Events/VideoWatch/VideoResponse');" href="/web/20081217104312if_/http://www.youtube.com/watch?v=ELsVsUPsesk&amp;watch_response"><img id="img_video_responses_0" class="vimg90" src="http://web.archive.org/web/20081217104312/http://i2.ytimg.com/vi/ELsVsUPsesk/default.jpg" title="Riddle #8" alt="Riddle #8"></a>
                              </div>
                           </div>
                        </div>
                        <div id="title1_video_responses_0">
                           <span class="watch-video-response-duration">00:26</span><br>
                           <a class="hLink" href="/web/20081217104312mp_/http://www.youtube.com/user/CoolRiddles">CoolRidd...</a>
                        </div>
                        <div id="title2_video_responses_0"><span style="color: #333"></span></div>
                     </div>
                     <div id="div_video_responses_0_alternate" style="display: none" class="watch-video-response">
                        <div class="v90WideEntry">
                           <div class="v90WrapperOuter">
                              <div class="v90WrapperInner">
                                 <img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
                              </div>
                           </div>
                        </div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                     </div>
                     <div id="div_video_responses_1" class="watch-video-response">
                        <div class="v90WideEntry">
                           <div class="v90WrapperOuter">
                              <div class="v90WrapperInner">
                                 <a id="href_video_responses_1" onmousedown="urchinTracker('/Events/VideoWatch/VideoResponse');" href="/web/20081217104312if_/http://www.youtube.com/watch?v=qDOcy5jTP28&amp;watch_response"><img id="img_video_responses_1" class="vimg90" src="http://web.archive.org/web/20081217104312/http://i2.ytimg.com/vi/qDOcy5jTP28/default.jpg" title="George Bush vs Shoes and Pissed Off Journalist 12-14-08.WMV" alt="George Bush vs Shoes and Pissed Off Journalist 12-14-08.WMV"></a>
                              </div>
                           </div>
                        </div>
                        <div id="title1_video_responses_1">
                           <span class="watch-video-response-duration">01:02</span><br>
                           <a class="hLink" href="/web/20081217104312mp_/http://www.youtube.com/user/InternetAllStar">Internet...</a>
                        </div>
                        <div id="title2_video_responses_1"><span style="color: #333"></span></div>
                     </div>
                     <div id="div_video_responses_1_alternate" style="display: none" class="watch-video-response">
                        <div class="v90WideEntry">
                           <div class="v90WrapperOuter">
                              <div class="v90WrapperInner">
                                 <img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
                              </div>
                           </div>
                        </div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                     </div>
                     <div id="div_video_responses_2" class="watch-video-response">
                        <div class="v90WideEntry">
                           <div class="v90WrapperOuter">
                              <div class="v90WrapperInner">
                                 <a id="href_video_responses_2" onmousedown="urchinTracker('/Events/VideoWatch/VideoResponse');" href="/web/20081217104312if_/http://www.youtube.com/watch?v=03IKC0GcQj4&amp;watch_response"><img id="img_video_responses_2" class="vimg90" src="http://web.archive.org/web/20081217104312/http://i1.ytimg.com/vi/03IKC0GcQj4/default.jpg" title="Unbelievable Circumstances" alt="Unbelievable Circumstances"></a>
                              </div>
                           </div>
                        </div>
                        <div id="title1_video_responses_2">
                           <span class="watch-video-response-duration">06:24</span><br>
                           <a class="hLink" href="/web/20081217104312mp_/http://www.youtube.com/user/alphasnake1">alphasna...</a>
                        </div>
                        <div id="title2_video_responses_2"><span style="color: #333"></span></div>
                     </div>
                     <div id="div_video_responses_2_alternate" style="display: none" class="watch-video-response">
                        <div class="v90WideEntry">
                           <div class="v90WrapperOuter">
                              <div class="v90WrapperInner">
                                 <img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
                              </div>
                           </div>
                        </div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                     </div>
                     <div id="div_video_responses_3" class="watch-video-response">
                        <div class="v90WideEntry">
                           <div class="v90WrapperOuter">
                              <div class="v90WrapperInner">
                                 <a id="href_video_responses_3" onmousedown="urchinTracker('/Events/VideoWatch/VideoResponse');" href="/web/20081217104312if_/http://www.youtube.com/watch?v=c7Iss8yzfDo&amp;watch_response"><img id="img_video_responses_3" class="vimg90" src="http://web.archive.org/web/20081217104312/http://i4.ytimg.com/vi/c7Iss8yzfDo/default.jpg" title="Bad Religion - F**k Armageddon... This Is Hell" alt="Bad Religion - F**k Armageddon... This Is Hell"></a>
                              </div>
                           </div>
                        </div>
                        <div id="title1_video_responses_3">
                           <span class="watch-video-response-duration">03:00</span><br>
                           <a class="hLink" href="/web/20081217104312mp_/http://www.youtube.com/user/imintopunk">imintopunk</a>
                        </div>
                        <div id="title2_video_responses_3"><span style="color: #333"></span></div>
                     </div>
                     <div id="div_video_responses_3_alternate" style="display: none" class="watch-video-response">
                        <div class="v90WideEntry">
                           <div class="v90WrapperOuter">
                              <div class="v90WrapperInner">
                                 <img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
                              </div>
                           </div>
                        </div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                     </div>
                  </div>
                  <div class="floatR SingleArrowBox">
                     <a href="#" onclick="this.blur();return false"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="RightSingleArrow hand" onclick="shiftRight('video_responses');"></a>
                  </div>
                  <div class="clear"></div>
               </div>
               <div id="watch-video-responses-actions" class="expand-content">
                  <a class="hLink" href="/web/20081217104312/http://www.youtube.com/video_response_view_all?v=muP9eH2p2PI" onmousedown="urchinTracker('/Events/VideoWatch/WatchVideoResponses');">View All</a>
                  <span class="grayText marL6 marR6">-</span>
                  <a class="hLink" href="/web/20081217104312/http://www.youtube.com/watch?v=ELsVsUPsesk&amp;feature=Responses&amp;parent_video=muP9eH2p2PI&amp;index=0&amp;playnext=1&amp;playnext_from=RL" onmousedown="urchinTracker('/Events/VideoWatch/PlayVideoResponses');">Play All</a>
               </div>
            </div>
            <div class="expand-panel expanded small-expand-panel">
               <div id="watch-comment-post-comment">
                  <a href="#" class="hLink bold" onclick="showCommentReplyForm('main_comment2', '', false); urchinTracker('/Events/VideoWatch/PostTextCommentSignin'); return false;" id="post_text_comment_link" rel="nofollow">Sign in to post a Comment</a>
               </div>
               <a href="#" onclick="togglePanel(this.parentNode); this.blur(); return false;" class="expand-header"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="" class="arrow">Text Comments <span class="expand-header-stat">(67,043)</span></a>
               <div class="clear"></div>
               <div class="expand-content">
                  <div id="watch-comment-filter">
                     <div style="margin:5px;">
                        <form action="" name="comments_filter">
                           <span class="smallText"><b>Show:</b></span>
                           <select class="xsmallText" name="commentthreshold" onchange="showLoading('recent_comments', this.value);getUrlXMLResponseAndFillDiv('/watch_ajax?v=muP9eH2p2PI&amp;savethreshold=yes&amp;action_get_comments=1&amp;p=1&amp;page_size=10&amp;commentthreshold='+this.value, 'recent_comments');">
                              <option value="-1000">all comments</option>
                              <option value="10">excellent (+10 or better)</option>
                              <option value="5">great (+5 or better)</option>
                              <option value="0">good (0 or better)</option>
                              <option selected="selected" value="-5">average (-5 or better)</option>
                              <option value="-10">poor (-10 or better)</option>
                           </select>
                           <span class="smallText">
                           <a href="#" class="eLink" onclick="return false;" onmouseover="showDiv('commentsHelp');return false;" onmouseout="hideDiv('commentsHelp');">Help</a>
                           <span id="commentsHelp" class="smallText watch-comments-tooltip">
                           Change this to see only comments above a certain value.<br>Change the value of a comment by clicking on a thumb.
                           </span>
                           </span>
                        </form>
                     </div>
                  </div>
                  <div id="div_main_comment2"></div>
                  <div id="recent_comments" class="comments">
                     <div id="XtyxduCsFBs" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/boiltit" rel="nofollow">boiltit</a>
                              <span class="watch-comment-time"> (2 hours ago) </span>
                              <a id="show_link_XtyxduCsFBs" class="watch-comment-head-link" onclick="displayHideCommentLink('XtyxduCsFBs')">Show</a>
                              <a id="hide_link_XtyxduCsFBs" class="watch-comment-head-link" onclick="displayShowCommentLink('XtyxduCsFBs')">Hide</a>
                           </div>
                           <div id="comment_vote_XtyxduCsFBs" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('XtyxduCsFBs', 1);" onmouseout="loginMsg('XtyxduCsFBs', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('XtyxduCsFBs', 1);" onmouseout="loginMsg('XtyxduCsFBs', 0);"></a>
                              <span id="comment_msg_XtyxduCsFBs" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_XtyxduCsFBs" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_XtyxduCsFBs" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_XtyxduCsFBs', 'XtyxduCsFBs', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_XtyxduCsFBs">
                           <div class="watch-comment-body">
                              <div>
                                 daft bodies harder better faster stronger
                              </div>
                           </div>
                           <div id="div_comment_form_id_XtyxduCsFBs"></div>
                        </div>
                     </div>
                     <div id="YRdsOo-cJbI" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/UzumakiKusani" rel="nofollow">UzumakiKusani</a>
                              <span class="watch-comment-time"> (4 hours ago) </span>
                              <a id="show_link_YRdsOo-cJbI" class="watch-comment-head-link" onclick="displayHideCommentLink('YRdsOo-cJbI')">Show</a>
                              <a id="hide_link_YRdsOo-cJbI" class="watch-comment-head-link" onclick="displayShowCommentLink('YRdsOo-cJbI')">Hide</a>
                           </div>
                           <div id="comment_vote_YRdsOo-cJbI" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('YRdsOo-cJbI', 1);" onmouseout="loginMsg('YRdsOo-cJbI', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('YRdsOo-cJbI', 1);" onmouseout="loginMsg('YRdsOo-cJbI', 0);"></a>
                              <span id="comment_msg_YRdsOo-cJbI" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_YRdsOo-cJbI" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_YRdsOo-cJbI" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_YRdsOo-cJbI', 'YRdsOo-cJbI', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_YRdsOo-cJbI">
                           <div class="watch-comment-body">
                              <div>
                                 chris crocker is in it lol
                              </div>
                           </div>
                           <div id="div_comment_form_id_YRdsOo-cJbI"></div>
                        </div>
                     </div>
                     <div id="ThckD0VC1wY" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/TheKnodeller" rel="nofollow">TheKnodeller</a>
                              <span class="watch-comment-time"> (4 hours ago) </span>
                              <a id="show_link_ThckD0VC1wY" class="watch-comment-head-link" onclick="displayHideCommentLink('ThckD0VC1wY')">Show</a>
                              <a id="hide_link_ThckD0VC1wY" class="watch-comment-head-link" onclick="displayShowCommentLink('ThckD0VC1wY')">Hide</a>
                           </div>
                           <div id="comment_vote_ThckD0VC1wY" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('ThckD0VC1wY', 1);" onmouseout="loginMsg('ThckD0VC1wY', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('ThckD0VC1wY', 1);" onmouseout="loginMsg('ThckD0VC1wY', 0);"></a>
                              <span id="comment_msg_ThckD0VC1wY" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_ThckD0VC1wY" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_ThckD0VC1wY" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_ThckD0VC1wY', 'ThckD0VC1wY', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_ThckD0VC1wY">
                           <div class="watch-comment-body">
                              <div>
                                 daft hands
                              </div>
                           </div>
                           <div id="div_comment_form_id_ThckD0VC1wY"></div>
                        </div>
                     </div>
                     <div id="BzbtEsESRGs" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/deathyou9000" rel="nofollow">deathyou9000</a>
                              <span class="watch-comment-time"> (4 hours ago) </span>
                              <a id="show_link_BzbtEsESRGs" class="watch-comment-head-link" onclick="displayHideCommentLink('BzbtEsESRGs')">Show</a>
                              <a id="hide_link_BzbtEsESRGs" class="watch-comment-head-link" onclick="displayShowCommentLink('BzbtEsESRGs')">Hide</a>
                           </div>
                           <div id="comment_vote_BzbtEsESRGs" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('BzbtEsESRGs', 1);" onmouseout="loginMsg('BzbtEsESRGs', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('BzbtEsESRGs', 1);" onmouseout="loginMsg('BzbtEsESRGs', 0);"></a>
                              <span id="comment_msg_BzbtEsESRGs" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_BzbtEsESRGs" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_BzbtEsESRGs" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_BzbtEsESRGs', 'BzbtEsESRGs', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_BzbtEsESRGs">
                           <div class="watch-comment-body">
                              <div>
                                 what is that video called thats at 1:50?
                              </div>
                           </div>
                           <div id="div_comment_form_id_BzbtEsESRGs"></div>
                        </div>
                     </div>
                     <div id="3lyTCmNJPfI" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/SalandFindles" rel="nofollow">SalandFindles</a>
                              <span class="watch-comment-time"> (4 hours ago) </span>
                              <a id="show_link_3lyTCmNJPfI" class="watch-comment-head-link" onclick="displayHideCommentLink('3lyTCmNJPfI')">Show</a>
                              <a id="hide_link_3lyTCmNJPfI" class="watch-comment-head-link" onclick="displayShowCommentLink('3lyTCmNJPfI')">Hide</a>
                           </div>
                           <div id="comment_vote_3lyTCmNJPfI" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('3lyTCmNJPfI', 1);" onmouseout="loginMsg('3lyTCmNJPfI', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('3lyTCmNJPfI', 1);" onmouseout="loginMsg('3lyTCmNJPfI', 0);"></a>
                              <span id="comment_msg_3lyTCmNJPfI" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_3lyTCmNJPfI" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_3lyTCmNJPfI" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_3lyTCmNJPfI', '3lyTCmNJPfI', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_3lyTCmNJPfI">
                           <div class="watch-comment-body">
                              <div>
                                 nice quality
                              </div>
                           </div>
                           <div id="div_comment_form_id_3lyTCmNJPfI"></div>
                        </div>
                     </div>
                     <div id="IxiGRA3xQuc" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/o0mOnCe0oxoxo" rel="nofollow">o0mOnCe0oxoxo</a>
                              <span class="watch-comment-time"> (5 hours ago) </span>
                              <a id="show_link_IxiGRA3xQuc" class="watch-comment-head-link" onclick="displayHideCommentLink('IxiGRA3xQuc')">Show</a>
                              <a id="hide_link_IxiGRA3xQuc" class="watch-comment-head-link" onclick="displayShowCommentLink('IxiGRA3xQuc')">Hide</a>
                           </div>
                           <div id="comment_vote_IxiGRA3xQuc" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('IxiGRA3xQuc', 1);" onmouseout="loginMsg('IxiGRA3xQuc', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('IxiGRA3xQuc', 1);" onmouseout="loginMsg('IxiGRA3xQuc', 0);"></a>
                              <span id="comment_msg_IxiGRA3xQuc" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_IxiGRA3xQuc" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_IxiGRA3xQuc" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_IxiGRA3xQuc', 'IxiGRA3xQuc', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_IxiGRA3xQuc">
                           <div class="watch-comment-body">
                              <div>
                                 i love this video<br>weezer is the best!!!
                              </div>
                           </div>
                           <div id="div_comment_form_id_IxiGRA3xQuc"></div>
                        </div>
                     </div>
                     <div id="ouVIPf8JsHA" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/Bingestpono" rel="nofollow">Bingestpono</a>
                              <span class="watch-comment-time"> (5 hours ago) </span>
                              <a id="show_link_ouVIPf8JsHA" class="watch-comment-head-link" onclick="displayHideCommentLink('ouVIPf8JsHA')">Show</a>
                              <a id="hide_link_ouVIPf8JsHA" class="watch-comment-head-link" onclick="displayShowCommentLink('ouVIPf8JsHA')">Hide</a>
                           </div>
                           <div id="comment_vote_ouVIPf8JsHA" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('ouVIPf8JsHA', 1);" onmouseout="loginMsg('ouVIPf8JsHA', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('ouVIPf8JsHA', 1);" onmouseout="loginMsg('ouVIPf8JsHA', 0);"></a>
                              <span id="comment_msg_ouVIPf8JsHA" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_ouVIPf8JsHA" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_ouVIPf8JsHA" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_ouVIPf8JsHA', 'ouVIPf8JsHA', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_ouVIPf8JsHA">
                           <div class="watch-comment-body">
                              <div>
                                 ive been watching how much this video been watched over the last 3 days it started of at like 500000 then day 2 was like 4.5 million and now its over 15 million it's amazing how much time people wayste watching these things.The total time this has been watched is 49804126.5 minuites
                              </div>
                           </div>
                           <div id="div_comment_form_id_ouVIPf8JsHA"></div>
                        </div>
                     </div>
                     <div id="NZIIsx1UXmA" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/XxXWAKEXxX" rel="nofollow">XxXWAKEXxX</a>
                              <span class="watch-comment-time"> (5 hours ago) </span>
                              <a id="show_link_NZIIsx1UXmA" class="watch-comment-head-link" onclick="displayHideCommentLink('NZIIsx1UXmA')">Show</a>
                              <a id="hide_link_NZIIsx1UXmA" class="watch-comment-head-link" onclick="displayShowCommentLink('NZIIsx1UXmA')">Hide</a>
                           </div>
                           <div id="comment_vote_NZIIsx1UXmA" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('NZIIsx1UXmA', 1);" onmouseout="loginMsg('NZIIsx1UXmA', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('NZIIsx1UXmA', 1);" onmouseout="loginMsg('NZIIsx1UXmA', 0);"></a>
                              <span id="comment_msg_NZIIsx1UXmA" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_NZIIsx1UXmA" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_NZIIsx1UXmA" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_NZIIsx1UXmA', 'NZIIsx1UXmA', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_NZIIsx1UXmA">
                           <div class="watch-comment-body">
                              <div>
                                 ATTENTION PEOPLE!!!.<br><br>If people want to do something against this new policy. There will be a Blackout Fri Dec 19-21.<br><br>People don't use youtube for those following days!, If you guys want to Boycott this and send a message, Stop using any source from youtube, maps,sites and the website itself and any streaming video from youtube!.<br><br>If you guys want to fight this!<br><br>JOIN US!!!!!!.<br>JOIN US!!!!!!<br>JOIN US!!!!!!<br>JOIN US!!!!!!<br><br>Youtube Blackout Fri 19-21. Don't use youtube!!!.
                              </div>
                           </div>
                           <div id="div_comment_form_id_NZIIsx1UXmA"></div>
                        </div>
                     </div>
                     <div id="IsvMDtpkC9Q" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/loopytoopydroopynuts" rel="nofollow">loopytoopydroopynuts</a>
                              <span class="watch-comment-time"> (6 hours ago) </span>
                              <a id="show_link_IsvMDtpkC9Q" class="watch-comment-head-link" onclick="displayHideCommentLink('IsvMDtpkC9Q')">Show</a>
                              <a id="hide_link_IsvMDtpkC9Q" class="watch-comment-head-link" onclick="displayShowCommentLink('IsvMDtpkC9Q')">Hide</a>
                           </div>
                           <div id="comment_vote_IsvMDtpkC9Q" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('IsvMDtpkC9Q', 1);" onmouseout="loginMsg('IsvMDtpkC9Q', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('IsvMDtpkC9Q', 1);" onmouseout="loginMsg('IsvMDtpkC9Q', 0);"></a>
                              <span id="comment_msg_IsvMDtpkC9Q" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_IsvMDtpkC9Q" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_IsvMDtpkC9Q" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_IsvMDtpkC9Q', 'IsvMDtpkC9Q', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_IsvMDtpkC9Q">
                           <div class="watch-comment-body">
                              <div>
                                 if u dont no hoo chad warden is type in why ps3 is better than wii and xbox360<br>exactly like that and clik on the first vid<br>but if u a little kid then watch it cuz it swears
                              </div>
                           </div>
                           <div id="div_comment_form_id_IsvMDtpkC9Q"></div>
                        </div>
                     </div>
                     <div id="jlTCnpXHTXc" class="watch-comment-entry">
                        <div class="watch-comment-head">
                           <div class="watch-comment-info">
                              <a class="watch-comment-auth" href="/web/20081217104312/http://www.youtube.com/user/loopytoopydroopynuts" rel="nofollow">loopytoopydroopynuts</a>
                              <span class="watch-comment-time"> (6 hours ago) </span>
                              <a id="show_link_jlTCnpXHTXc" class="watch-comment-head-link" onclick="displayHideCommentLink('jlTCnpXHTXc')">Show</a>
                              <a id="hide_link_jlTCnpXHTXc" class="watch-comment-head-link" onclick="displayShowCommentLink('jlTCnpXHTXc')">Hide</a>
                           </div>
                           <div id="comment_vote_jlTCnpXHTXc" class="watch-comment-voting">
                              <span class="watch-comment-score watch-comment-gray"> 0</span>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-down" title="Poor comment" alt="Poor comment" onmouseover="loginMsg('jlTCnpXHTXc', 1);" onmouseout="loginMsg('jlTCnpXHTXc', 0);"></a>
                              <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" class="watch-comment-up" title="Good comment" alt="Good comment" onmouseover="loginMsg('jlTCnpXHTXc', 1);" onmouseout="loginMsg('jlTCnpXHTXc', 0);"></a>
                              <span id="comment_msg_jlTCnpXHTXc" class="watch-comment-msg"></span>
                           </div>
                           <span id="comment_spam_bug_jlTCnpXHTXc" class="watch-comment-spam-bug">Marked as spam</span>
                           <div id="reply_comment_form_id_jlTCnpXHTXc" class="watch-comment-action">
                              <a onclick="showCommentReplyForm('comment_form_id_jlTCnpXHTXc', 'jlTCnpXHTXc', false)">Reply</a> 
                           </div>
                           <div class="clearL"></div>
                        </div>
                        <div id="comment_body_jlTCnpXHTXc">
                           <div class="watch-comment-body">
                              <div>
                                 all this vid needs is chad warden gettin hurt<br>or avgn<br>or nostalgia critic<br>or smosh
                              </div>
                           </div>
                           <div id="div_comment_form_id_jlTCnpXHTXc"></div>
                        </div>
                     </div>
                     <div class="watch-comment-pagination">
                        <div class="floatR">
                           <span class="watch-comment-pnum"><a href="#" onclick="showLoading('recent_comments');;getUrlXMLResponseAndFillDiv('/watch_ajax?v=muP9eH2p2PI&amp;action_get_comments=1&amp;p=2&amp;commentthreshold=-5&amp;page_size=10', 'recent_comments'); return false;">Next</a></span>
                        </div>
                        <div class="floatL">
                           <span class="watch-comment-pnum">Pages:</span>
                           <span class="watch-comment-pnum">1</span>
                           <span class="watch-comment-pnum"><a href="#" onclick="showLoading('recent_comments');getUrlXMLResponseAndFillDiv('/watch_ajax?v=muP9eH2p2PI&amp;action_get_comments=1&amp;p=2&amp;commentthreshold=-5&amp;page_size=10', 'recent_comments'); return false;">2</a></span>
                           <span class="watch-comment-pnum"><a href="#" onclick="showLoading('recent_comments');getUrlXMLResponseAndFillDiv('/watch_ajax?v=muP9eH2p2PI&amp;action_get_comments=1&amp;p=3&amp;commentthreshold=-5&amp;page_size=10', 'recent_comments'); return false;">3</a></span>
                           &nbsp;...&nbsp;
                        </div>
                        <div class="clear"></div>
                     </div>
                  </div>
                  <!-- end recent_comments -->
                  <div id="watch-comment-view-all"><a href="/web/20081217104312/http://www.youtube.com/comment_servlet?all_comments&amp;v=muP9eH2p2PI&amp;fromurl=/watch%3Fv%3DmuP9eH2p2PI" class="hLink" onmousedown="urchinTracker('/Events/VideoWatch/ViewAllComments');" rel="nofollow">View all 67,043 comments</a></div>
                  <div id="watch-comment-post">
                     <h2>Would you like to comment?</h2>
                     <div>
                        <a href="/web/20081217104312/http://www.youtube.com/signup?next=/watch%3Fv%3DmuP9eH2p2PI">Join YouTube</a> for a free account, or
                        <a href="/web/20081217104312/http://www.youtube.com/login?next=/watch%3Fv%3DmuP9eH2p2PI">sign in</a> if you are already a member.
                     </div>
                  </div>
                  <!-- end post a comment section -->
                  <div id="div_main_comment"></div>
               </div>
            </div>
         </div>
         <div id="watch-tab-stats-body" class="watch-tab-body">
            <table id="watch-some-stats" cellspacing="0" cellpadding="0">
               <tbody>
                  <tr>
                     <td class="post-date">Added: <span class="watch-stat">May 23, 2008</span></td>
                     <td class="number-of-views">Views: <span class="watch-stat">15,664,258</span></td>
                     <td>Ratings: <span class="watch-stat">89,703</span></td>
                  </tr>
                  <tr>
                     <td>Responses: <a class="hLink bold" href="/web/20081217104312/http://www.youtube.com/video_response_view_all?v=muP9eH2p2PI" onmousedown="urchinTracker('/Events/VideoWatch/WatchVideoResponses');">636</a></td>
                     <td>Comments: <a href="/web/20081217104312/http://www.youtube.com/comment_servlet?all_comments&amp;v=muP9eH2p2PI" class="hLink bold">67,043</a></td>
                     <td>
                        <span class="watch-stat"><span class="lightLabel">Favorited:</span> 165,840 times</span>
                     </td>
                  </tr>
               </tbody>
            </table>
            <div class="expand-panel expanded small-expand-panel">
               <a href="#" onclick="togglePanel(this.parentNode); this.blur(); return false;" class="expand-header"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="" class="arrow">Recently rated <span class="expand-header-stat">(3 ratings)</span></a>
               <div id="watch-recent-ratings" class="expand-content">
                  <div class="watch-recent-rating-entry">
                     <div>
                        <img class="ratingVS ratingVS-5.0" alt="5.0" src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
                     </div>
                     <a href="/web/20081217104312/http://www.youtube.com/user/werewolfchewtoy" onmousedown="urchinTracker('/Events/VideoWatch/RecentRating');" class="hLink smallText">werewolfchew...</a>
                  </div>
                  <div class="watch-recent-rating-entry">
                     <div>
                        <img class="ratingVS ratingVS-5.0" alt="5.0" src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
                     </div>
                     <a href="/web/20081217104312/http://www.youtube.com/user/airrocker001" onmousedown="urchinTracker('/Events/VideoWatch/RecentRating');" class="hLink smallText">airrocker001</a>
                  </div>
                  <div class="watch-recent-rating-entry">
                     <div>
                        <img class="ratingVS ratingVS-5.0" alt="5.0" src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
                     </div>
                     <a href="/web/20081217104312/http://www.youtube.com/user/FireOfsatan" onmousedown="urchinTracker('/Events/VideoWatch/RecentRating');" class="hLink smallText">FireOfsatan</a>
                  </div>
                  <div class="clear"></div>
               </div>
            </div>
            <div id="watch-full-stats">
               <div id="watch-honors" class="expand-panel expanded small-expand-panel">
                  <a href="#" class="expand-header"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="" class="arrow">Honors for this video</a>
                  <div class="expand-content">
                     <div class="watch-full-stats-class">
                        Loading...
                     </div>
                  </div>
               </div>
               <div id="watch-honors" class="expand-panel expanded small-expand-panel">
                  <a href="#" class="expand-header"><img src="http://web.archive.org/web/20081217104312im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="" class="arrow">Sites linking to this video</a>
                  <div class="expand-content">
                     <div class="watch-full-stats-class">
                        Loading...
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

