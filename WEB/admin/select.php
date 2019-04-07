<?php  
 if(isset($_POST["employee_id"]))  
 {  
     
      $output = '';  
      $link = mysqli_connect("localhost", "emirapottery","s94mz5SN3Xu5Hafu","emirapottery");
            
      $sql= "SELECT * FROM Meeting WHERE MeetingID='".$_POST["employee_id"]."'";
      $result=mysqli_query($link,$sql);
      $row=mysqli_fetch_array($result);
      $date=$row['Date'];	
      $uid=$row['UserID'];
     
      
      $sql1= "SELECT Email FROM Users WHERE UserID=$uid";
      $result=mysqli_query($link,$sql1);
      $row=mysqli_fetch_array($result);
      $em=$row['Email'];
      
    
      $to = $em;
      $subject = 'Emira Pottery-Workshop Confirmation';
      $message = 'Thank you for booking your place at out workshop! We are looking forward to see you!';
      $from ='georgia_kap@hotmail.com' ;
    
     
if(mail($to, $subject, $message, $from)){
  echo 'Your mail has been sent successfully.';
} else{
  echo 'Unable to send email. Please try again.';
}
 }  
 ?>