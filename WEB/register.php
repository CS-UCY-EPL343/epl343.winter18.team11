<html>
<body>
<?php

 
$link=mysqli_connect("localhost","root","","emira_pottery");


if($link===false){
    die("error: could not connect" .mysqli_connect_error());
}


if(isset($_POST['signup'])) {
    $customer_name   = $_POST['customer_name'];
    $email = $_POST['email'];
    $username =$_POST['username'];
    $customer_psw = $_POST['customer_psw'];


    $sql = "INSERT INTO Customer(Customer_name, Email, Username, Password) VALUES ('$customer_name','$email','$username','$customer_psw')";
  

    if(mysqli_query($link,$sql)){
        echo "records insered successfully";
    }
    else{
         echo "error" . mysqli_error($link);
    }

}
?>
</body>
</html>