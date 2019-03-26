<?php  
 if(isset($_POST["employee_id"]))  
 {  
     
      $output = '';  
      $link = mysqli_connect("localhost", "root","","emira_pottery");
            
      $sql= "SELECT * FROM meeting WHERE MeetingID='".$_POST["employee_id"]."'";
      $result=mysqli_query($link,$sql);
      $row=mysqli_fetch_array($result);
      $date=$row['Date'];	
      $uid=$row['UserID'];
     
      
      $sql1= "SELECT email FROM users WHERE id=$uid";
      $result=mysqli_query($link,$sql1);
      $row=mysqli_fetch_array($result);
      $em=$row['email'];
     
      $to = $em;
      $subject = 'Emira Pottery-Workshop CConfirmation';
      $message = 'Thank you for booking your place at out workshop! We are looking forward to seeing you!';
      $from ='georgia_kap@hotmail.com' ;
    
     
if(mail($to, $subject, $message, $from)){
  echo 'Your mail has been sent successfully.';
} else{
  echo 'Unable to send email. Please try again.';
  echo $em;
}
 }  
 ?>