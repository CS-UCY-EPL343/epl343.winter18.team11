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
<html lang="en">
        <head>
        <title>add_product</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel = "stylesheet" type = "text/css" href = "add_format.css" />
        <link rel="stylesheet" type="text/css" href="../css/basket_format.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        
        
        <?php
          function   el(){
                    $link = mysqli_connect("localhost", "emirapottery","s94mz5SN3Xu5Hafu","emirapottery");
                    if (isset($_POST['submit']))
                    {
                        $product_name   = $_POST['prod_name'];
                        $product_type  = $_POST['prod_type'];
                        $description = $_POST['descr'];
                        $price = $_POST['pr'];
                        
                            $img=$_FILES['image']['name'];
                            $target_file = "../images/$img";

                        $image1="http://cproject.in.cs.ucy.ac.cy/emirapottery/images/".$img;
                        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                        echo "Uploaded Successfully!";
                    
                        $sql = "INSERT INTO Product_web (Product_name, Product_Type, Description, price,image) VALUES ('$product_name', '$product_type', '$description','$price','$image1')";
                        mysqli_query($link, $sql);
                    }
                }
             ?>
               </head>
<body>


<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
     
	  <h1> Admin - Add Product</h1>
    </div>

</div>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #555555">
  <a class="navbar-brand" href="home.php">Admin Home</a>
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
                    <div class="contents"> 
                    <label for="product_name">Product Name</label>
                    <input type="text" name="prod_name" placeholder=""/>
                    <label for="product_type">Product Type</label>
                    <input  type="text" name="prod_type" placeholder=""/>        
                    <label for="product_name">Description</label>
                    <input type="text" name="descr" placeholder=""/>
                    <label for="price">Price</label>          
                    <input type="text" name="pr" placeholder=""/>
                    <label for="image">Choose Image</label>

                    
                    <input type="file" id="image" name="image" accept="image/*">
                    <!-- <input type="submit" name="upl" value="Upload the picture"/> -->
                    <br>
                    <br>
                    <button class="submit"  name="submit">Submit</button>
                        </div>
                </form>

                <?php
                    el();
                ?>
    </div>
</div>

      

</body>
</html>