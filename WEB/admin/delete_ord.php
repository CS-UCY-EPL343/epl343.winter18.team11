<?php  
  
 $connect = mysqli_connect("localhost", "emirapottery","s94mz5SN3Xu5Hafu","emirapottery"); 

$sql= "DELETE FROM Order_Info WHERE Order_ID='".$_POST["ord"]."'";
$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_array($result)

 ?>