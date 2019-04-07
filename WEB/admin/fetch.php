<?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "emirapottery","s94mz5SN3Xu5Hafu","emirapottery");
  if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT * FROM Meeting WHERE MeetingID = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result); 
     
      echo json_encode($row);  
       
      
 }  
 ?>