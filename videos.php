<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include "header.php";
?>
<table width="800" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr>
		<td style="padding-bottom: 25px;" bgcolor="#FFFFFF">
		<div style="padding: 0px 5px 0px 5px;">
<div class="tableSubTitle">All videos</div>
<?php
$con=mysqli_connect("localhost", "root", "", "poktube");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM videodb");

echo "
<table cellspacing='0' cellpadding='0' border='0' class='roundedTable' bgcolor='#cccccc' border='2'>
<tbody>
<tr>
<th>ID</th>
<th>Thumbnail</th>
<th>Video</th>
<th>Description</th>
<th>Uploader</th>
<th>Uploaded</th>
<th>Link</th>
</tr>
</tbody>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td class='moduleEntry_alt'>" . $row['0'] . "</td>";
echo "<td class='moduleEntry_alt'><img src=\"content/thumbs/" . $row['0'] . ".png" . "\" width=\"120\" height=\"90\"</img></td>";
echo "<td class='moduleEntry_alt'>" . $row['1'] . "</td>";
//echo "<td class='moduleEntry_alt'>" . $row['7'] . "</td>";
echo "<td class='moduleEntry_alt'>" . $row['2'] . "</td>";
echo "<td class='moduleEntry_alt'>" . $row['3'] . "</td>";
echo "<td class='moduleEntry_alt'>" . $row['4'] . "</td>";
echo "<td class='moduleEntry_alt'><a href=\"watch.php?v=" . $row['0'] . "\"</a>Watch</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
</div>
</td>
</tr>
</tbody>
</table>
</html>
