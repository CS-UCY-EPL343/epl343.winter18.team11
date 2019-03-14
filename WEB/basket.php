<?php

include('functions.php');

if (!isLoggedIn()) {
	header('location: ../login.php');
}

?>

<!DOCTYPE html>

<html lang="en">
  <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/basket_format.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <?php 
          
           function get_quantity($id,$quant){
             
            $link = mysqli_connect("localhost", "root","","emira_pottery");
          
           
            if(isset($_POST['add'])){
             
              if(isset($_POST['qty'])){
                  $quaty=$_POST['qty'];
                  $ids=$_POST['id'];
                 
                  $array = array_combine($quaty,$ids);
            
                  foreach($array as $q => $i){
                    $queryy="UPDATE Basket SET Quantity = $q WHERE Product_ID = $i";
                      mysqli_query($link,$queryy);
            
                  }
            
                  $sql="SELECT price FROM Product WHERE Product_ID=$i";
                  $result = mysqli_query($link, $sql);
                  $row = mysqli_fetch_array($result);
        
                   $pr=$row['price'];
              
           
                    $total=$pr*$q;
                    $queryy1="UPDATE Basket SET Total_price = $total WHERE Product_ID = $i";
                    mysqli_query($link,$queryy1);
                    header('location: basket.php');	
               
           }
          }
        }
           
function del_fun(){
  $link = mysqli_connect("localhost", "root","","emira_pottery");
    if(isset($_POST['del'])){
      $de=$_POST['del'];
      foreach($de as $d){
        $quer="DELETE FROM Basket WHERE Product_ID=$d";
        mysqli_query($link, $quer);
        header('location: basket.php');	
      }
    }
}
         
    ?>


  </head>
  <body>
  
  <div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
      <h1>Shopping Cart</h1>
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
             
                    
                    

                          <?php 
$link = mysqli_connect("localhost", "root","","emira_pottery");
$sql="SELECT Basket.Quantity,Basket.Total_price,Product.Price,Product.Product_Type,Product.Product_ID, Product.image FROM Basket,Product where Product.Product_ID = Basket.Product_id";
$result=mysqli_query($link,$sql);
  
  ?>
 
 <div class="row" style="padding-left:145px" >
              <div class="col"></div>
              <div class="col"></div>
              <div class="col" style="padding-right:85px">Category</div>
              <div class="col">Price</div>
              <div class="col"></div>
              <div class="col">Quantity</div>
             
              <div class="col">Total</div>
              <br></br>
          </div>
        <?php
       
        $cartcount=0;
        $cartamount=0;
        while ($row=mysqli_fetch_row($result)) {
       
          $cartcount += $row[0];
          $linetotal = $row[2]*$row[0];
          $cartamount += $linetotal;
         
         
         // echo "\n\t<td>" . "<input type=\"text\" size=3 name=\"" . $row[4] ."\" value = \"" . $row[0] . "\"></td>\n";
         
          $id=$row[4];
          $qua=$row[0];
          $pr=$row[2];
          ?>
          <div class="row" >
          <div class="col">
          <?php
          echo "<img src=images/".$row[5]." />";
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
        

          <form method="post"   >
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
          <br></br>
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

</div>
</div>
      
      <button class="checkout">Checkout</button>

</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>