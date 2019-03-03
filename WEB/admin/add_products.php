<!DOCTYPE html>
<html lang="en">
        <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
        <meta charset="utf-8">       
                <link rel = "stylesheet"
                  type = "text/css"
                  href = "add_format.css" />
                  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
             
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
<div class="container">
    <h2>Add Product</h2>
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

       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>              
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


</body>
</html>
