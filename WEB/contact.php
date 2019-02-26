


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head  >
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
  
    <title>Page Title</title> 

    <link rel="stylesheet" type="text/css" href="css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">



  <style>
  
  
.error {color: red;}
  


  </style>   
             

</head>
<body>
    <div class="jumbotron " style="margin-bottom: 0" >        
    <div class="logo-productsgallery1">
      <h1>Contact Us</h1>
    </div>
    </div>
    
     
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="home.php">Homepage</a>
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

</nav>



<div class="form1" >
<form  method="post" action="contact.php">  
  Name:(required) 
  <input type="text" name="name">
 
  <br><br>
  E-mail:(required) 
  <input type="text" name="email" >

  <br><br>
   Comment: 
   <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
 
  
  <br><br>
  <input type="submit"  value="Submit">  
  <input type="hidden" name="button_pressed" value="1" />

  
</form>


<?php 

if(isset($_POST['button_pressed'])){
      send_email();
  }  
  
?>


</div>
        
  
      <div class="clearfix"></div>

        

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
</html>



<?php
function send_email(){





  $to = 'georgia_kap@hotmail.com';
  $subject = 'Emira Pottery';
  $message = 'hello';
  $from = $_POST['email'];





   
  
  if(mail($to, $subject, $message)){
      echo 'Your mail has been sent successfully.';
  } else{
      echo 'Unable to send email. Please try again.';
  }

}

?>