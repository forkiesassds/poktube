<?php include("header.php"); ?>
<title>PokTube</title>
<?php
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($connect,"SELECT * FROM users");

echo "<table cellspacing='0' cellpadding='0' border='0' class='roundedTable' bgcolor='#cccccc' border='2'>
<tr>
<th>ID</th>
<th>PFP</th>
<th>Username</th>
<th>Created</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td class='moduleEntry_alt'>" . $row['0'] . "</td>";
echo "<td class='moduleEntry_alt'><img src=\"content/profpic/" . $row['1'] . ".png" . "\" width=\"64\" height=\"64\"</img></td>";
echo "<td class='moduleEntry_alt'>" . $row['1'] . "</td>";
echo "<td class='moduleEntry_alt'>" . $row['3'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
<?php include("footer.php"); ?>