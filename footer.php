<!---- footer start ----->
<div class="ui inverted footer segment">
	<div class="ui doubling stackable container">
		<div class="ui inverted horizontal link list">
			<a href="#" class="item">What's New</a>
			<a href="#" class="item">About Us</a>
			<a href="help.php" class="item">Help</a>
			<a href="#" class="item">Developers</a>
			<a href="terms.php" class="item">Terms of Use</a>
			<a href="#" class="item">Privacy Policy</a>
		</div>
		<br/>
		<a href="https://www.youtube.com/channel/UCMnG3eA5QcSgIPsavuW4ubA"><img src="img/chaziz.png"></a><br/>
		<span class="item">Copyright &copy; 2021 Chaziz</a><br/>
		<p><small><?php $output=null; $output2=null; exec("git show --format=\"Revision %h (%s) commited on %cI by %an\" --no-patch 2>&1", $output, $output2); echo $output[0]; ?></p></small>
		<small><a href="githistory.php">More Git info</a></small>
	</div>
</div>
<!---- footer end ----->
<?php
include "watermark.php";
?>