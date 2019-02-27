

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
      <h1 >Ovenware Pots</h1>
    </div>
</div>
</div>

      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <a class="navbar-brand" href="products.php">Products</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="home.php">Homepage</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Our Workshop</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="contact.php">Contact</a>
                    </li>    
                  </ul>
                </div>  
        </nav>




<?php

$link = mysqli_connect("localhost", "root","","emira_pottery");
$sql="SELECT * FROM Product where Product.Product_Type = 'Ovenware Pots' order by Product_ID asc";
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