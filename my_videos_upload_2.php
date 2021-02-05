<?php
include("header.php");
include("auth.php");
$username = $_SESSION["username"]; 
$upload_msg = "";
$donotcontinue = 0;
function randstr($len, $charset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-"){
    return substr(str_shuffle($charset),0,$len);
}
function delete_directory($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}

$url_id = randstr(11);
$folder_id = randstr(26);
$vid_id = randstr(26);

if(isset($_POST["upload"])){
$vextension  = pathinfo( $_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION );
$target_file = "content/preload/".$folder_id."/".$vid_id.".".$vextension;
$target_folder = "content/video/".$folder_id;
$preload_folder = "content/preload/".$folder_id;
$target_thumb = "content/thumbs/".$url_id.".png";
$none = 0;
$category = "Gaming";
$thumbcmd = "ffmpeg -v error -i ".$target_file." -vframes 1 -an -s 240x180 -ss 1 ".$target_thumb;

if (!file_exists($target_folder)) {
	mkdir($target_folder);
}
if (!file_exists($preload_folder)) {
	mkdir($preload_folder);
}
    if(isset($_POST['upload']) AND isset($_SESSION["username"])){
        $name       = $_FILES['fileToUpload']['name'];  
        $temp_name  = $_FILES['fileToUpload']['tmp_name'];  // gets video info and thumbnail info
				if(move_uploaded_file($temp_name, $target_file) && $donotcontinue == 0){
					if($connect === false){
						die("ERROR: Could not connect. " . mysqli_connect_error()); // cannot connect to database therefore it stops uploading
						}
						if($vextension != "mp4" && $vextension != "mkv" && $vextension != "wmv" && $vextension != "flv" && $vextension != "avi") {
							echo "<center><h1>Your video is an incompatible format.<br>To continue uploading this video, convert it to a supported format.</h1></center>";
							die();
						}
						$width = exec("ffprobe -v error -select_streams v:0 -show_entries stream=width -of default=nw=1:nk=1 ".$target_file);
						$height = exec("ffprobe -v error -select_streams v:0 -show_entries stream=height -of default=nw=1:nk=1 ".$target_file);
						$checkerror = exec("ffmpeg -v error -i ".$target_file." -f null - >error.log 2>&1");
						if ( '' == file_get_contents("error.log") )
						{
							// good file, continues with process of uploading
							unlink("error.log");
						} else {
							echo "<center><h1>Your video is invalid or corrupt. Please choose a different file.</h1></center>";
							delete_directory($preload_folder);
							die();
						}
						if($width && $height < 2160) {
							// continues with upload
						} else {
							echo "<center><h1>Your video is too large. The limit is up to 2160x2160.</h1></center>";
							delete_directory($preload_folder);
							die();
						}
						$id = mysqli_real_escape_string($connect, $url_id);
						$title = $_POST['title'];
						$desc = $_POST['desc'];
						$uploader = mysqli_real_escape_string($connect, $username);
		 				exec("ffmpeg -i ".$target_file." -vf scale=-320:240  -c:v libx264 -b:v 350K -b:a 80k    -strict experimental content/video/".$folder_id."/".$vid_id.".mp4"); 
						$failcount = 0;
						
						clearstatcache();
						if ( 0 == filesize("content/video/".$folder_id."/".$vid_id.".mp4") ) {
							unlink("content/video/".$folder_id."/".$vid_id.".mp4");
							delete_directory($preload_folder);
							$failcount++;
						}
						if($failcount == 1) {
							echo "<center><h1>Your video was unable to be uploaded.<br>If you see this screen, report it to staff/admin.</h1></center>";
							die();
						}
						exec($thumbcmd);
						$datenow = date("Y-m-d");
						mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
						$stmt = $connect->prepare("INSERT INTO videodb (VideoID, VideoName, VideoDesc, Uploader, UploadDate, ViewCount, VideoCategory, VideoFile, CustomThumbnail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"); // add title, desc, through prepared statements
						$stmt->bind_param("sssssssss", $url_id, $title, $desc, $uploader, $datenow, $none, $category, $target_file, $none);
						// set params
						$target_file = $target_folder . "/" . $vid_id . ".mp4";
						$stmt->execute();
						$stmt = $connect->prepare("UPDATE users SET recent_vid = ? WHERE username = '".$uploader."'"); // add title, desc, through prepared statements
						$stmt->bind_param("s", $url_id);
						$stmt->execute();
						delete_directory($preload_folder);
						echo "<script>window.location.replace('watch.php?v=".$url_id."');</script>";
			} else {
				$upload_msg = 'You should select a file to upload!';
			}
		}
	} else {
		
	}
?>
<div id="uploadVid">
	<h2 style="color:green">Video Upload (Step 2 of 2)</h2>
	<form name="uploadForm" id="uploadForm" method="post" action="my_videos_upload_2.php" enctype="multipart/form-data">
	<input type="text" name="title" value="<?php echo $_POST["title"]; ?>" hidden>
	<textarea name="desc" maxlength="500" form="uploadForm" style="width:295px;overflow:hidden;resize:none" rows="3" hidden><?php echo $_POST["desc"]; ?></textarea>
	<center><table class="dataEntryTableSmall">
		<tbody><tr>
                <td width="125px" valign="top" align="right"><span style="font-size: 14px;font-weight:bold;">File:</span></td>
                <td style="background-color:#FEFFE0; color:#808536; padding:13px;"><input type="file" name="fileToUpload" id="fileToUpload" style="color:black" accept="video/mp4" required=""><br>
				<p><b>Max file size: 50 MB. No copyrighted, obscene, GoAnimate/Gacha, logokid or lazy reuploaded material.</b><br>After uploading, you can edit or remove this video at anytime under the "My Videos" link on the top of the page.</p></td>
            </tr>
            <tr>
                <td valign="top" align="right"><span></span></td>
                <td><br><h3>PLEASE BE PATIENT, THIS MAY TAKE SEVERAL MINUTES. ONCE COMPLETED, YOU WILL BE REDIRECTED INTO THE VIDEO PAGE. Note that thumbnails may not work.</h3></td>
            </tr>
<tr>
                <td width="" align="right" style="white-space: nowrap;"></td>
                <td>
        <br>
<input type="submit" id="upload" name="upload" value="Upload Video">
        </td>
            </tr>   
    </tbody></table></center>
	</form>
</div>
<?php include("footer.php"); ?>
