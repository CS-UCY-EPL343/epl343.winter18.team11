

<?php
include('functions.php');

if (!isLoggedIn()) {
	header('location: ../login.php');
}else{




$link=mysqli_connect("localhost","root","","emira_pottery");


if($link===false){
    die("error: could not connect" .mysqli_connect_error());
}


$sql="";
    
    $product   = intval($_GET['id']);
    echo $product;
    
    
    $sql = "INSERT INTO Basket (Product_ID,User_ID) VALUES ('$product','{$_SESSION[user]['id']}')";
             
   
   
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


}





?>


