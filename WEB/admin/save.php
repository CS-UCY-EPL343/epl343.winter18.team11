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
<!DOCTYPE html>
<html>
<head>
<title>workshop_details</title>
       <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-reboot.css">
  <link rel="stylesheet" href="css/mdb.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/mdb.lite.css">
  <link rel="stylesheet" href="css/mdb.lite.min.css">
        
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel = "stylesheet" type = "text/css" href = "../admin/add_format.css" />
  <link rel="stylesheet" type="text/css" href="../css/basket_format.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

$(document).ready(function(){
	$(document).on('click','.button1',function(){
var mid= $(this).attr("id");
  $('.ok1').click(function(){
   // alert("The paragraph was clicked.");
   
 
   if (($("#datee").val() != "") && ($("#timee").val() != "")){
	// $.ajax({  
    //             url:"insert.php",  
    //             method:"POST",  
    //             data:{employee_id:employee_id},  
    //             dataType:"json",  
    //             success:function(data){  
    //                  $('#datee').val(data.datee);  
    //                  $('#timee').val(data.timee);  
                 
    //                  $('#add_data_Modal').modal('show');  
    //             }  
    //        });
    alert(mid);
   }
   else{
	   alert("Both are required");
   }
  });
  });
});
</script>
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
<?php

function click($name,$id,$meet){
  $link = mysqli_connect("localhost", "root","","emira_pottery");
        
         
  if(isset($_POST['conf'])){
      $de=$_POST['conf'];
     
      foreach($de as $d){
        $sql= "SELECT * FROM meeting WHERE MeetingID=$d";
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
    }
    else {

	}
}
function see(){
 
try {
    // Connect and create the PDO object
    $link = mysqli_connect("localhost", "root","","emira_pottery");
    $sql="SELECT username,Date,Time, MeetingID, UserID FROM meeting m, users u WHERE m.UserID=u.id";
    $result = $link->query($sql);
  
    // If the SQL query is succesfully performed ($result not false)
    if($result !== false) {
      // Create the beginning of HTML table, and the first row with colums title
      $html_table = '<table border="1" cellspacing="0" cellpadding="2"><tr><th>Username</th><th>Date</th><th>Time</th><th></th><th></th></tr>';
  
      // Parse the result set, and adds each row and colums in HTML table
      foreach($result as $row) {
        // $html_table .= '<tr><td>' .$row['username']. '</td><td>' .$row['Date']. '</td><td>' .$row['Time']. '</td><td> <form method="post"   ><button type="submit"  name="conf[]" value="'. $row['MeetingID'].'" >confirm</button></td><td><button type="submit" class="btn btn-default" data-dismiss="modal" name="upt[]" value="'. $row['MeetingID'].'" >update</button></form></td></tr>';
        $html_table .= '<tr><td>' .$row['username']. '</td><td>' .$row['Date']. '</td><td>' .$row['Time']. '</td><td> <form method="post"   ><button type="submit"  name="conf[]" value="'. $row['MeetingID'].'" >confirm</button></td><td><div class="text-center">
		<button type="button" id="'. $row['MeetingID'].'" class="button1" data-toggle="modal" data-target="#modalLoginForm">update</button>
	  </div></form></td></tr>';
        $m=$row['MeetingID'];
        click($row['username'],$row['UserID'],$m);
        //  sub($m);
      }
    }
  
    $conn = null;        // Disconnect
  
    $html_table .= '</table>';           // ends the HTML table
  
    echo $html_table;        // display the HTML table
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
}
?>



<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
     
	  <h1> Meeting Agenda</h1>
    </div>

</div>

 	<nav style="width:100%"  class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="home.php">Home</a>
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
        <p class="nav-link" style="color:white;">   <?php echo  $_SESSION['user']['username']; ?> </p>
    </li>
    <li class="nav-item">
	<a class="nav-link" href="../home.php?logout='1'" >Logout</a>
    </li>
   
    </ul>
  </div>
</nav>




    <br>      
<div class="info">
<h4> Meeting Information </h4>
</div>
<br>
<?php
see();

?>


<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Choose new date and new time</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="post" id="insert_form">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="defaultForm-email">New Date</label>
		  <input type="date" id="datee" name="datee" class="form-control validate">
          
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
		  <label data-error="wrong" data-success="right" for="defaultForm-pass">New Time</label>
		  <input type="time" id="timee" name="timee" class="form-control validate">
          
        </div>

		</form>

      </div>
      <input type="hidden" name="meeting_id" id="meeting_id" />
      <div class="modal-footer d-flex justify-content-center">
	  <button class="ok1">Submit</button>
	  <button class="ok">Clear</button>
      </div>
    </div>
  </div>
</div>



</body>
</html>
