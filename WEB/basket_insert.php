
<?php
include('functions.php');
$link=mysqli_connect("localhost","emirapottery","s94mz5SN3Xu5Hafu","emirapottery");
if($link===false){
    die("error: could not connect" .mysqli_connect_error());
}
$sql="";
    
    $product   = intval($_GET['id']);
    
  
    $sql = "INSERT INTO Basket_Info (Product_ID,User_ID) VALUES ('$product','{$_SESSION['user']['UserID']}') ";
    $result=mysqli_query($link, $sql);

   
?>