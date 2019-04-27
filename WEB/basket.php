<?php

include('functions.php');

if (!isLoggedIn()) {

}

?>
    <?php 
          function sendemail(){
           
            
                
                 
                 
                       
          
                 
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
 
              $query6="SELECT * FROM Basket_Info WHERE User_ID={$_SESSION['user']['UserID']}" ;    
              $result=mysqli_query($db, $query6);
              
              $date1= date("d-m-y h:i:sa");
              
              while ( $row = mysqli_fetch_array($result)){
                $sql7="INSERT INTO Order_Info (Product_ID,Quantity,Total_Price,UserID,Created) VALUES ('$row[Product_id]','$row[Quantity]','$row[Total_Price]','$row[User_ID]', '$date1' ) ";
                $result6=mysqli_query($db, $sql7);
                
               
              }

              $quer="DELETE FROM Basket_Info  WHERE Basket_Info.User_ID={$_SESSION['user']['UserID']}";
              $result7=mysqli_query($db, $quer);
               
              sendemail();

              session_destroy();
              header("location: home.php");

             }
            

   ?>

<!DOCTYPE html>

<html lang="en">
  <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/basket_format.css">


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
        <p class="nav-link" style="color:white;">   <?php  echo  $_SESSION['user']['Username']; ?> </p>
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
 
 <div class="row" style="padding-left:145px" >
              <div class="col"></div>
              <div class="col"></div>
              <div class="col" style="padding-right:85px">Category</div>
              <div class="col">Price</div>
              <div class="col"></div>
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
                <div class="col">
                      <?php
                      echo "<img src=".$row[5]." />";
                      ?>
                </div>
                <div class="col" style="padding-right:150px">
                  <?php echo $row[3]; ?>                               
                </div>
                <div class="col"  style="padding-right:250px">
                      <?php
                          printf("$%.2f", $row[2]);
                        ?>
                </div>

                <form method="post" >
                    <input type="hidden" name="id[]" value="<?php echo $id ?>" />
                    <input type="text" name="qty[]" size="2" value="<?php echo $qua?>" />
                    <button type="submit" name="add" >Add</button>
                    <button type="submit" name="del[]" value="<?php echo $id?>" >Remove</button>
              
                </form>

                <div class="col" style="padding-right:110px" >
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
   
    <div class="col" style="padding-left:1200px">  
        <?php          
                
                  printf("<b>$%.2f</b>\n", $cartamount);      
        ?>
        <form method="post"   >
            <a name="check" data-toggle="modal" data-target="#modalorderinfo" class="checkout" >Place your order</a>
        </form>
     

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
      <form method="POST">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fa fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="name" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="orangeForm-name">Full Name</label>
        </div>
        <div class="md-form mb-5">
          <i class="fa fa-phone prefix grey-text"></i>
          <input type="text" id="orangeForm-name" name="telephone" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="orangeForm-name">Telephone Number</label>
        </div>
      
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" class="btn btn-deep-orange" name="check2" id="check2" >Complete Order</button>
      </div>
    
      </form>
    </div>
  </div>
</div>

   

  <div class="modal fade" id="thankyouModal" tabindex="-1" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Your order has been succesfully submitted!</h4>
            </div>
            <div class="modal-body">
                                   
            </div>    
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