<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/register.css">

</head>
<div class="signup-form">
<body>
<div class="header">
	<h2>Login</h2>
</div>

	<form method="post" action="login.php">

		<?php echo display_error(); ?>
		<label>Username</label>
		<div class="input-group">
			
			<input type="text" name="username" >
		</div>
		<label>Password</label>
		<div class="input-group">
			
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>

</div>
</body>
</html>