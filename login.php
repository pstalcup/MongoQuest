<?php include("db_connect.php") ?>
<html>
	<header>
	make_header();
		<!--<style type="text/css">
			#wrapper {
				position: absolute;
				bottom: 50%;
				right: 50%;
				height: 300px;
				width: 300px;
			}
			 #container{
				position: relative;
				left: 50%;
				top: 50%;
			}-->
	</header>
	
	<div class="wrapper">
	<div class="container">

<?php
	if(isset($_POST['username']))
	{
		$conn = $db->users;
		
		$query = Array('name' => $_POST['username'], 'password' => $_POST['password']);
		
		$res = $conn->find($query);
		if($res->count() == 0)
		{
			echo("Login Failed. Try again");
			echo '<meta HTTP-EQUIV="REFRESH" content="0; url=http://localhost/pokeMongo/login.php">';
		}
		else
		{
			$_SESSION['name'] = $_POST['username'];
			echo '<meta HTTP-EQUIV="REFRESH" content="0; url=http://localhost/pokeMongo/location.php">';
		}
	}
	else
	{
		echo("
		<h2>Login</h2>
		<form method='post' action='login.php'>
		<table>					
			<tr><td>Username: </td><td><input type='text' length='25' name='username'></td></tr>
			<tr><td>Password: </td><td><input type='password' name='password'></td></tr>
			<tr><td><input type='submit' value='login'><br><br></td></tr>
			<tr></tr><tr></tr><tr></tr><tr><td><a href='register.php'>register</a></tr></td>
		</table>
		   </form>");
	}

?>
</div>
</div>
</html>