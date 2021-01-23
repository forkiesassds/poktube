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
<h1>All videos</h1>
<?php
$con=mysqli_connect("localhost", "root", "", "video");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM videos");

echo "<table border='2'>
<tr>
<th>ID</th>
<th>Video</th>
<th>File name</th>
<th>Description</th>
<th>Uploader</th>
<th>Uploaded</th>
<th>Link</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['0'] . "</td>";
echo "<td>" . $row['1'] . "</td>";
echo "<td>" . $row['2'] . "</td>";
echo "<td>" . $row['3'] . "</td>";
echo "<td>" . $row['4'] . "</td>";
echo "<td>" . $row['6'] . "</td>";
echo "<td><a href=\"watch.php?v=" . $row['0'] . "\"</a>Watch</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
