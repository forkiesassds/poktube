<?php
function makeBox($title, $content) {
	echo "<div class='headerRCBox'>
	<b class='rch'>
	<b class='rch1'><b></b></b>
	<b class='rch2'><b></b></b>
	<b class='rch3'></b>
	<b class='rch4'></b>
	<b class='rch5'></b>
	</b> <div class='content'><span class='headerTitle'>$title</span></div>
	</div>
	<div class='contentBox'>
	$content
	</div>
	<br/>";
}
?>