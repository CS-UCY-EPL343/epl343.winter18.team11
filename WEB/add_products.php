<!DOCTYPE html>
<html>
        <head>
                <meta charset = "UTF-8">
              
                <link rel = "stylesheet"
                  type = "text/css"
                  href = "add_format.css" />
             
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

<h2>Add Product</h2>
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
