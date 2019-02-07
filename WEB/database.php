<?php

$link = mysqli_connect("localhost", "root","","emira_pottery");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 




echo "Connect Successfully ";

if(isset($_POST['add']))
 {

$quant = $_POST['quant'];

$sql = "SELECT * FROM product WHERE Product_ID=1 ";


$sql1 = "UPDATE basket SET quantity=$quant WHERE Product_ID=1 ";
               
        
if (!mysqli_query($link, $sql1))

  {

  die('Error: ' );

  }

echo "1 record added";

 
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
      $pr = $row['price'];
        echo  $pr;  
         
    }
  }
}
 
 echo ' Quantity ' . $quant;

 $total = $quant * $pr;

 $sql2 = "UPDATE basket SET total_price=$total WHERE Product_ID=1 ";
 if (!mysqli_query($link, $sql2))

 {

 die('Error: ' );

 }

echo "1 record added";
echo ' Total ' .$total;
 }


$link->close();
?>