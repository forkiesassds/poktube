<?php include("header_admin.php");
include("admin_check.php");
include("db.php"); 
if(!$admin=1) {
    die("<script>window.location = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'</script>"); // ASGYHAHHAHAH FUNNY NSAFYNFN FYNNY YOOO FMAIY GUY FINNY MEOMTNS
}
if(!isset($_POST["user"])){
	die('No user specified!');
} else {
	$user = $_POST["user"];
}
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(!isset($_POST['bannedUntil']) OR $_POST['bannedUntil'] == null) {
	$bannedUntil = 18446744073709551615;
} else {
	$bannedUntil = $_POST['bannedUntil'];
}
$one = 1;
$stmt = $connect->prepare("UPDATE users SET isBanned=?, banReason=?, bannedUntil=? WHERE username=?");
$stmt->bind_param("isis", $one, $_POST['banReason'], $bannedUntil, $user);
$stmt->execute();
echo "<script>window.location = 'admin.php'</script>";
?>
