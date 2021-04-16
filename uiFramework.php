<?php
function makeBox($title, $content) {
	echo "<div class='headerRCBox'>
    <div class='content'><span class='headerTitle'>$title</span></div>
	</div>
	<div class='contentBox'>
	$content
	</div>
	<br/>";
}
?>