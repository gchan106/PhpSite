<?php 
// This script performs an INSERT query to add a record to the users table.
$page_title = 'User Registeration';

include('includes/header.html');
?>
<script src="js/signup.js"></script>
<?php

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require("includes/DBconnect.php"); // Connect to the db.

	$errors = []; // Initialize an error array.


	// Check for an email address:
	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pass1']) || empty($_POST['pass2'])) 
	{
		array_push($errors, 'Please fill in all fields.');
	} 
	else 
	{
		if ($_POST['pass1'] != $_POST['pass2']) 
		{
			array_push($errors, 'Passwords dont match.');
		} 
		else 
		{
			if(UserExists($_POST["email"]))
			{
				array_push($errors, 'Please fill in all fields.');
			}
			else
			{
				$result = AddUser($_POST["name"], $_POST["email"], $_POST["pass1"], 0);//0 is normal user, 1 is admin.
				if($result)
				{
					echo '<br><br><p>Successfully registered in. Redirecting.</p>';
					header("refresh:5, url=login.php");
				}
				else
				{
					array_push($errors, 'Fatal Error');
				}
			}
		}
	}

	foreach ($errors as $msg) { // Print each error.
		echo " - " . $msg . "<br>";
	}

} // End of the main Submit conditional.
?>
<br><br>
<h1>Register</h1>
<form action="register.php" method="post" id="form-signup">
<p>Name: <input type="text" name="name" size="20" maxlength="60" > </p>
<p>Email Address: <input type="email" name="email" size="20" maxlength="60" > </p>	
	<p>Password: <input type="password" name="pass1" id="pass1" size="10" maxlength="20"></p>
	<p>Confirm Password: <input type="password" name="pass2" id="pass2" size="10" maxlength="20" ></p>

	<p><input type="submit" name="submit" value="Register"></p>
</form>
<br><br>

<?php 
include('includes/footer.html'); 
?>