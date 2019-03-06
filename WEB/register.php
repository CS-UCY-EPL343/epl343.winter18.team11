
<?php
   include('functions.php')    
?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/register.css">

</head>
<div class="signup-form">
<body>
<div class="header">
	<h2>Sign up</h2>
</div>



<form method="post" action="register.php">
<?php echo display_error(); ?>
	<label>Username</label>
	<div class="input-group">
		
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>


	<label>Email</label>
	<div class="input-group">
		
		<input type="text" name="email" value="<?php echo $email; ?>">

	</div>
	
	<label>Password</label>
	<div class="input-group">
		
		<input type="password" name="password_1">
	</div>

	<label>Confirm password</label>
	<div class="input-group">
	
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>

</div>
</body>
</html>