<!DOCTYPE html>

<html lang="en">
  <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="basket_format.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <?php 
        function get_price(){
            $link = mysqli_connect("localhost", "root","","emira_pottery");
            $sql="SELECT * FROM product WHERE Product_ID=1";
            
                  if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                              while($row = mysqli_fetch_array($result)){
                                $pr=$row['price'];
                                echo $row['price'];
                              }
                        }
                  }
                 
         
              
           }
          

           function get_quantity(){
             
            $link = mysqli_connect("localhost", "root","","emira_pottery");
          

            if(isset($_POST['add'])){
              $quant = $_POST['quant'];
              $sql="SELECT * FROM product WHERE Product_ID=1";
              $sql1 = "UPDATE basket SET quantity=$quant WHERE Product_ID=1 ";
              $result=mysqli_query($link, $sql1);
                 
            
            }
           }

           function calculate_total(){
            $link = mysqli_connect("localhost", "root","","emira_pottery");
    
            $sql="SELECT price FROM product WHERE Product_ID=1"; 
            $sql1="SELECT quantity FROM basket WHERE Product_ID=1";
           
      
            if( $result1=mysqli_query($link, $sql)){
                $fieldinfo=mysqli_fetch_array($result1);
                $pr=$fieldinfo['price'];    
           }
           if($result2=mysqli_query($link, $sql1)){
               $fieldinfo=mysqli_fetch_array($result2);
               $quantity=$fieldinfo['quantity'];
            
          }
            $total = $pr * $quantity;
              
            $sql2 = "UPDATE basket SET total_price=$total WHERE Product_ID=1 ";
            $result=mysqli_query($link, $sql2);
            echo $total;
           }

           function remove_fun(){
            $link = mysqli_connect("localhost", "root","","emira_pottery");
            if(isset($_POST['remove'])){
            $del = "DELETE FROM basket WHERE Product_ID=1";
            if (mysqli_query($link, $del)) {
              echo "Record deleted successfully";
            } else {
               echo "Error deleting record: " . mysqli_error($link);

              }

           }

           
          }

          function subtotal(){
            $link = mysqli_connect("localhost", "root","","emira_pottery");
            $sub="SELECT total_price FROM basket WHERE Product_ID=1";
            if( $result1=mysqli_query($link, $sub)){
              $fieldinfo=mysqli_fetch_array($result1);
              $subtotal=$fieldinfo['total_price'];    
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

          
          <div class="row" style="padding-left:145px" >
              <div class="col"></div>
              <div class="col"></div>
              <div class="col">Price</div>
              <div class="col">Quantity</div>
              <div class="col">Remove</div>
              <div class="col">Total</div>
          </div>
                

                    
                          <br>
                        </br>

                          
                              
                                 <form method="post"  name="product-form">
                                          
                                          <div class="row">
                                            <div class="col">
                                              
                                                    <img id="im1" src="product.jpg">
                                               
                                            </div>



                                            <div class="col">
                                               
                                                  <div class="product_category">Category 10</div>
                                               
                                            </div>


                                            <div class="col" >
                                               
                                              <?php
                                                   get_price();
                                              ?>

                                            </div>


                                            <div class="col">

                                                
               
                                                    <input type="number" name="quant"/>
                                                    <button type="submit" name="add">Add</button>
                                                    <?php
                                                        get_quantity();
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
                                                        calculate_total();
                                                     ?>
                                            </div>
                                          </div>
                                       
                                  </form>

                                  <br> </br>

                                  <form method="post"  name="product-form">
                                          
                                          <div class="row">
                                            <div class="col">
                                              
                                                    <img id="im1" src="product.jpg">
                                               
                                            </div>



                                            <div class="col">
                                               
                                                  <div class="product_category">Category 10</div>
                                               
                                            </div>


                                            <div class="col" >
                                               
                                              <?php
                                                   get_price();
                                              ?>

                                            </div>


                                            <div class="col">

                                                
               
                                                    <input type="number" name="quant"/>
                                                    <button type="submit" name="add">Add</button>
                                                    <?php
                                                        get_quantity();
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
                                                        calculate_total();
                                                     ?>
                                            </div>
                                          </div>
                                       
                                  </form>


                        <div class="totals">
                          <div class="totals-item">
                            <label>Subtotal</label>
                                <div class="totals-value">
                                  <?php
                                  subtotal();
                                  ?>
                                </div>
                      </div>
</div>




                            
                <button class="checkout" onclick="document.getElementById('goto').style.display='block'">Checkout</button>

              </div>
              
             

            <div id="goto" class="modal">
  
              <h2>Responsive Checkout Form</h2>
              <div class="row">
                <div class="col-75">
                  <div class="container">
                    <form action="/action_page.php">
                    
                      <div class="row">
                        <div class="col-50">
                          <h3>Billing Address</h3>
                          <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                          <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                          <label for="email"><i class="fa fa-envelope"></i> Email</label>
                          <input type="text" id="email" name="email" placeholder="john@example.com">
                          <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                          <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                          <label for="city"><i class="fa fa-institution"></i> City</label>
                          <input type="text" id="city" name="city" placeholder="New York">
              
                          <div class="row">
                            <div class="col-50">
                              <label for="state">State</label>
                              <input type="text" id="state" name="state" placeholder="NY">
                            </div>
                            <div class="col-50">
                              <label for="zip">Zip</label>
                              <input type="text" id="zip" name="zip" placeholder="10001">
                            </div>
                          </div>
                        </div>
              
                        <div class="col-50">
                          <h3>Payment</h3>
                          <label for="fname">Accepted Cards</label>
                          <div class="icon-container">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                          </div>
                          <label for="cname">Name on Card</label>
                          <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                          <label for="ccnum">Credit card number</label>
                          <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                          <label for="expmonth">Exp Month</label>
                          <input type="text" id="expmonth" name="expmonth" placeholder="September">
                          <div class="row">
                            <div class="col-50">
                              <label for="expyear">Exp Year</label>
                              <input type="text" id="expyear" name="expyear" placeholder="2018">
                            </div>
                            <div class="col-50">
                              <label for="cvv">CVV</label>
                              <input type="text" id="cvv" name="cvv" placeholder="352">
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                      </label>
                      <input type="submit" value="Continue to checkout" class="btn">
                    </form>
                  </div>
                </div>
                <div class="col-25">
                  <div class="container">
                    <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>4</b></span></h4>
                    <p><a href="#">Product 1</a> <span class="price">$15</span></p>
                    <p><a href="#">Product 2</a> <span class="price">$5</span></p>
                    <p><a href="#">Product 3</a> <span class="price">$8</span></p>
                    <p><a href="#">Product 4</a> <span class="price">$2</span></p>
                    <hr>
                    <p>Total <span class="price" style="color:black"><b>$30</b></span></p>
                  </div>
                </div>
              </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
