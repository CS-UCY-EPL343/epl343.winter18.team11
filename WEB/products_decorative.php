<!DOCTYPE html>
<html lang="en">
<head>
  <title>products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>


<body>


<div class = "products_gallery">
<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo-productsgallery">
      <h1 >Decorative Pots</h1>
    </div>
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
    
  </div>
</nav>


<!-- PRODUCTS --> 

<?php

$link = mysqli_connect("localhost", "root","","emira_pottery");
$sql="SELECT * FROM Product where Product.Product_Type = 'Decorative Pots' order by Product_ID asc";
$result=mysqli_query($link,$sql);
?>

<div class="container-table" style='padding-top:5%; padding-left:5%; padding-right:5%;' >
<table class="table">
    <tbody>
    <?php
        $i = 0; $trEnd = 0;
        while ($row = mysqli_fetch_array($result)){
            if($i == 0){
                echo '<tr>';
            }
            $id=$row[0]; 
           
            echo "<td style='border:none; text-align:center;'  >" . "<img src=images/".$row[4]." />" . "<br>". "<br>" .$row[1] ."<br>" .$row[2]. "<br>"."€".$row[3]."<br>".$row[5]. 
            
            "<br>". ""?> 
            <button type="button" class="btn btn-outline-dark"><a href="basket_insert.php/?id=<?php echo $id;?>">Buy now</button>
                                 
            
             <?php    "" ."</td>";
           

            if($i == 2){
                $i = 0; $trEnd = 1;
            }else{
                $trEnd = 0; $i++;
            }
            if($trEnd == 1) {
                echo '</tr>';
            }
        }
        if($trEnd == 0) echo '</tr>';
     ?>
    </tbody>
</table>
 </div>


</body>
</html>