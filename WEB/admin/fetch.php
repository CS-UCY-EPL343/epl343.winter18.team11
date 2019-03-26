<?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root","","emira_pottery");
  if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT * FROM meeting WHERE MeetingID = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result); 
     
      echo json_encode($row);  
       
      
 }  
 ?>