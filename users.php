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
error_reporting(0); //fixing the query issue breaks comment sections.
?>
<div class="page_title">All users</div>
<?php
$con=mysqli_connect("localhost", "root", "", "users");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM users");

echo "<table border='2'>
<tr>
<th>ID</th>
<th>PFP</th>
<th>Username</th>
<th>Created</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['0'] . "</td>";
echo "<td><img src=\"pfp/" . $row['1'] . ".png" . "\" width=\"64\" height=\"64\"</img></td>";
echo "<td>" . $row['1'] . "</td>";
echo "<td>" . $row['3'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
