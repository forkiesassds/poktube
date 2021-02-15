<div id="footer">

<table cellpadding="10" cellspacing="0" border="0" align="center">
	<tr>
		<td align="center" valign="center">
			<span class="footer"><a href="#">What's New</a> | <a href="#">About Us</a> | <a href="help.php">Help</a> | <a href="#">Developers</a> | <a href="terms.php">Terms of Use</a> | <a href="#">Privacy Policy</a> 
			<br>
			<br>
			<a href="https://www.youtube.com/channel/UCMnG3eA5QcSgIPsavuW4ubA"><img src="img/chaziz.png"><br></a>
			Copyright &copy; 2021 Chaziz <br/>
			<?php $output=null; $output2=null; exec("git show --format=\"Revision %h commited on %cI\" --no-patch 2>&1", $output, $output2); echo $output[0]; ?>
			</td>
	</tr>
</table>		</div>
	</div>
</div>