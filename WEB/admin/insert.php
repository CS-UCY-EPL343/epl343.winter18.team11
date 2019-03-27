<?php  
 $connect = mysqli_connect("localhost", "root","","emira_pottery");  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $date = mysqli_real_escape_string($connect, $_POST["date"]);  
      $time = mysqli_real_escape_string($connect, $_POST["time"]);  
      $name = mysqli_real_escape_string($connect, $_POST["name"]);  
      
 
    
      if($_POST["employee_id"] != '')  
      {  
     
       

          echo "UPDATEEEE";
           $query = "  
           UPDATE meeting   
           SET Date='$date',   
           Time='$time';
         
           
           WHERE MeetingID='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
     
   
   $sql= "SELECT * FROM users WHERE username='$name'";
   $result=mysqli_query($connect,$sql);
   $row=mysqli_fetch_array($result);
   $usid=$row['id'];

           $query = "  
           INSERT INTO meeting(Date, Time, UserID)  
           VALUES('$date', '$time',$usid);  
           ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
        
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query="SELECT username,Date,Time, MeetingID, UserID FROM meeting m, users u WHERE m.UserID=u.id";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
                <table border="1" cellspacing="0" cellpadding="2">  
                     <tr>  
                          <th >username</th>  
                          <th >Date</th>  
                          <th >Time</th> 
                          <th ></th>  
                          <th ></th> 
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                       
                          <td>' . $row["username"] . '</td>  
                          <td>' . $row["Date"] . '</td>  
                          <td>' . $row["Time"] . '</td>  
                          <td><input type="button" name="view" value="Confirm" id="'.$row["MeetingID"] .'" class="btn btn-info btn-xs view_data" /></td>  
                          <td><input type="button" name="delete_data" value="Delete" id="' . $row["MeetingID"] . '" class="btn btn-info btn-xs delete_data" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>
 
