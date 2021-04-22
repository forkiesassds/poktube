<?php 
if(!isset($_SESSION)){
    session_start();
}
include("../../db.php"); //this is the db shit from parent directory, no duplicate files !!!
$datenow = date("Y-m-d");
if(isset($_SESSION["username"])) {
$username = htmlspecialchars($_SESSION["username"]);
$detail = mysqli_query($connect, "SELECT * FROM users WHERE username='". $username ."'"); // selects details of user
$detail2 = mysqli_fetch_assoc($detail); // function for getting details of user
if ($detail2["registeredon"] == null) {
	$stmt = $connect->prepare("UPDATE users SET registeredon = ? WHERE username = ?"); // prepares sql commands in prepared statement
	$stmt->bind_param("ss", $datenow, $username);
	$stmt->execute(); // this is to remove SQL injection, and to update the last online date.
}
}

$vidfetch = mysqli_query($connect, "SELECT * FROM videodb");

$con = $connect;
if( $con->connect_error){
    die('Error: ' . $con->connect_error);
}
$sql = "SELECT * FROM `videodb`";
if( isset($_GET['q']) ){
    $name = mysqli_real_escape_string($connect, htmlspecialchars($_GET['q']));
    $sql = "SELECT * FROM `videodb` WHERE VideoName LIKE '%{$name}%' AND `isApproved`='1'";
}
$result = $connect->query($sql);
?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<title>squareBracket Search: <?php echo $_GET['q'];?> </title>
<style><!--
body {font-family: arial,sans-serif;}
div.nav {margin-top: 1ex;}
div.nav A,span.nav {font-size: 10pt; font-family: arial,sans-serif;}
div.nav A,span.big {font-size: 12pt; color: #0000cc;}
div.nav A {font-size: 10pt; color: black;}
A.l:link {color: #6f6f6f;}
//--></style>
</head>
<body vlink="#551A8B" text="#000000" link="#0000cc" bgcolor="#ffffff" alink="#ff0000">
<form method="GET" action="search.php"><table cellspacing="0" cellpadding="2" border="0"><tbody><tr><td rowspan="2"><a href="index.php"><img src="logo.gif" alt="squareBracket " height="78" border="0"></a></td><td nowrap=""><font size="-1" face="arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;<a href="/web/20001203022100/http://google.com/advanced_search?q=news&amp;lr=&amp;safe=off">Advanced Search</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/web/20001203022100/http://google.com/preferences?q=news&amp;lr=&amp;safe=off">Preferences</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/web/20001203022100/http://google.com/intl/en_extra/help.html">Search&nbsp;Tips</a></font></td></tr><tr><td valign="middle" align="left"><input type="text" name="q" size="31" maxlength="256" value="<?php echo $_GET['q'];?>"> <input type="hidden" name="lr" value=""><input type="hidden" name="safe" value="off"><input type="submit" name="btnG" value="squareBracket Search"> <input type="submit" name="btnI" value="I'm Feeling Lucky"><br>
</td></tr></tbody></table>
<table width="100%" cellspacing="0" cellpadding="2" border="0"><tbody><tr><td nowrap="" bgcolor="#3366cc" align="left"><font size="-1" face="arial,sans-serif" color="white">Searched the web for <b><?php echo $_GET['q'];?></b>. &nbsp; </font></td><td nowrap="" bgcolor="#3366cc" align="right"><font size="-1" face="arial,sans-serif" color="white">Results <b>1 - 10</b> of about <b>109,000,000</b>.  Search took <b>0.16</b> seconds.</font></td></tr></tbody></table><br><table width="100%" cellspacing="0" cellpadding="1" border="0"><tbody><tr><td nowrap=""><font size="-1" face="arial,sans-serif" color="#6f6f6f">Categories:</font>&nbsp;&nbsp;&nbsp;<font size="-1" face="arial,sans-serif"><a href="http://web.archive.org/web/20001203022100/http://directory.google.com/Top/News/">News</a>&nbsp;&nbsp; <a href="http://web.archive.org/web/20001203022100/http://directory.google.com/Top/News/Directories/">News&nbsp;&gt;&nbsp;Directories</a>&nbsp;&nbsp; </font></td></tr></tbody></table><p><table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td valign="top"><font face="arial,sans-serif" color="#6f6f6f"><font size="-1">News:</font>&nbsp;&nbsp;</font></td><td valign="top" nowrap=""><font size="-1" face="arial,sans-serif" color="#6f6f6f"><a href="/web/20001203022100/http://google.com/url?sa=X&amp;start=0&amp;num=3&amp;q=http://news.excite.com/news/reuters/">Reuters Top <b>News</b></a> (Excite Reuters - 12/2/2000)<br><a href="/web/20001203022100/http://google.com/url?sa=X&amp;start=1&amp;num=3&amp;q=http://news.excite.com/more/science/">Science <b>News</b></a> (Excite - 12/2/2000)<br><a href="/web/20001203022100/http://google.com/url?sa=X&amp;start=2&amp;num=3&amp;q=http://cbs.marketwatch.com/news/current/newswatch.htx?source=htx/http2_mw">Newswatch: Latest <b>news</b>, commentary from CBS.MarketWatch.com</a> (CBS MarketWatch - 12/2/2000)<br></font></td></tr></tbody></table>
</p>
<?php
$sql = mysqli_query($connect, "SELECT * FROM `videodb` WHERE VideoName LIKE '%{$name}%' AND `isApproved`='1'"); //instructions for sql, also WHERE with ORDER BY works, icty, you said that it didn't in FEB 24 2021, you're wrong.

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
echo "<p><a href='http://web.archive.org/web/20001203022100/http://www.internetnews.com/ec-news/'>$namevideolist</a><font size='-1'><br>$descvideolist
<br><font color='green'>" . $_SERVER['HTTP_HOST'] . "/watch.php?$idvideolist - $viewsvideolist - <a href='#' class='l'>Cached</a> - <a href='#' class='l'>Similar pages</a></font>
<br>[ <a href='/profile.php?user=$uploadervideolist&page=videos' class='l'>More videos from " . $uploadervideolist . "</a> ]
</font><br>
</p></blockquote>";
};
//<a href='watch.php?v=$idvideolist&player=1'>Flash Player</a> - <a href='watch.php?v=$idvideolist&player=2'>ActiveX</a>
?>
<center>
<div class="nav">
<p><table width="10%" cellspacing="0" cellpadding="0" border="0"><tbody><tr valign="top" align="center"><td valign="bottom" nowrap=""><font size="-1" face="arial,sans-serif">Result&nbsp;Page:&nbsp;</font></td>
<td><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_first.gif" alt=""></td>
<td><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_current.gif" alt=""><br><span class="nav"><font color="#A90A08">1</font></span></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=10&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>2</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=20&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>3</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=30&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>4</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=40&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>5</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=50&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>6</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=60&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>7</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=70&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>8</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=80&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>9</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=90&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_page.gif" alt="" border="0"><br>10</a></td>
<td nowrap=""><a href="/web/20001203022100/http://google.com/search?q=news&amp;lr=&amp;safe=off&amp;start=10&amp;sa=N"><img src="/web/20001203022100im_/http://google.com/intl/en_extra/nav_next.gif" alt="" border="0"><br><span class="big"><b>Next</b></span></a></td></tr></tbody></table>
</p></div></center>

<br clear="all"><center><table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td nowrap="">
<form method="GET" action="/web/20001203022100/http://google.com/search"><center><font face="arial,sans-serif"><small><input type="text" name="q" size="31" maxlength="256" value="news"> <input type="submit" name="btnG" value="Google Search"><input type="hidden" name="lr" value=""><input type="hidden" name="safe" value="off"> <a href="/web/20001203022100/http://google.com/swr?q=news&amp;lr=&amp;safe=off&amp;swrnum=109000000">Search&nbsp;within&nbsp;results</a></small></font>
</center></form></td></tr></tbody></table></center>
<p></p><center><table width="100%" cellspacing="0" cellpadding="2" border="0"><tbody><tr><td width="100%" bgcolor="#3366cc"><font face="arial,sans-serif" color="white"><font size="-1"><center><a href="http://web.archive.org/web/20001203022100/http://directory.google.com/"><font color="white">Google&nbsp;Web&nbsp;Directory</font></a> - <a href="/web/20001203022100/http://google.com/intl/en_extra/jobs/"><font color="white">Cool&nbsp;Jobs</font></a> - <a href="/web/20001203022100/http://google.com/intl/en_extra/ads/"><font color="white">Advertise&nbsp;with&nbsp;Us!</font></a> - <a href="/web/20001203022100/http://google.com/intl/en_extra/services/"><font color="white">Add&nbsp;Google&nbsp;to&nbsp;your&nbsp;Site</font></a> - <a href="/web/20001203022100/http://google.com/intl/en_extra/language.html"><font color="white">Google&nbsp;in&nbsp;your&nbsp;Language</font></a> - <b><a href="/web/20001203022100/http://google.com/intl/en_extra/about.html"><font color="white">All&nbsp;About&nbsp;Google</font></a></b></center></font></font></td></tr></tbody></table><br><font size="-1" color="#6f6f6f">©2000 Google</font></center>

</form></body></html>