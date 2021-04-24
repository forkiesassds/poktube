<?php
include("header.php");
if(isset($_POST['prof_name'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_name=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_age'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_age=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_city'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_city=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_hometown'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_hometown=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_country'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_country=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_occupation'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_occupation=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_interests'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_interests=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_music'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_music=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_books'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_books=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_movies'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_movies=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_website'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_website=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['channel_color'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET channel_color=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set color.</h1></center><br><br>";
}
if(isset($_POST['channel_bg'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET channel_bg=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set color.</h1></center><br><br>";
}
if(isset($_POST['channel_inside'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET channel_inside=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set color.</h1></center><br><br>";
}
if(isset($_POST['channel_text'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET channel_text=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set color.</h1></center><br><br>";
}
if(isset($_POST['sumbit-player'])) {
   if(isset($_POST['player']) && 
   $_POST['player'] == '1')
{
    $setinfo = 1;
}
else
{
    $setinfo = 0;
}	 
$user = $_SESSION['username']; // get username to set about to
echo "<br><br><center><h1>" . $_POST['player'] ."</h1></center><br><br>";
$stmt = $connect->prepare("UPDATE users SET player=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set setting.</h1></center><br><br>";
}

?>