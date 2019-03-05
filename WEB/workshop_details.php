<!DOCTYPE html>
<html>
<head>

       <title>workshop_details</title>
        
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel = "stylesheet" type = "text/css" href = "../admin/add_format.css" />
  
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
      
      .jumbotron{
          background:white;
          margin-top:35px;
          text-align: center;
      }
</style>
</head>
<body>

<?php
function see(){
 
try {
    // Connect and create the PDO object
    $link = mysqli_connect("localhost", "root","","emira_pottery");
    $sql="SELECT UserID,Date,Time FROM meeting";
    $result = $link->query($sql);
  
    // If the SQL query is succesfully performed ($result not false)
    if($result !== false) {
      // Create the beginning of HTML table, and the first row with colums title
      $html_table = '<table border="1" cellspacing="0" cellpadding="2"><tr><th>User_ID</th><th>Date</th><th>Time</th></tr>';
  
      // Parse the result set, and adds each row and colums in HTML table
      foreach($result as $row) {
        $html_table .= '<tr><td>' .$row['UserID']. '</td><td>' .$row['Date']. '</td><td>' .$row['Time']. '</td></tr>';
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
  <div class="first">
<h2>Admin</h2>
</div>
  <div class="jumbotron" style="margin-bottom:0" >
    <div class="logo">
      <h1 >Meeting Agenda</h1>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="products.php" >Products</a>
    </li>
      <li class="nav-item dropdown">
  
        <a class="nav-link dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="products_ovenware.php">Ovenware Pots</a>
          <a class="dropdown-item" href="products_decorative.php">Decorative Pots</a>
          <a class="dropdown-item" href="products_food_drink.php">Food & Drink Pots</a>
          <a class="dropdown-item" href="products_ecclesiastical.php">Ecclesiastical Pots</a>
          <a class="dropdown-item" href="products_cyprus.php">Cyprus Souvenirs Pots</a>
          <a class="dropdown-item" href="products_ancient.php">Ancient Pots</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" >Workshop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="basket.php" >Basket</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" >Contact</a>
      </li>
     
    </ul>
    
    <ul class="navbar-nav  my-2 my-lg-0">
    <li class="nav-item">
          <a class="nav-link" onclick="window.location.href='login.php'">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" onclick="window.location.href='register.php'">Sign up</a>
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
