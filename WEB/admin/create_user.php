<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
				<link rel = "stylesheet" type = "text/css" href = "add_format.css" />
				<link rel="stylesheet" type="text/css" href="../css/basket_format.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

</head>
<body>


<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
     
	  <h1> Admin - Create User</h1>
    </div>

</div>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #555555">
  <a class="navbar-brand" href="/admin/home.php">Admin Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div  class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
    <a class="nav-link" href="workshop_details.php">View Meetings</a>
      <li class="nav-item">
	  <?php  if (isset($_SESSION['user'])) : ?>
	  <a class="nav-link" href="create_user.php">Add User</a>
	  <?php endif ?>
      </li>
      <li class="nav-item">
	  <?php  if (isset($_SESSION['user'])) : ?>
	  <a class="nav-link" href="add_product.php"> Add Product</a>
	  <?php endif ?>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orders.php" >View Orders</a>
      </li>
     
    </ul>
    
    <ul class="navbar-nav  my-2 my-lg-0">
    <li class =nav-item>
        <p class="nav-link" style="color:white;">   <?php echo "Welcome  " ; echo  $_SESSION['user']['Username']; ?> </p>
    </li>
    <li class="nav-item">
	<a class="nav-link" href="../home.php?logout='1'" >Logout</a>
    </li>
   
    </ul>
  </div>
</nav>


	
	<div class="container">
    
  <div class="frame">
 <form class="form-signin"  method="post" name="form" enctype="multipart/form-data">
 <?php echo display_error(); ?>
 <div class="contents">
          <label for="name">Name</label>
          
          <input type="text" name="name" placeholder=""/>
          <label for="product_name">Username</label>
          
          <input type="text" name="username" placeholder=""/>
          
          <label for="product_type">Email</label>
          <input  type="text" name="email" placeholder=""/>

          <br>

           <label for="product_name">User Type</label>
            <select name="user_type" id="user_type" >
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select> 
          
          <br>
          <br>
		  <label for="password">Password</label>
          
          <input type="password" name="password_1" placeholder=""/>
          
          <br>
		  <label for="price">Confirm Password</label>
          
         
          <input type="password" name="password_2" placeholder=""/>
          <br>
          <br>
           <!-- <input type="submit" name="upl" value="Upload the picture"/> -->
          
          
          <button class="submit"  name="register_btn">Create User</button>
    </div>
                        </form>

                        </div>
                    </div>
</body>
</html>