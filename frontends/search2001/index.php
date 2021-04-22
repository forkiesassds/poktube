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
?>
<html>
   <head>
      <title>squareBracket</title>
      <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
      <style>
         <!--
            body {font-family: arial,sans-serif;}
            //-->
      </style>
   </head>
   <body onload="setfocus()" vlink="551a8b" text="#000000" link="#0000cc" bgcolor="#ffffff" alink="#ff0000">
      <center>
         <img src="logo.gif" alt="squareBracket" border="0"><br><br>
         <form action="search.php" method="get" name="f">
            <table cellspacing="0" cellpadding="0">
               <tbody>
                  <tr valign="baseline" align="center">
                     <td width="75">&nbsp;</td>
                     <td nowrap=""><font size="-1" face="arial,sans-serif">
					 <?php
					 if ($result = mysqli_query($connect, "SELECT * FROM videodb")) {

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);

    printf("Search %d videos\n", $row_cnt);

    /* close result set */
    mysqli_free_result($result);
}?>
					 </font></td>
                     <td></td>
                  </tr>
                  <tr valign="middle" align="center">
                     <td width="75">&nbsp;</td>
                     <td align="center"><input type="text" value="" framewidth="4" name="q" size="55"><br><input name="btnG" type="submit" value="squareBracket Search"><input name="btnI" type="submit" value="I'm Feeling Lucky"></td>
                     <td valign="top" nowrap="" align="left"><font size="-2" face="arial,sans-serif">&nbsp;<a href="/web/20001203203800/http://www.google.com/advanced_search">Advanced&nbsp;Search</a><br>&nbsp;<a href="/web/20001203203800/http://www.google.com/preferences">Preferences</a></font></td>
                  </tr>
               </tbody>
            </table>
         </form>
         <br><font size="-1"><a href="https://web.archive.org/web/20001203203800/http://directory.google.com/"> <font color="#006600"><b>Google Web Directory</b></font></a><br> <font color="#006600"><i>the web organized by topic</i></font></font><br><br><br>
         <p><font size="-1">Do-it-yourself keyword advertising. <a href="https://web.archive.org/web/20001203203800/https://adwords.google.com/AdWords/Welcome.html">Google AdWords works</a>.</font>
            <br><br><br><font size="-1"><a href="jobs/">Cool Jobs</a> - <a href="ads/">Advertise with Us</a> - <a href="language.html">Google in your Language</a> - <a href="about.html"><b>All&nbsp;About&nbsp;Google</b></a></font>
         </p>
         <p><font size="-2">©2021 Chaziz</font></p>
      </center>
   </body>
</html>

