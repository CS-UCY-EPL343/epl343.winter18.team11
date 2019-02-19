
<html>
<body>
<?php

$link=mysqli_connect("localhost","root","","emira_pottery");


if($link===false){
    die("error: could not connect" .mysqli_connect_error());
}


$sql="";
    
    $product   = intval($_GET['id']);
    echo $product;
  
    switch($product){
        case 1:
             $sql = "INSERT INTO Basket (Product_ID) VALUES (1)";
             break;
        case 2:
             $sql = "INSERT INTO Basket (Product_ID) VALUES (2)";
             break;
        case 3:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (3)";
            break;
        case 4:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (4)";
            break;
        case 5:
             $sql = "INSERT INTO Basket (Product_ID) VALUES (5)";
             break;
        case 6:
             $sql = "INSERT INTO Basket (Product_ID) VALUES (6)";
             break;
        case 7:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (7)";
            break;
        case 8:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (8)";
            break;
        case 9:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (9)";
            break;
            case 1:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (1)";
            break;
       case 10:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (10)";
            break;
       case 11:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (11)";
           break;
       case 12:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (12)";
           break;
       case 13:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (13)";
            break;
       case 14:
            $sql = "INSERT INTO Basket (Product_ID) VALUES (14)";
            break;
       case 15:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (15)";
           break;
       case 16:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (16)";
           break;
       case 17:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (17)";
           break;
       case 18:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (18)";
           break;
      case 19:
          $sql = "INSERT INTO Basket (Product_ID) VALUES (19)";
          break;
      case 20:
          $sql = "INSERT INTO Basket (Product_ID) VALUES (20)";
          break;
   

   }
    
   


    if(mysqli_query($link,$sql)){
        echo "records insered successfully";
    }
    else{
         echo "error" . mysqli_error($link);
    }

    if ($product<10){
        header("Location: /products_ovenware.php");
    }
    elseif($product<21){
        header("Location: /products_food_drink.php");
    }






?>
</body>
</html>

