<?php 
include("header.php"); 
include("auth.php");
?>
<title>My Profile</title>
<!-- the profile pic is asked with the png command, for anything else
	make it a SQL query or whatever the fuck -->

<?php
$target_dir = "/usr/share/nginx/html/content/profpic/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileToUpload = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
//if (file_exists($target_file)) {
//  echo "Sorry, file already exists.";
//  $uploadOk = 0;
//}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "png") {
  echo "Sorry, PNG files are only supported.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $_SESSION['username'] . ".png")) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    //echo "Sorry, there was an error uploading your file.";
	echo htmlspecialchars($target_dir . $_SESSION['username'] . ".png");
  }
}
?>
<div class="tableSubTitle">My Profile</div>
<h3>IMPORTANT NOTICE: Uploading does NOT work. I know this. Do not bother me about it.</h3>
<h2>Profile Picture</h2>
<img src="content/profpic/<?php echo $_SESSION['username']?>.png" width="128" height="128"">
<br>
<form action="my_profile.php" method="post" enctype="multipart/form-data">
  Select profile picture to upload:<br><br>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
<h4>Set information you want others to see</h4>
  <form action='setdesc.php' method='POST' name='setdesc' id='setdesc'>
  <br>
  <textarea rows="4" cols="50" maxlength="500" name="desc" form="setdesc" placeholder="Input your About Me here..." style="margin: 0px; height: 67px; width: 352px; resize: none;" required=""></textarea>
  <p>500 character limit.</p>
  <input type='submit' name="submit">
 </form>
 <br>
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Name       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_name">
  </form>
   <br>
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Age       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_age">
  </form>
   <br>
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  City       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_city">
  </form>
   <br>
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Hometown       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_hometown">
  </form>
   <br>
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Country       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_country">
  </form>
   <br>
 <br>
  <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Profile Foreground       :
  <input type='color' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="channel_color">
  </form>
   <br>
 <br>
  <!--
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Occupation       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_occupation">
  </form>
   <br>
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Interests and Hobbies       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_interests">
  </form>
   <br>
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Music       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_music">
  </form>
   <br>
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Books       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_books">
  </form>
   <br>
 <br>
 -->
 <!--
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Movies and Shows       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_movies">
  </form>
   <br>
   -->
 <br>
 <form action="setinfo.php" method="post" enctype="multipart/form-data">
  Website       :
  <input type='text' id='textbox' style="width: 250px;" name='textbox'>
  <input type="submit" value="Submit" name="prof_website">
  </form>
   <br>
 <br>
<br>
<?php include("footer.php"); ?>