<!DOCTYPE html>

<html lang="en">
  <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/basket_format.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <?php 
        function get_price(){
            $link = mysqli_connect("localhost", "root","","emira_pottery");
  
         
            $sql="SELECT * FROM Product WHERE Product_ID=5";
            
                  if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                              while($row = mysqli_fetch_array($result)){
                                $pr=$row['Price'];
                                echo $row['Price'];
                              }
                        }
                  }
                 
         
              
           }
          
           function get_quantity($id){
             
            $link = mysqli_connect("localhost", "root","","emira_pottery");
            $sql1="";
        
              $quant = $_POST['quant'];
  
              switch($id){
                 case 1:
               
                    $sql1 = "UPDATE Basket SET Quantity=$quant WHERE Product_ID=$id ";
                  
                  
                   $result=mysqli_query($link, $sql1);
                    break;
                 
                 case 2:
                 $sql1 = "UPDATE Basket SET Quantity=$quant WHERE Product_ID=$id ";
                  
                   $result=mysqli_query($link, $sql1);
                    break;
                 case 3:
                 $sql1 = "UPDATE Basket SET Quantity=$quant WHERE Product_ID=$id ";
                  
                   $result=mysqli_query($link, $sql1);
                    break;
                  case 4:
                  $sql1 = "UPDATE Basket SET Quantity=$quant WHERE Product_ID=$id ";
                  
                    
                   $result=mysqli_query($link, $sql1);
                    break;
                  case 5:
                  $sql1 = "UPDATE Basket SET Quantity=$quant WHERE Product_ID=$id ";
                  
           
                    $result=mysqli_query($link, $sql1);
                    break;
                 }
          //  }
            
          
                
            
            
           }
           function remove_fun(){
            $link = mysqli_connect("localhost", "root","","emira_pottery");
            if(isset($_POST['remove'])){
            $del = "DELETE FROM Basket WHERE Product_ID=";
            if (mysqli_query($link, $del)) {
              echo "Record deleted successfully";
            } else {
               echo "Error deleting record: " . mysqli_error($link);
              }
           }
           
          }
          function subtotal(){
            $link = mysqli_connect("localhost", "root","","emira_pottery");
            $sub="SELECT Total_price FROM Basket WHERE Product_ID=1";
            if( $result1=mysqli_query($link, $sub)){
              $fieldinfo=mysqli_fetch_array($result1);
              $subtotal=$fieldinfo['Total_price'];    
         }
            if(isset($_POST['add'])){
              echo $subtotal;
            }
            if(isset($_POST['remove'])){
              $subtotal=0;
              echo $subtotal;
            }
          }
    ?>


<script>
function rf(){
 <?PHP remove_fun(); ?>
 }
 function r_fun() {
    var elem = document.getElementById('product-form');
    elem.parentNode.removeChild(elem);
    return false;
}
</script>





  </head>
  <body>
  
  <div class="jumbotron" style="margin-bottom:0" >
    <div class="logo">
      <h1 >Emira Pottery</h1>
    </div>

</div>
          

    
        
        <div class="header1">
           
                <p><font size="6">Shopping Cart </font></p>
                  
        </div>

          <div class="col_margin">  
          <div class="row">
            
              <div class="col"></div>
              <div class="col"></div>
              
                  <div class="col">Price</div>
                  <div class="col">Quantity</div>
                  <div class="col">Remove</div>
                  <div class="col">Total</div>
              </div>
          </div>
                

                    
                          <br>
                        </br>

                          <?php 
$link = mysqli_connect("localhost", "root","","emira_pottery");
$sql="SELECT Basket.Quantity,Basket.Total_price,Product.Price,Product.Product_Type,Product.Product_ID, Product.image FROM Basket,Product where Product.Product_ID = Basket.Product_id";

$result=mysqli_query($link,$sql);
while ($row=mysqli_fetch_row($result)) {
  
  ?>
 
<form method="post"  name="product-form">
                                          <div class="row">
                                            <div class="col">
                                              <?php
                                                     echo "<img src=images/".$row[5]." />";
                                               ?>
                                            </div>



                                            <div class="col">
                                               
                                                  <div class="product_category"><?php echo $row[3]; ?></div>
                                               
                                            </div>


                                            <div class="col" >
                                               
                                              <?php
                                                 echo $row[2];
                                              ?>

                                            </div>


                                            <div class="col">

                                                
               
                                                   <input type="number" name="quant"/>
                                                   <button type="submit"  name="add">Add</button>
                                                    <?php
                                                        
           
            
                                                                get_quantity($row[4]);
                                                      
                                                      ?>
                                            
                                            </div>
                                
                                            <div class="col">
                                               
                                            <button type="submit" name="remove" onclick="rf()">Remove</button>
                                                     <?php
                                                        remove_fun();
                                                    
                                                     ?>
                                             
                                            </div>

                                            <div class="col">
                                                  <?php
                                                        echo $row[0]*$row[2];
                                                     ?>
                                            </div>
                                          </div>
                                       
                                        


                                  </form>
<?php  
 }
  
 ?>

<?php


        ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>