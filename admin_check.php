<?php
include "db.php";
include "auth.php";
?>
<?php
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($connect,"SELECT * FROM users WHERE `username` = '". $_SESSION["username"] ."'");

$adf = mysqli_fetch_assoc($result);

$isAdmin = $adf['is_admin'];

$admin = 0;
if($isAdmin == 1) // is logged in?
{
$admin = 1;
}
else
{
    echo "<script>window.location = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'</script>"; // ASGYHAHHAHAH FUNNY NSAFYNFN FYNNY YOOO FMAIY GUY FINNY MEOMTNS
}

mysqli_close($connect);
?>