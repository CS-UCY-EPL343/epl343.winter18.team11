<html>
<body>
<?php

$link=mysqli_connect("localhost","root","","emira_pottery");


if($link===false){
    die("error: could not connect" .mysqli_connect_error());
}


$sql="SELECT * FROM Product WHERE Product_ID=1";


if( $result1=mysqli_query($link, $sql)){
    while($row = mysqli_fetch_array($result1)){
        echo "<img src=images/".$row['image']." />";

  }
}



?>
</body>
</html>

