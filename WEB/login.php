<html>
<body>
<?php

$link=mysqli_connect("localhost","root","","emira_pottery");


if($link===false){
    die("error: could not connect" .mysqli_connect_error());
}


if(isset($_POST['login'])) {

    $myusername=$_POST['myusername'];
    $mypassword=$_POST['mypassword'];

    

$sql="SELECT * FROM Customer WHERE Username='$myusername' and Password='$mypassword'";




if($result=mysqli_query($link,$sql)){
    if(mysqli_num_rows($result) > 0){
        echo " logged in";
    }
    else{
        echo "Wrong Username or Password" . mysqli_error($link);
   }

}


}
?>
</body>
</html>


