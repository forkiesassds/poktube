<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include "header_admin.php";
include "db.php";
?>
<table width="800" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr>
		<td style="padding-bottom: 25px;" bgcolor="#FFFFFF">
		<div style="padding: 0px 5px 0px 5px;">
<div class="tableSubTitle">Gource Export</div>
<?php
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($connect,"SELECT * FROM videodb");

while($row = mysqli_fetch_array($result))
{
$VideoName = htmlspecialchars($row["VideoName"]);
$UploadDate = htmlspecialchars($row["UploadDate"]);
$Uploader = htmlspecialchars($row["Uploader"]);
$timestamp = strtotime($UploadDate);
echo "$timestamp|$Uploader|A|$VideoName<br>";
}


mysqli_close($connect);
?>
</div>
</td>
</tr>
</tbody>
</table>
</html>
