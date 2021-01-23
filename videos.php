<?php
$con=mysqli_connect("localhost", "root", "", "video");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM videos");

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Video</th>
<th>File name</th>
<th>Description</th>
<th>Uploader</th>
<th>Uploaded</th>
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
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
