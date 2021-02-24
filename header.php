<?php 
session_start(); 
include("db.php");
$datenow = date("Y-m-d");
if(isset($_SESSION["username"])) {
$username = htmlspecialchars($_SESSION["username"]);
$detail = mysqli_query($connect, "SELECT * FROM users WHERE username='". $username ."'"); // selects details of user
$detail2 = mysqli_fetch_assoc($detail); // function for getting details of user
$isAdmin = $detail2['is_admin'];
if ($detail2["registeredon"] == null) {
	$stmt = $connect->prepare("UPDATE users SET registeredon = ? WHERE username = ?"); // prepares sql commands in prepared statement
	$stmt->bind_param("ss", $datenow, $username);
	$stmt->execute(); // this is to remove SQL injection, and to update the last online date.
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="http://localhost/poktube/img/poktube_bootstrap_mod.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	
    <title>Hello, world!</title>
  </head>
  <body>
<!---- header start ----->
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">[squareBracket]</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	   <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
		<?php if(isset($_SESSION["username"])) {
		echo "<li class='nav-item'>
          <a class='nav-link' href='profile.php?user=". $_SESSION["username"] . "'>" . $_SESSION["username"] . "</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='logout.php'>Log Out</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='my_profile.php'>Settings</a>
        </li>
		<li class='nav-item'>
          <a class='nav-link' href='help.php'>Help</a>
        </li>
      </ul>";
	} else {
		echo "<li class='nav-item'>
          <a class='nav-link' href='signup.php'>Sign Up</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='login.php'>Sign In</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='help.php'>Help</a>
        </li>
      </ul>";
	}?>
    </div>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="browse.php">Videos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://discord.gg/VmTpweM6w2">Discord</a>
        </li>
							<?php 
if(isset($_SESSION["username"])) {
if($isAdmin == 1) // is logged in and is admin?
{
echo "<li class='nav-item'>
<a class='nav-link' href='admin.php'>Admin</a>
</li>";
}
else
{
    echo "";
}
}?>
      </ul>
    </div>
  </div>
</nav>
<!---- header end ----->