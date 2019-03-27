<?php  
  
 $connect = mysqli_connect("localhost", "root","","emira_pottery"); 

$sql= "DELETE FROM meeting WHERE MeetingID='".$_POST["employee_id"]."'";
$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_array($result)

 ?>