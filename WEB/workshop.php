<?php

    include('functions.php');
    if (!isLoggedIn()) {

     
    }
    
    
?>


<!DOCTYPE html>

<html lang="en">
<head>
  <title>homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/workshop-format.css">
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
			<?php
  


  function send_email(){
    
    $datee=$_POST['date'];
    $timee=$_POST['time'];
  
    $sql= "SELECT Email FROM Users WHERE UserID='{$_SESSION['user']['UserID']}'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_array($result);
    $em=$row['Email'];
   
    $sql= "SELECT Username FROM Users WHERE UserID='{$_SESSION['user']['UserID']}'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_array($result);
    $name=$row['Username'];
    $to = 'georgia_kap@hotmail.com';
    $subject = 'Emira Pottery-Workshop';
    $message = 'User '.$name.' would like to to book a lesson on: '.$datee. ' at '. $timee;
    $from = $em;
  
  
  
 
  
     
    
    if(mail($to, $subject, $message, $from)){
        echo 'Your mail has been sent successfully.';
    } else{
        echo 'Unable to send email. Please try again.';
    }
  
  }




			function myFunction(){
    
          global $db;
					if(isset($_POST['submit'])){
					$date=$_POST['date'];
					$time=$_POST['time'];
					
					
					$sql = "INSERT INTO Meeting ( Date, Time, UserID) VALUES ('$date','$time' , '{$_SESSION['user']['UserID']}')";
					
					//mysqli_query($conn, $sql)
				if (mysqli_query($db, $sql) === TRUE) 
				{
					echo "";
				} else 
				{
					echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
        $URL="workshop.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        
						//	mysqli_close($con);
			}
    
		}
			?>

					
          <div class = "products_gallery">
					<div class="jumbotron" style="margin-bottom:0" >
    					<div class="logo-productsgallery">
      						<h1 >Our Workshop</h1>
    					</div>
          </div>
					</div>



<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #555555">
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

				  
			
					 <p class="workshop-content" > 

									Our workshop and showroom are located at 13 Mehmet Ali Street near the St. Lazarus church in Lanraka. Our workshop is open to the public and visitors will have the opportunity to watch the artists creating and also to try the magic of clay.
									For the best please book your appointment in advance. </p>
              <br/>
              

               <div class="row">

                  <div class="col-md-6">

                        <p class="details">Workshop Working Hours:</p> 
                        
                        <p class="date">Monday to Friday: 08:00 – 16:30.</p>
                        

                        <p class="date">But is open to have a look until 21:00 and Saturday 09:00 – 15:00.</p><br/>

                        <div class="second" style="margin:20px 20px; padding-left: 200px;" >   

		
                          <h4>Please choose the time and date for your lesson:</h4>
                          <div id="theform">

                          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" required> 

                          Date:<br><input class="min-today" data-date-split-input="true" type="date" min="2019-02-20" name="date" id="min" /><br/>
                          <br/><br/>
                                      
                          Time:<br><input type="time" name="time"  min="08:00" max="16:30" value = "08:00" required/><br/>
                          <br/><br/>
                          <input type="submit" name="submit" value="Submit"/>  
                            
                          </div>
                          </div>
                          <?php
                            if (!isLoggedIn()) {
                              header('location: ../login.php');
                            }else{
                          myFunction();
                            }
                          ?>


                            <div class="clearfix"></div>

                          </form>
                </div>
                <div class="col-md-6">
                    <div class="image">
                      
                      <img src="workshop.jpg" alt="Trulli" width="375" height="450">
                      
                      </div>
            </div>
            </div>
					
          <?php 
          if(isset($_POST['submit'])){
                send_email();
            }  
            
          ?>		

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
                            <a href="https://www.facebook.com/EMIRA-Pottery-559970017462447/"><i class="fa fa-facebook-square prefix black-text" style="font-size:30px; padding-right:35px"></i> </a>
                            <a href="https://www.tripadvisor.com/Attraction_Review-g190379-d6979787-Reviews-Emira_Pottery-Larnaca_Larnaka_District.html" > <i class="fa fa-tripadvisor prefix black-text" style="font-size:30px"></i>  </a>

                             
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
          <input type="text" id="defaultForm-email" name="username" class="form-control validate" placeholder="Username" required >
   
        </div>

        <div class="md-form mb-4">
          <i class="fa fa-lock prefix grey-text"></i>
          <input type="password" id="defaultForm-pass" name="password" class="form-control validate" placeholder="Password" required>

         
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
          
          <input type="text" id="orangeForm-name" name="name" class="form-control validate" placeholder="Name" required>
          
        </div>
        <div class="md-form mb-5">
          <i class="fa fa-user prefix grey-text"></i>
          
          <input type="text" id="orangeForm-name" name="username" class="form-control validate" placeholder="Username" required> 
          
        </div>
        <div class="md-form mb-5">
          <i class="fa fa-envelope prefix grey-text"></i>
          
          <input type="email" id="orangeForm-email" name="email" class="form-control validate" placeholder="Email" required>
         
        </div>

        <div class="md-form mb-4">
          <i class="fa fa-lock prefix grey-text"></i>
         
          <input type="password" id="orangeForm-pass" name="password_1" class="form-control validate" placeholder="Password" required>
         
        </div>
        <div class="md-form mb-4">
          <i class="fa fa-lock prefix grey-text"></i>
          
          <input type="password" id="orangeForm-pass1" name="password_2" class="form-control validate" placeholder="Confirm Password" required>
         
        </div>
        <div class="captcha">
                 <div class="g-recaptcha" data-sitekey="6Le2DKMUAAAAAP-55NzGUmg7hRvae2F0gVKHSjno" data-callback="enableBtn"></div>
               </div>
      <div class="tos py-3">
               <input type="checkbox" name ="tos" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">I have read and agree to the <a id="tos-terms" class="tos-terms" data-toggle="modal" data-target="#tosModal">Terms and Conditions </a> of our website.</label>
               </div>
      </div>
      
      <div class="modal-footer d-flex justify-content-center">

               
        <button type="submit" class="btn btn-deep-orange" name="register_btn" id="register_btn" value="Sign up">Sign up</button>
      </div>
      <p align="center">
	    	Already a member? <a  data-dismiss="modal" data-toggle="modal" data-target="#modalLoginForm" >Login</a>
	    </p>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="tosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Emira Pottery Privacy Policy</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body tos-style">
      
          <p>This privacy policy will explain how our organization uses the personal data we collect from you when you use our website.</p>


          <h5>1. What data do we collect?</h5>
          <p>Emira Pottery collects the following data:</p>
<ul><li>Personal identification information (Name, home address, email address, phone number)</li></ul>

<h5>2. How do we collect your data?</h5>
<p>You directly provide Emira Pottery with most of the data we collect. We collect data and process data when you:</p>
<ul>
    <li>Register online or place an order for any of our products or services.</li>
    <li>Use or view our website via your browser’s cookies.</li>
          </ul>



<h5>3. How will we use your data?</h5>
<p>Emira Pottery collects your data so that we can:</p>
<ul><li>Process your order and manage your account.</li></ul>


<h5>4. How do we store your data?</h5>
<p>Emira Pottert securely stores your data at xyz server which ensures security and confidentiality.</p>
<p>Emira Pottery will keep the data you used to register until you decide to stop. Once this time period has expired, we will delete your data from our database.</p>


<h5>5. What are your data protection rights?</h5>
<p>Emira Pottery would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
<ul>
    <li>The right to access – You have the right to request Emira Pottery for copies of your personal data. We may charge you a small fee for this service.</li>
    <li>The right to rectification – You have the right to request that Emira Potterycorrect any information you believe is inaccurate. You also have the right to request Emira Pottery to complete the information you believe is incomplete.</li>
    <li>The right to erasure – You have the right to request that Emira Pottery erase your personal data, under certain conditions.</li>
    <li>The right to restrict processing – You have the right to request that Emira Pottery restrict the processing of your personal data, under certain conditions.</li>
    <li>The right to object to processing – You have the right to object to Emira Pottery's processing of your personal data, under certain conditions.</li>
    <li>The right to data portability – You have the right to request that Emira Pottery transfer the data that we have collected to another organization, or directly to you, under certain conditions.</li>
</ul>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us at mspetsioti81@hotmail.com or by phone at: 24726444, 99481883</p>


<h5>6. Cookies</h5>
<p>Cookies are text files placed on your computer to collect standard Internet log information and visitor behavior information. When you visit our websites, we may collect information from you automatically through cookies or similar technology
For further information, visit allaboutcookies.org.</p>


<h5>7. How do we use cookies?</h5>
<p>Emira Pottery uses cookies in a range of ways to improve your experience on our website, including:</p>
<ul>
    <li>Keeping you signed in</li>
    <li>Understanding how you use our website</li>
          </ul>


<h5>8. What types of cookies do we use?</h5>
<p>There are a number of different types of cookies, however, our website uses:</p>
<ul>
    <li>Functionality – Emira Pottery uses these cookies so that we recognize you on our website and remember your previously selected preferences. These could include what language you prefer and location you are in. A mix of first-party and third-party cookies are used.</li>
          </ul>


<h5>9. How to manage cookies</h5>
<p>You can set your browser not to accept cookies, and the above website tells you how to remove cookies from your browser. However, in a few cases, some of our website features may not function as a result.</p>
<h5>10. Privacy policies of other websites</h5>
<p>The Emira Pottery website contains links to other websites. Our privacy policy applies only to our website, so if you click on a link to another website, you should read their privacy policy.</p>


<h5>11. Changes to our privacy policy</h5>
<p>Emira Pottery keeps its privacy policy under regular review and places any updates on this web page. This privacy policy was last updated on 18 March 2019.</p>

<h5>12. How to contact us</h5>
<p>If you have any questions about Emira Pottery’s privacy policy, the data we hold on you, or you would like to exercise one of your data protection rights, please do not hesitate to contact us.</p>
<p>Call us: +357 99404414 , +357 24623952 </p>
<p>Address: 13 Mehmet Ali Street,
6029, Larnaca, Cyprus</p>
      </div>
     
    </div>
  </div>
</div>
      
      </div>
  </div>
</div>

 	
</body>
<script>
$(function(){
    $('[type="date"].min-today').prop('min', function(){
        return new Date().toJSON().split('T')[0];
    });
});
</script>