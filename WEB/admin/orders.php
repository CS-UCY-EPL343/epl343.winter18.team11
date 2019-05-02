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
                         <?php  
 $connect = mysqli_connect("localhost", "emirapottery","s94mz5SN3Xu5Hafu","emirapottery"); 
 $query="SELECT u.Name, oi.Product_Name, oi.Quantity, oi.Created, oi.Total_Price, oi.Product_ID FROM  Order_Info oi, Users u WHERE   oi.UserID=u.UserID "; 
 $result = mysqli_query($connect, $query);  
 ?> 

<!DOCTYPE html>
<html>
<head>

       <title>workshop_details</title>
        
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel = "stylesheet" type = "text/css" href = "../admin/add_format.css" />
  <link rel="stylesheet" type="text/css" href="../css/basket_format.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<style>
 table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
      
      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }
      
      tr:nth-child(even) {
        background-color: #dddddd;
      }
      
</style>
</head>
<body>



<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
     
	  <h1> Admin - Orders</h1>
    </div>

</div>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #555555">
  <a class="navbar-brand" href="/admin/home.php">Admin Home</a>
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
    <br> 

    <div class="container" style="width:700px;">  
          
          <div class="table-responsive">  
          
               
               <div id="employee_table">  
                    <table border="1" cellspacing="0" cellpadding="2">  
                         <tr>  
                              <th>Name</th>  
                              <th>Product id</th>  
                              <th>Quantity</th>  
                              <th>Created</th> 
                              
                         </tr>  
 
                         <?php  
                         while($row = mysqli_fetch_array($result))  
                         {  
                         ?>  
                         
                         <tr >  
                              <td><?php echo $row["Name"]; ?></td>  
                              <td><?php echo $row["Product_ID"]; ?></td>  
                              <td><?php echo $row["Quantity"]; ?></td>  
                              <td><?php echo $row["Created"]; ?></td>  

                         </tr>  
                         <?php  
                         }  
                         ?>  
                    </table>  
               </div>  
          </div>  
     </div> 

     


<br>

<?php
see();
?>

</body>
</html>