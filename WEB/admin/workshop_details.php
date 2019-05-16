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
 <?php  
 $connect = mysqli_connect("localhost", "emirapottery","s94mz5SN3Xu5Hafu","emirapottery"); 
 $query="SELECT u.Username,m.Date,m.Time, m.MeetingID, m.UserID, u.Name FROM Meeting m, Users u WHERE m.UserID=u.UserID"; 
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>workshop_details</title>  
           <meta name="viewport" content="width=device-width, initial-scale=1">
           
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel = "stylesheet" type = "text/css" href = "../admin/add_format.css" />
  <link rel="stylesheet" type="text/css" href="../css/basket_format.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
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
      <div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
     
	  <h1> Meeting Agenda</h1>
    </div>

</div>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #555555">
  <a class="navbar-brand" href="home.php">Admin Home</a>
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
        <p class="nav-link" style="color:white;">   <?php echo "Welcome  " ; echo  $_SESSION['user']['Username']; ?> </p>
    </li>
    <li class="nav-item">
	<a class="nav-link" href="../home.php?logout='1'" >Logout</a>
    </li>
   
    </ul>
  </div>
</nav>
<br>      

          
           <div class="container" style="width:700px;">  
          
                <div class="table-responsive">  
                     <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add</button>  
                     </div>  
                     <br />  
                     <div id="employee_table">  
                          <table border="1" cellspacing="0" cellpadding="2">  
                               <tr>  
                                    <th>Name</th>  
                                    <th>Date</th>  
                                    <th>Time</th>  
                                    <th></th> 
                                    <th></th> 
                               </tr>  
                               <?php  
                               while($row = mysqli_fetch_array($result))  
                               {  
                               ?>  
                               
                               <tr id="delete<?php echo $row['MeetingID']?>" >  
                                    <td><?php echo $row["Name"]; ?></td>  
                                    <td><?php echo $row["Date"]; ?></td>  
                                    <td><?php echo $row["Time"]; ?></td>  
                                    <td><input type="button" name="view" value="Confirm" id="<?php echo $row["MeetingID"]; ?>" class="btn btn-success btn-xs view_data" /></td>  
                                    <td><input type="button" name="delete_data" value="Delete" id="<?php echo $row["MeetingID"]; ?>" class="btn btn-danger btn-xs delete_data" /></td>  

                               </tr>  
                               <?php  
                               }  
                               ?>  
                          </table>  
                     </div>  
                </div>  
           </div>  
      </body>  
 </html>  
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Meeting Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Choose Date and Time</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">
                     <label id="lname">Username</label>  
                     <input type="textarea" name="name" id="name" class="form-control">  
                          <br />  
                          <label>Date</label>  
                          <input type="date" name="date" id="date" class="form-control" />  
                          <br />  
                          <label>Time</label>  
                          <input type="time" name="time" id="time" class="form-control" />   
                          <br />  
                          
                          <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $row['MeetingID'] ?>"  />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
           $('#delete_data').hide();
      });  
  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#date').val() == "")  
           {  
                alert("Date is required");  
           }  
           else if($('#time').val() == '')  
           {  
                alert("Time is required");  
           }  
           else  
           {  
            var employee_id = $(this).attr("id");  
                $.ajax({  
                     url:"insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                        
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#employee_table').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"select.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
      
      $(document).on('click', '.delete_data', function(){  
           var employee_id = $(this).attr("id");  
           
                $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},
                     success:function(data){  
                          $('#delete'+employee_id).hide();
                     }  
                });  
                      
      });  
      


 });  
 </script>
 