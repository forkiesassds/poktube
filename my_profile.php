<?php 
include("header.php"); 
include("auth.php");

$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $_SESSION['username'] ."'"); // calls for channel info
$cdf = mysqli_fetch_assoc($chanfetch);
$LastestVideo = htmlspecialchars($cdf['recent_vid']);
$Username = htmlspecialchars($cdf['username']);
$AboutMe = htmlspecialchars($cdf['aboutme']);
$VidsWatched = $cdf['videos_watched'];
$Name = htmlspecialchars($cdf['prof_name']);
$Age = htmlspecialchars($cdf['prof_age']);
$City = htmlspecialchars($cdf['prof_city']);
$Hometown = htmlspecialchars($cdf['prof_hometown']);
$Country = htmlspecialchars($cdf['prof_country']);
$Occupation = htmlspecialchars($cdf['prof_occupation']);
$Interests = htmlspecialchars($cdf['prof_interests']);
$Music = htmlspecialchars($cdf['prof_music']);
$Books = htmlspecialchars($cdf['prof_books']);
$Movies = htmlspecialchars($cdf['prof_movies']);
if($cdf['channel_color']) {
	$Foreground = htmlspecialchars($cdf['channel_color']);
} else {
	$Foreground = "#003366";
}
$Background = htmlspecialchars($cdf['channel_bg']);
if($cdf['prof_website']) {
$Website = htmlspecialchars($cdf['prof_website']);
} else {
	$Website = "";
}
$PreRegisteredOn = $cdf['registeredon'];
$DateTime = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime->format('F j Y');
$RegisteredYear = $DateTime->format('Y');
?>
<title>My Profile</title>
<!-- the profile pic is asked with the png command, for anything else
	make it a SQL query or whatever the fuck -->

<?php
if(isset($_FILES["fileToUpload"]["tmp_name"])) {
$target_dir = "content/profpic/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileToUpload = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
}

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
if(isset($_FILES["fileToUpload"]["tmp_name"])) {
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}
}

// Allow certain file formats
if(isset($_FILES["fileToUpload"]["tmp_name"])) {
if($imageFileType != "png") {
  echo "Sorry, PNG files are only supported.";
  $uploadOk = 0;
}
}

// Check if $uploadOk is set to 0 by an error
if(isset($_FILES["fileToUpload"]["tmp_name"])) {
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
}
?>
<div class="ui center aligned container">
	<h2 class="ui icon header">
	  <i class="settings icon"></i>
	  <div class="content">
		Profile Settings
		<div class="sub header">Manage your profile settings.</div>
	  </div>
	</h2>
	<div class="two column stackable ui padded grid">
		<div class="column">
			<div class="ui segment">
				<h2>Profile Picture</h2>
				<img src="content/profpic/<?php echo $_SESSION['username']?>.png" width="128" height="128" onerror="this.src='img/profiledef.png'">
				<br>
				<form action="my_profile.php" method="post" enctype="multipart/form-data">
					Select profile picture to upload:<br><br>
					<div class="ui action input">
						<input type="file" name="fileToUpload" id="fileToUpload">
						<button class="ui button" name="submit">Upload Image</button>
					</div>
				</form>
			</div>
		</div>
		<div class="column">
			<div class="ui segment">
				<h4>Set information you want others to see</h4>
				  <form action='setdesc.php' method='POST' name='setdesc' id='setdesc'>
				  <br>
				  <p>500 character limit.</p>
					<div class="ui form">
						<div class="ui input">
							<textarea placeholder="Input everything about yourself here..." name="desc" form="setdesc" rows="4" cols="50" maxlength="500"><?php echo $AboutMe;?></textarea>
						</div>
						<input type='submit' name="submit" class="ui button">
					</div>
				 </form>
				<form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Name       :
					  <div class="ui fluid action input">
						<input type="text" type='text' id='textbox' value="<?php echo $Name;?>" name='textbox'>
						<button class="ui button" type="submit" value="Submit" name="prof_name">Submit</button>
					  </div>
				</form>
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Age       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' value="<?php echo $Age;?>" name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_age">Submit</button>
				  </div>
				  </form>
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  City       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' value="<?php echo $City;?>" name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_city">Submit</button>
				  </div>
				  </form>
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Hometown       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' value="<?php echo $Hometown;?>" name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_hometown">Submit</button>
				  </div>
				  </form>
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Country       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' value="<?php echo $Country;?>" name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_country">Submit</button>
				  </div>
				  </form>
				  <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Profile Banner Color     :
				  <div class="ui fluid action input">
					<input type="color" type='text' id='textbox' value="<?php echo $Foreground;?>" name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="channel_color">Submit</button>
				  </div>
				  </form>
				  <!--
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Occupation       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_occupation">Submit</button>
				  </div>
				  </form>
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Interests and Hobbies       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_interests">Submit</button>
				  </div>
				  </form>
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Music       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_music">Submit</button>
				  </div>
				  </form>
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Books       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_books">Submit</button>
				  </div>
				  </form>
				 -->
				 <!--
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Movies and Shows       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_movies">Submit</button>
				  </div>
				  </form>
				   <br>
				   -->
				 <form action="setinfo.php" method="post" enctype="multipart/form-data">
				  Website       :
				  <div class="ui fluid action input">
					<input type="text" type='text' id='textbox' value="<?php echo $Website;?>" name='textbox'>
					<button class="ui button" type="submit" value="Submit" name="prof_website">Submit</button>
				  </div>
				  </form>
				</div>
			</div>
		<br>
	</div>
</div>
<?php include("footer.php"); ?>