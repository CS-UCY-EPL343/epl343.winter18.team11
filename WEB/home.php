<?php
    include('functions.php');

  
?>


<!DOCTYPE html>

<html lang="en">
<head>
  <title>homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
 
  
  
  
  
</head>
<body>
  
  
<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo">
      <h1 >Emira Pottery</h1>
    </div>

</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Homepage</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Our Workshop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="basket.php">Basket</a>
      </li> 

    </ul>
  </div>  







  <div class="login-buttons">

    <div class="btn-group">
     <form  method=post  > 


       <!-- LOGIN BUTTON --> 
      <button type="button" onclick="window.location.href='login.php'" name="login_btn" class="btn btn-dark" style.display='block' style="width:auto;">Login</button>
     
       <!-- REGISTER BUTTON --> 
      <button type="button" onclick="window.location.href='register.php'"   class="btn btn-dark"  style="width:auto;">Register</button>
      </form>


      



    </div>
  </div>

</nav>



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


  <div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>

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
                         <a href="products.php" > Traditional</a>
                         <br>
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

</body>
<script src="javascript/register.js"></script>
<script src="javascript/login.js"></script>

</html>