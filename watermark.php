<!--
SQUAREBRACKET PAGE <?php echo ($_SERVER['REQUEST_URI']);?> ACCESSED
<?php
$t=time();
echo(date("Y-m-d H:i:s",$t));?> 
WITH IP <?php echo ($_SERVER['REMOTE_ADDR']);?> [WITH <?php echo ($_SERVER['HTTP_USER_AGENT']); ?>].

Referer is <?php echo ($_SERVER['HTTP_REFERER']);?>
-->