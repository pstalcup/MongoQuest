<?php include "db_connect.php";?>
<?php
	  if(session_destroy()){
		echo "<p>Logged out successfully!</p>\n";
		echo '<form method="post" action="login.php">
			<input type="submit" value="Back" name="back" />
			</form>';
	 }
	 else{
		echo "<p>Could not log you out!</p>\n";
		echo '<form method="post" action="login.php">
			<input type="submit" value="Back" name="back" />
			</form>';
	 }
?>