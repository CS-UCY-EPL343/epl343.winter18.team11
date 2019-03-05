<!DOCTYPE html>
<html lang="en">
        <head>
        <title>add_product</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel = "stylesheet" type = "text/css" href = "add_format.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        
        
        <?php
          function   el(){
   $link = mysqli_connect("localhost", "root","","emira_pottery");
   if (isset($_POST['submit']))
   {
       $product_name   = $_POST['prod_name'];
       $product_type  = $_POST['prod_type'];
       $description = $_POST['descr'];
       $price = $_POST['pr'];

    
        $img=$_FILES['image']['name'];
        $target_file = "../images/$img";

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
        echo "uploaddddddd";
    }
        else{

            echo "akiro";
        }

       $sql = "INSERT INTO product (Product_name, Product_Type, Description, price,image) VALUES ('$product_name', '$product_type', '$description','$price','$img')";
       mysqli_query($link, $sql);



   }

}
             ?>
               </head>
<body>

<div class="first">
<h2>Admin</h2>
</div>
<div class="jumbotron" style="margin-bottom:0" >
    <div class="logo">
      <h1 >Add Product</h1>
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
<div class="container">
    
    <div class="frame">
 <form class="form-signin" action="/admin/add_products.php" method="post" name="form" enctype="multipart/form-data">
          <label for="product_name">Product Name</label>
          <br>
          
          <input class="form-styling" type="text" name="prod_name" placeholder=""/>

          <br>
          
          <label for="product_type">Product Type</label>
          
          <br>
          
          <input class="form-styling" type="text" name="prod_type" placeholder=""/>
          <br>
          <label for="product_name">Description</label>
          <br>
          
          <input class="form-styling" type="text" name="descr" placeholder=""/>
          <br>
          <label for="price">Price</label>
          
          <br>
          <input class="form-styling" type="text" name="pr" placeholder=""/>
          <br>

          <label for="image">Choose Image</label>
          <br>
          
          <input type="file" id="image" name="image" accept="image/*">
           <!-- <input type="submit" name="upl" value="Upload the picture"/> -->
          <br>
          <br>
          <button class="submit"  name="submit">Submit</button>
                        </form>

                    <?php
el();
                    ?>
                        </div>
                    </div>

      

</body>
</html>
