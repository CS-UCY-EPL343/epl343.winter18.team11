<?php
    include('functions.php');

  
?>


<!DOCTYPE html>

<html lang="en">
<head>
  <title>homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="css/home.css">
 
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-reboot.css">
  <link rel="stylesheet" href="css/mdb.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/mdb.lite.css">
  <link rel="stylesheet" href="css/mdb.lite.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 

  
  
</head>
<body>
  
  
<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo">
      <h1 >Emira Pottery</h1>
    </div>

</div>


<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #555555">
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
      <?php if (isset($_SESSION['success'])) : ?>
          <form method="post">
          <a name="w" value="workshop" class="nav-link" href="workshop.php">Workshop</a>
          </form>
      <?php endif ?>
        <?php if (!isset($_SESSION['success'])) : ?>
        <form method="post">
          <a name="w" value="workshop" class="nav-link"  data-toggle="modal" data-target="#modalLoginForm">Workshop</a>
          </form>
      <?php endif ?>

      </li>
      <li class="nav-item">
      <?php if (isset($_SESSION['success'])) : ?>
          
          <a class="nav-link" href="basket.php">Basket</a>
     
      <?php endif ?>
        <?php if (!isset($_SESSION['success'])) : ?>
          <a class="nav-link"  data-toggle="modal" data-target="#modalLoginForm">Basket</a>
          
      <?php endif ?>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" >Contact</a>
      </li>
     
    </ul>
    
    <ul class="navbar-nav  my-2 my-lg-0">

    <li class ="nav-item">
      <?php if (isset($_SESSION['success'])) : ?>
        <p class="nav-link" style="color:white;">   <?php echo "Welcome  " ; echo  $_SESSION['user']['Username']; ?> </p>
      <?php endif ?>
    </li>
    <li class="nav-item">
    <?php if (isset($_SESSION['success'])) : ?>
      <a  class="nav-link" href="home.php?logout='1'" style="color: white;">Logout</a>
    <?php endif ?>
    <?php if (!isset($_SESSION['success'])) : ?>
          
          <a class="nav-link"  data-toggle="modal" data-target="#modalLoginForm">Login</a>
    <?php endif ?>


    </li>
    <li class="nav-item">

          <?php if (!isset($_SESSION['success'])) : ?>

        <a class="nav-link" data-toggle="modal" data-target="#modalRegisterForm">Sign up</a>
        <?php endif ?>

    </li>
    </ul>
  </div>
</nav>



  


  <!-- HOME CONTENT --> 


<div class="container" style="margin-top:30px">
<div class="home-content">
  <h2>About Emira Pottery</h2>
  <div class="row">

    <div class="col-md-4">
      
      <p>The EMIRA routes began in 1969 when the founder, Mr Michael, studied ceramics art in Famagusta.
          In 1975 due to the Turkish invasion in Cyprus, the artist emigrated to Athens where he continued his studies in ceramics art.
        Following this he opened his own pottery workshop there. In 1987 he returned to Cyprus and established Emira Pottery at 13 Mehmet Ali</p>

    </div>
    <div class="col-md-4">
            <p> Str. near St. Lazarus church, as it is today.
                The beauty of ceramics inspired him to expand his horizons and open a showroom with his creations. Our workshop is open
                to the public and visitors will have the opportunity to watch the artists creating, but they will also be challenged to try the magic of clay.
                For the best please book yout appointment in advance.
            </p>
    </div>

    <div class="col-md-4">
            <p>  
                <b>Workshop Working Hours : <br> Monday to Friday: 08:00 - 16:30. <br></b>
                <br> But is open to have a look until 21:00 and Saturday 09:00 - 15:00. 
            </p>  
    </div> 
  </div>
</div>
</div>

  <!-- FOOTER --> 
<footer class="footer">
        <div class="container" >
                <div class="row">
                    <div class="col-md-4"> 
                        <h1 class="footer-products">OUR PRODUCTS</h1>
                        <br>
                        <div class="p1" >
                         <a href="products.php" > Ecclesiastical Items</a>
                         <br>
                         <a href="products.php" > Ancient Pottery Replicas</a>
                         <br>
                         <a href="products.php" > Decorative</a>
                         <br>
                         <a href="products.php" > Cyprus Souvenirs</a>
                         <br>
                         <a href="products.php" > Ovenware Pots</a>
                        </div>           
                    </div>
                    <div class="col-md-4"> 
                    <h1 class="footer-products">CONTACT</h1>
                        <br>
                        <div class="p3" >
                            <p>13 Mehmet Ali Street,<br>
                                6029, Larnaca, <br>
                                Cyprus<br>
                                <br>
                                Mob: +357 99404414 <br>
                                Tel: +357 24623952
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4"> 
                    <h1 class="footer-products">SHOWROOM HOURS</h1>
                        <br>
                        <div class="p2" >
                            <p>
                              <b>April - November</b><br>
                              <br>
                              Monday to Friday: 08:00-21:00 <br>
                              Saturday: 09:00 - 15:00<br>
                              <br>
                              <b>December - March</b><br>
                              <br>
                              Monday to Friday: 08:00-19:00 <br>
                              Saturday: 09:00 - 15:00

                            </p>
                        </div>
                        <br>
                        <h1 class="working-hours">WORKSHOP WORKING HOURS</h1>
                       
                        <br>
                        <div class ="p2">
                            <p>Monday to Friday: 08:00-16:30 
                            </p>
                        </div>
                    </div>
                </div>
        </div>
</div>


  <!-- MODAL LOGIN --> 
  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Login</h4>
        <button style="padding-left:30%;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" >
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fa fa-envelope prefix grey-text"></i>
          <input type="text" id="defaultForm-email" name="username" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="defaultForm-email">Username </label>
        </div>

        <div class="md-form mb-4">
          <i class="fa fa-lock prefix grey-text"></i>
          <input type="password" id="defaultForm-pass" name="password" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" class="btn btn-default" name="login_btn">Login</button>
      </div>
      <p align="center">
			Not yet a member? <a data-dismiss="modal" data-toggle="modal" data-target="#modalRegisterForm">Sign up</a>
		</p>
      </form>
    </div>
  </div>
</div>
<!-- Material form login -->
<!-- MODAL REGISTER --> 

<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
        <button type="button" style="padding-left:30%;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fa fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="name" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="orangeForm-name">Name</label>
        </div>
        <div class="md-form mb-5">
          <i class="fa fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="username" class="form-control validate" required> 
          <label data-error="wrong" data-success="right" for="orangeForm-name">Username</label>
        </div>
        <div class="md-form mb-5">
          <i class="fa fa-envelope prefix grey-text"></i>
          <input type="email" id="orangeForm-email" name="email" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="orangeForm-email">Email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fa fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" name="password_1" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Password</label>
        </div>
        <div class="md-form mb-4">
          <i class="fa fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass1" name="password_2" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Confirm Password</label>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" class="btn btn-deep-orange" name="register_btn">Sign up</button>
      </div>
      <p align="center">
	    	Already a member? <a  data-dismiss="modal" data-toggle="modal" data-target="#modalLoginForm" >Login</a>
	    </p>
      </form>
    </div>
  </div>
</div>


</html>