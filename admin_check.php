<?php
include "header.php";
?>
<?php
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($connect,"SELECT * FROM users WHERE `username` = '". $_SESSION["username"] ."'");

$vdf = mysqli_fetch_assoc($result);

$isAdmin = $vdf['is_admin'];

echo $isAdmin;
echo $_SESSION["username"];
echo "<br>";
echo "SELECT * FROM users WHERE `username` = '". $_SESSION["username"] ."'";

  if($isAdmin == 1)
  {
    echo "ASS";
  }
  else
  {
    echo "COCK";
  }

mysqli_close($connect);
?>