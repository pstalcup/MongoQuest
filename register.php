<?php include("db_connect.php") ?>
<html>
<body>
<?php

        if(isset($_POST['pass']) && $_POST['cpass'] == $_POST['pass'])
        {
                $conn = $db->users;
                
                $query = Array('name' => $_POST['name']);
                
                $res = $conn->find($query);
                
                if($res->count() != 0)
                {
                        echo("Sorry, an account by that name already exists. Click <a href='register.php'>here</a> to register again");
                }
                else
                {
						$_SESSION['name'] = $_POST['name'];
                        $query = Array('name' => $_POST['name'],
                                        'password' => $_POST['pass']);
                        $conn->insert($query);
                        echo("Successfully Registered!");
						echo '<br><br><a href=location.php?l=class_select>Play!<a>';
						
                }
        }
        else
        {
        echo('

<form action="register.php" method="post">

<h2>Register</h2>
<table>
<tr><td>Name: </td><td><input type="text" name = "name"></td></tr>
<tr><td>Password: </td><td><input type="password" name = "pass"></td></tr>
<tr><td>Confirm Password </td><td><input type= "password" name = "cpass"></td></tr>
<tr><td><input type= "submit" value = register></td></tr>
</form>

');
}
?>