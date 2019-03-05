<?php 
include('../functions.php');



if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/home.css">
<link rel = "stylesheet" type = "text/css"  href = "add_format.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<title>Home</title>

	
</head>



<body>
<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo">
     
	  <h2 style="color:black; font-size:50px; text-align:center; margin-top:550px"> Admin - Home Page</h2>
    </div>



	<nav style="width:100%"  class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div  class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="products.php" >Products</a>
    </li>
      <li class="nav-item dropdown">
  
        <a class="nav-link dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="products_ovenware.php">Ovenware Pots</a>
          <a class="dropdown-item" href="products_decorative.php">Decorative Pots</a>
          <a class="dropdown-item" href="products_food_drink.php">Food & Drink Pots</a>
          <a class="dropdown-item" href="products_ecclesiastical.php">Ecclesiastical Pots</a>
          <a class="dropdown-item" href="products_cyprus.php">Cyprus Souvenirs Pots</a>
          <a class="dropdown-item" href="products_ancient.php">Ancient Pots</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" >Workshop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="basket.php" >Basket</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" >Contact</a>
      </li>
     
    </ul>
    
    <ul class="navbar-nav  my-2 my-lg-0">
    <li class="nav-item">
          <a class="nav-link" onclick="window.location.href='login.php'">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" onclick="window.location.href='register.php'">Sign up</a>
    </li>
    </ul>
  </div>
</nav>


	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
		

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<?php echo "Welcome" ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
					
						<i  style="color: black;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="../home.php?logout='1'" style="color: red;">logout</a>
						<br>
                       &nbsp; <a style="font-size:25px; color:black" href="create_user.php">+ add user</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>

	<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					
					<br>
					<small>
					&nbsp; <a style="font-size:25px; color:black" href="add_product.php"> + add product</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>




</body>
</html>