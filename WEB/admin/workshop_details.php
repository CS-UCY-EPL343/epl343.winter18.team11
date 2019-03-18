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

<?php
function click($name,$id){
    $link = mysqli_connect("localhost", "root","","emira_pottery");
          
           
    if(isset($_POST['conf'])){
        $de=$_POST['conf'];
        echo $name;
        echo $id;

        foreach($de as $d){
          $sql= "SELECT * FROM meeting WHERE MeetingID=$d";
          $result=mysqli_query($link,$sql);
          $row=mysqli_fetch_array($result);
          $date=$row['Date'];	
          echo "ok";
          echo $date;

          $sql1= "SELECT email FROM users u, meeting m WHERE u.id=m.UserID";
          $result=mysqli_query($link,$sql1);
          $row=mysqli_fetch_array($result);
          $em=$row['email'];
          echo $em;
       
       
        }

      }
      else{

        
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
      $html_table = '<table border="1" cellspacing="0" cellpadding="2"><tr><th>Username</th><th>Date</th><th>Time</th><th></th></tr>';
 
      // Parse the result set, and adds each row and colums in HTML table
      foreach($result as $row) {
        $html_table .= '<tr><td>' .$row['username']. '</td><td>' .$row['Date']. '</td><td>' .$row['Time']. '</td></tr>';
    
      ?>
      <form method="post"   >
      <input type="hidden" name="date[]" value="<?php echo $row['Date'] ?>" />
      <input type="hidden" name="time[]" value="<?php echo $row['Time'] ?>" />
     <td> <button type="submit" name="conf[]" value="<?php echo $row['MeetingID']?>" >confirm</button> </td>
      
      </form>  
      <?php
        click($row['username'],$row['UserID']);
    }
    }
  
    $conn = null;        // Disconnect
  
    $html_table .= '</table>';           // ends the HTML table
    
    echo $html_table;        // display the HTML table
    ?>
    <form method="post"   >
    <input type="hidden" name="date[]" value="<?php echo $row['Date'] ?>" />
    <input type="hidden" name="time[]" value="<?php echo $row['Time'] ?>" />
   <td> <button type="submit" name="conf[]" value="<?php echo $row['MeetingID']?>" >complete</button> </td>
    
    </form>
    <?php  
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

</body>
</html>