<?php
$page_title = 'User Login';
include('includes/header.html');
if(isset($_SESSION["userID"]))
{
	header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//require('loginFunctions.php');
	require('includes/DBconnect.php');

	if(Login($_POST['email'], $_POST['pass']))
	{
		header("Location: index.php");
		//LOGGED IN
	}
	else
	{
		echo '<h1>Error!</h1>
		<p class="error">Email or password is incorrect.</p><br>';
	}
} // End of the main submit conditional.

?>
	  <div class="container mt-3">
      <div class="row">
        <div class="col-12">
<br>
<h1>Login</h1>

<form action="login.php" method="post">
	
	<p>Email Address: <input type="email" name="email" size="20" maxlength="60"> </p>
	<p>Password: <input type="password" name="pass" size="20" maxlength="20"></p>
	<p><input type="submit" name="submit" value="Login"></p>

	</form>

<?php
include('includes/footer.html');
?>

