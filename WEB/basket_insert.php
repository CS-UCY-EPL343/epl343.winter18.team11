

<?php
include('functions.php');

if (!isLoggedIn()) {
	header('location: ../login.php');
}




$link=mysqli_connect("localhost","root","","emira_pottery");


if($link===false){
    die("error: could not connect" .mysqli_connect_error());
}


$sql="";
    
    $product   = intval($_GET['id']);
    echo $product;
    
    switch($product){
        case 1:
             $sql = "INSERT INTO Basket (Product_ID,User_ID) VALUES (1,'{$_SESSION[user]['id']}')";
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
     case 21:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (21)";
           break;
       case 22:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (22)";
           break;
       case 23:
           $sql = "INSERT INTO Basket (Product_ID) VALUES (23)";
           break;
      case 24:
          $sql = "INSERT INTO Basket (Product_ID) VALUES (24)";
          break;
      case 25:
          $sql = "INSERT INTO Basket (Product_ID) VALUES (25)";
          break;
     case 26:
          $sql = "INSERT INTO Basket (Product_ID) VALUES (26)";
          break;
      case 27:
          $sql = "INSERT INTO Basket (Product_ID) VALUES (27)";
          break;
      case 28:
          $sql = "INSERT INTO Basket (Product_ID) VALUES (28)";
          break;
     case 29:
         $sql = "INSERT INTO Basket (Product_ID) VALUES (29)";
         break;
     case 30:
         $sql = "INSERT INTO Basket (Product_ID) VALUES (30)";
         break;
    case 31:
        $sql = "INSERT INTO Basket (Product_ID) VALUES (31)";
        break;
    case 32:
        $sql = "INSERT INTO Basket (Product_ID) VALUES (32)";
        break;
   case 33:
         $sql = "INSERT INTO Basket (Product_ID) VALUES (33)";
         break;
     case 34:
         $sql = "INSERT INTO Basket (Product_ID) VALUES (34)";
         break;
     case 35:
         $sql = "INSERT INTO Basket (Product_ID) VALUES (35)";
         break;
    case 36:
        $sql = "INSERT INTO Basket (Product_ID) VALUES (36)";
        break;
    case 37:
        $sql = "INSERT INTO Basket (Product_ID) VALUES (37)";
        break;
   case 38:
        $sql = "INSERT INTO Basket (Product_ID) VALUES (38)";
        break;
    case 39:
        $sql = "INSERT INTO Basket (Product_ID) VALUES (39)";
        break;
    case 40:
        $sql = "INSERT INTO Basket (Product_ID) VALUES (40)";
        break;
   case 41:
       $sql = "INSERT INTO Basket (Product_ID) VALUES (41)";
       break;
   case 42:
       $sql = "INSERT INTO Basket (Product_ID) VALUES (42)";
       break;
    case 43:
       $sql = "INSERT INTO Basket (Product_ID) VALUES (43)";
       break;
  case 44:
       $sql = "INSERT INTO Basket (Product_ID) VALUES (44)";
       break;
   case 45:
       $sql = "INSERT INTO Basket (Product_ID) VALUES (45)";
       break;
   case 46:
       $sql = "INSERT INTO Basket (Product_ID) VALUES (46)";
       break;
  case 47:
      $sql = "INSERT INTO Basket (Product_ID) VALUES (47)";
      break;
  case 48:
      $sql = "INSERT INTO Basket (Product_ID) VALUES (48)";
      break;
      case 68;
      $sql = "INSERT INTO Basket (Product_ID) VALUES (68)";
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
    elseif($product<26){
        header("Location: /products_cyprus.php");
    }
    elseif($product<31){
        header("Location: /products_ancient.php");
    }
    elseif($product<43){
        header("Location: /products_decorative.php");
    }
    elseif($product<49){
        header("Location: /products_ecclesiastical.php");
    }






?>


