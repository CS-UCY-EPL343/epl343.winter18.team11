<?php

include('functions.php');

if (!isLoggedIn()) {
	header('location: ../login.php');
}

?>

<!DOCTYPE html>

<html lang="en">
  <head>
  <title>checkout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/basket.css">
  <link rel="stylesheet" type="text/css" href="css/checkout.css">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

   

  </head>
  <body>
  
  <div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
      <h1>Checkout</h1>
    </div>

</div>
          

    
        
       

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        <a class="nav-link" href="workshop.php" >Workshop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="basket.php" >Basket</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" >Contact</a>
      </li>
     
    </ul>
    
    <ul class="navbar-nav  my-2 my-lg-0">

    <li class =nav-item>
      <?php if (isset($_SESSION['success'])) : ?>
        <p class="nav-link" style="color:white;">   <?php  echo  $_SESSION['user']['username']; ?> </p>
      <?php endif ?>
    </li>
    <li class="nav-item">
    <?php if (isset($_SESSION['success'])) : ?>

      <a  class="nav-link" href="home.php?logout='1'" style="color: white;">Logout</a>
    <?php endif ?>
    <?php if (!isset($_SESSION['success'])) : ?>

          <a class="nav-link" onclick="window.location.href='login.php'">Login</a>
    <?php endif ?>


    </li>
    <li class="nav-item">

          <?php if (!isset($_SESSION['success'])) : ?>

        <a class="nav-link" onclick="window.location.href='register.php'">Sign up</a>
        <?php endif ?>

    </li>
    </ul>
  </div>
</nav>   
             

<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php">
      
        <div class="row">
          <div class="col-50">
            <h3>Customer Information</h3>
            <label for="fname"><i class="fa fa-user"></i> First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="First Name">

            <label for="fname"><i class="fa fa-user"></i> Last Name</label>
            <input type="text" id="fname" name="lastname" placeholder="Last Name">

            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="Email">

            <label for="adr"><i class="fa fa-address-card-o"></i> Telephone Number</label>
            <input type="text" id="adr" name="address" placeholder="Telephone Number">


       
          </div>

        
        </div>
     
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>4</b></span></h4>
      <p><a href="#">Product 1</a> <span class="price">$15</span></p>
      <p><a href="#">Product 2</a> <span class="price">$5</span></p>
      <p><a href="#">Product 3</a> <span class="price">$8</span></p>
      <p><a href="#">Product 4</a> <span class="price">$2</span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b>$30</b></span></p>
    </div>
  </div>
</div>
     
                    

                         


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>