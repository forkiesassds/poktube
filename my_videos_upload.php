<?php include("header.php"); ?>
<title>Upload - PokTube</title>
<div class="ui container">
	<div class="ui center aligned container">
		<h2 class="ui icon header">
		  <i class="upload icon"></i>
		  <div class="content">
			Upload Video
			<div class="sub header">Here you can upload videos to share them arround the world!</div>
		  </div>
		</h2>
	</div>
	<div class="ui center aligned text container">
		<div class="ui steps">
		  <div class="active step">
			<i class="info icon"></i>
			<div class="content">
			  <div class="title">Video Info</div>
			  <div class="description">Enter the name and description of your video.</div>
			</div>
		  </div>
		  <div class="step">
			<i class="upload icon"></i>
			<div class="content">
			  <div class="title">Upload Video File</div>
			  <div class="description">Choose the video you want to upload</div>
			</div>
		  </div>
		</div>
		<div class="ui secondary segment container">
			<form name="uploadForm" id="uploadForm" method="post" action="my_videos_upload_2.php" enctype="multipart/form-data">
				<div class="ui input">
					<input type="text" name="title" placeholder="Title" maxlength="100" style="width:295px">
				</div><br/><br/>
				<div class="ui input">
					<textarea name="desc" maxlength="500" form="uploadForm" placeholder="Description" style="width:295px;overflow:hidden;resize:none;background:#fff;" rows="3"></textarea>
				</div><br/><br/>
				<input class="ui primary button" type="submit" id="continue" name="continue" value="Continue ->">
			</form>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>