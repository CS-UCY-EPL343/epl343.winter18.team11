<?php

include('functions.php');

if (!isLoggedIn()) {

}

?>

    <?php 
          function sendemail(){
           
                  global $db;
                 $sql1= "SELECT Email FROM Users WHERE UserID={$_SESSION['user']['UserID']}";
                 $result=mysqli_query($db,$sql1);
                 $row=mysqli_fetch_array($result);
                 $em=$row['Email'];
                 
           
                 $sql= "SELECT * FROM Order_Info WHERE UserID={$_SESSION['user']['UserID']}";
                 $result1 = mysqli_query($db, $sql);
                 echo 'Your order has been succesfully submitted';
                

                 $to = $em;
                 $subject = 'Order Confirmation';
                 $message = 'Thank you for your order.';
                 $from ='georgia_kap@hotmail.com' ;

                
           if(mail($to, $subject, $message, $from)){
             echo 'Check your email.';
      
           
            } else{
             echo 'Unable to send email.';
           }
           
          }  

          
          function get_quantity($id,$quant){
            global $db;
            if(isset($_POST['add'])){
             
              if(isset($_POST['qty'])){
                  $quaty=$_POST['qty'];
                  $ids=$_POST['id'];
                 
                  $array = array_combine($quaty,$ids);
            
                  foreach($array as $q => $i){
                    $queryy="UPDATE Basket_Info SET Quantity = $q WHERE Basket_Info.User_ID={$_SESSION['user']['UserID']} and Product_ID = $i";
                      mysqli_query($db,$queryy);
            
                  }
            
                  $sql="SELECT price FROM Product_web WHERE  Product_ID=$i";
                  $result = mysqli_query($db, $sql);
                  $row = mysqli_fetch_array($result);
        
                   $pr=$row['price'];
              
           
                    $total=$pr*$q;
                    $queryy1="UPDATE Basket_Info SET Total_price = $total WHERE Basket_Info.User_ID={$_SESSION['user']['UserID']} and Product_ID = $i";
                    mysqli_query($db,$queryy1);
                    $URL="basket.php";
                    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
               
           }
          }
      
        }
 
           function del_fun(){
               global $db;
               if(isset($_POST['del'])){
                 $de=$_POST['del'];
                 foreach($de as $d){
                   $quer="DELETE FROM Basket_Info WHERE Basket_Info.User_ID={$_SESSION['user']['UserID']} and Product_ID=$d ";
                   mysqli_query($db, $quer);
                   $URL="basket.php";
                   echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                   echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                 }
               }
           }

            if(isset($_POST['check2'])){
              $phone=$_POST['telephone'];
              $query11="UPDATE Users SET Mobile=$phone WHERE UserID={$_SESSION['user']['UserID']}";
              $result=mysqli_query($db, $query11);

              $date1= date("y-m-d h:i:s");
              $cr=$date1;
              $query9="INSERT INTO Orders (User_ID,created) VALUES ('{$_SESSION['user']['UserID']}','$date1')";
              $result=mysqli_query($db, $query9);
         

              $query10 = "SELECT Order_ID FROM Orders WHERE User_ID={$_SESSION['user']['UserID']} and created='$date1' ";
              $result=mysqli_query($db, $query10);
              $row1=mysqli_fetch_array($result);
              $orderid = $row1['Order_ID'];

              $query6="SELECT * FROM Basket_Info WHERE User_ID={$_SESSION['user']['UserID']}" ;    
              $result=mysqli_query($db, $query6);
              
              while ( $row = mysqli_fetch_array($result)){
                $sql7="INSERT INTO Order_Info (Product_ID,Quantity,Total_Price,UserID,Created,Order_ID) VALUES ('$row[Product_id]','$row[Quantity]','$row[Total_Price]','$row[User_ID]', '$date1', '$orderid'  ) ";
                $result6=mysqli_query($db, $sql7);
                
               
              }

              $quer="DELETE FROM Basket_Info  WHERE Basket_Info.User_ID={$_SESSION['user']['UserID']}";
              $result7=mysqli_query($db, $quer);
               
             successmessage();
             }
            

              function successmessage(){
                   echo '<div class="alert alert-success" id="successmsg" role="alert"> <p> Your order has been succesfully Submitted</p></div>';
                 
              }

   ?>

<!DOCTYPE html>

<html lang="en">
  <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/basket_format.css">


  

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>


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

  <link rel="stylesheet" href="path/to/sweet-alert.css" />

  <script type="text/javascript" src="sweetalert.min.js"></script>
  
  <script src="path/to/sweet-alert.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <style>



.successmessage p{
  width: 300px;
  height: 300px;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}
    
    }
  </style>  
</head>


<body>

<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
      <h1>Shopping Cart</h1>
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
 
                
             
<?php 
      
      $sql="SELECT Basket_Info.Quantity,Basket_Info.Total_price,Product_web.Price,Product_web.Product_Type,Product_web.Product_ID, Product_web.image FROM Basket_Info,Product_web where Basket_Info.User_ID={$_SESSION['user']['UserID']} and Product_web.Product_ID = Basket_Info.Product_id ";
      $result=mysqli_query($db,$sql);
  
?>
 
 <div class="row" style="padding-left:20px" >
              <div class="col"></div>
              <div class="col"></div>
              <div class="col" >Category</div>
              <div class="col">Price</div>
              <div class="col">Quantity</div>
              <div class="col">Total</div>
              <br>
 </div>
 <?php
        $cartcount=0;
        $cartamount=0;
 
        while ($row=mysqli_fetch_row($result)) {
       
          $cartcount += $row[0];
          $linetotal = $row[2]*$row[0];
          $cartamount += $linetotal;
          $id=$row[4];
          $qua=$row[0];
          $pr=$row[2];
         
  

  ?>       
  <div class="row" >
                <div class="col" style="padding-left:100px">
                      <?php
                      echo "<img src=".$row[5]." />";
                      ?>
                </div>
                <div class="col" ">
                  <?php echo $row[3]; ?>                               
                </div>
                <div class="col" >
                      <?php
                          printf("$%.2f", $row[2]);
                        ?>
                </div>

                <form method="post"  >
                    <input type="hidden" name="id[]" value="<?php echo $id ?>" />
                    <input type="number" name="qty[]" size="2" min="1" value="<?php echo $qua?>" />
                    <button type="submit" name="add" >Add</button>
                    <button type="submit" name="del[]" value="<?php echo $id?>" >Remove</button>
              
                </form>

                <div class="col"  >
                      <?php
                        printf("\n$%.2f", $linetotal);
                        printf("\n");
                        ?>
                  
                  </div>

                 
          
    </div>
    <br>

        <?php
          get_quantity($id,$qua);
          del_fun();
         ?>

        <?php    
                  }
          
              ?>
   
   <div class="col" style="padding-left:1450px">  
    <p><b>Subtotal</b></p>
        <?php          
            
                  printf("<b>$%.2f</b>\n", $cartamount);      
        ?>
    </div>
        <form method="post"   >
            <a name="check" data-toggle="modal" data-target="#modalorderinfo" class="checkout" data-backdrop="static" data-keyboard="false">Place your order</a>
        </form>

<?php

?>

  <!-- MODAL LOGIN --> 
 
 
 
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





<div class="modal fade" id="modalorderinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Order Info</h4>
        <button type="button" style="padding-left:30%;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="tel">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fa fa-phone prefix grey-text"></i>
         
          <input type="tel" id="orangeForm-name" name="telephone" class="form-control validate" pattern="[99-96]{2}[0-9]{6}" maxlength="8" placeholder="Telephone Number {Format : 99 000000/ 96 000000}" required>
          
        </div>
      
      <!-- <div class="modal-footer d-flex justify-content-center"> -->
      <form class="form-inline" onsubmit="openModal()" id="myForm">
        <button type="submit" class="btn btn-deep-orange"  name="check2" id="check2"  data-target="#thankyouModal" >Complete Order</button>
        
        
        <!-- <input type="submit" name="check2" id="check2" value="Complete Order">   -->
      </form>
      <!-- </div> -->
    
      </form>
    </div>
  </div>
</div>




    <script>

    </script>
   
  </body>
</html>
