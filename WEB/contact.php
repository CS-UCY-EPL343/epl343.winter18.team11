
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head  >
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
  
    <title>Page Title</title> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <style>
  
  

.error {color: red;}


  .jumbotron {
    background-image: url("emira-pottery.jpg");
    height: 300px;
    
  }

.clearfix {
  overflow: auto;
}
 
 
  </style>   
          
       



</head>
<body>
    <div class="jumbotron " style="margin-bottom: 0" >        
      
      <h1 style="color:white;text-align: center;font-family: 'Times New Roman', Times, serif">CONTACT</h1>
      <h1 style="font-size: 100px;
      font-family: serif;
      font-style: italic;
      text-align: left;
      color:white;
      padding-bottom: 50%;
      ">Emira Pottery</h1>

    </div>
    
     
      <nav class="navbar navbar-inverse">
        <div class="container-fluid"></div>
          <ul class="nav navbar-nav">
            
            <li><a href="#">HOMEPAGE</a></li>
            <li><a href="#">PRODUCTS</a></li>
            <li><a href="#">OUR WORKSHOP</a></li>
            <li><a href="#">CONTACT</a></li>
          </ul>
      </nav>
       



     <div class="second" style=" margin-top: 100px;
     margin-bottom: 100px;
     margin-right: 150px;
     margin-left: 80px;" >   
       
         <div id="info"style="width: 400px; float:right; height:100px; margin:10px">

          <h1 style="color:black; font-family:'Times New Roman', Times, serif;font-size:175%;"><b>Michalis Michael</b></h1> 
          
        <p style="font-size: 135%;font-family: 'Times New Roman', Times, serif"> 
          
          13 Mehmet Ali Street,<br>
          6026, Larnaca,<br>
          Cyprus<br>
          <br>
          Mob: +357 99404414<br>
          Tel: +357 24623952<br>
          <br>
          <br>
          <br>
        </p>

         <h1 style="color:black; font-family:'Times New Roman', Times, serif;font-size:175%;"><b>Opening Hours</b></h1> 
         
         <p style="font-size: 135%;font-family: 'Times New Roman', Times, serif"> 

            
                  April – November

          Monday to Friday: 08:00 – 21:00<br>
          Saturday: 09-00 – 15:00<br>
          <br>
          December – March<br>
          <br>
          Monday to Friday: 08:00 – 19:00<br>
          Saturday: 09-00 – 15:00<br>
                
                
          
     </p>
     </div>

     <div id="theform"style="width: 150px; float:left; height:100px; margin:20px">
      

     
      <?php


// define variables and set to empty values
$nameErr = $emailErr =  "";
$name = $email =  $comment =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
 
  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
    
  }
 
  mail("elena.kap205@hotmail.com",$name,$comment, $email);

  }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name:(required) <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"> <?php echo $nameErr;?></span>
  <br><br>
  E-mail:(required) <input type="text" name="email" value="<?php echo $email;?>">
 <span class="error"> <?php echo $emailErr;?></span> 
  <br><br>
   Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
 
  
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


        
  
      
      </div>
      </div>
    


      <div class="clearfix"></div>

        

      <div class="jumbotron text-center" style="margin-bottom:0px;position:absolute;top:1200px;width:100%;height:350px;background-image: none;background-color: beige;">
        <footer class="footer">
        <div class="container" >
          <div class="row">
              <div class="col-md-4"> 
                  <h1 class="footer-products"style="font-size:25px">OUR PRODUCTS</h1>
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
              <h1 class="footer-products"style="font-size:25px">CONTACT</h1>
                  <br>
                  <div class="p3" >
                      <p style="font-size:15px">13 Mehmet Ali Street,<br>
                          6029, Larnaca, <br>
                          Cyprus<br>
                          <br>
                          Mob: +357 99404414 <br>
                          Tel: +357 24623952
                      </p>
                  </div>
              </div>






              <div class="col-md-4"> 
              <h1 class="footer-products"style="font-size:25px">SHOWROOM HOURS</h1>
                 
                  <div class="p2" >
                      <p style="font-size:15px">
                        <b>April - November</b><br>
                        
                        Monday to Friday: 08:00-21:00 <br>
                        Saturday: 09:00 - 15:00<br>
                        
                        <b>December - March</b><br>
                        
                        Monday to Friday: 08:00-19:00 <br>
                        Saturday: 09:00 - 15:00

                      </p>
                  </div>
                
                  <h1 class="working-hours"style="font-size:15px"><b>WORKSHOP WORKING HOURS</b></h1>

                  <div class ="p2">
                      <p style="font-size:15px">Monday to Friday: 08:00-16:30 
                      </p>
                  </div>
              </div>
          </div>
  </div>
</div>




</body>
</html>