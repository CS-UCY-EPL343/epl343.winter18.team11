<?php
if(isset($_POST['check2'])){
              $phone=$_POST['telephone'];
              $query11="UPDATE Users SET Mobile=$phone WHERE UserID={$_SESSION['user']['UserID']}";
              $result=mysqli_query($db, $query11);

              $date1= date("y-m-d h:i:s");
              $cr=$date1;
              $query9="INSERT INTO Orders (User_ID,created) VALUES ('{$_SESSION['user']['UserID']}','$date1')";
              $result=mysqli_query($db, $query9);
         

              $query10 = "SELECT Order_ID FROM Orders WHERE User_ID={$_SESSION['user']['UserID']} and created='$date1' ";
              $result=mysqli_query($db, $query10);
              $row1=mysqli_fetch_array($result);
              $orderid = $row1['Order_ID'];

              $query6="SELECT * FROM Basket_Info WHERE User_ID={$_SESSION['user']['UserID']}" ;    
              $result=mysqli_query($db, $query6);
              
              while ( $row = mysqli_fetch_array($result)){
                $sql7="INSERT INTO Order_Info (Product_ID,Quantity,Total_Price,UserID,Created,Order_ID) VALUES ('$row[Product_id]','$row[Quantity]','$row[Total_Price]','$row[User_ID]', '$date1', '$orderid'  ) ";
                $result6=mysqli_query($db, $sql7);
                
               
              }

              $quer="DELETE FROM Basket_Info  WHERE Basket_Info.User_ID={$_SESSION['user']['UserID']}";
              $result7=mysqli_query($db, $quer);
               

             }

             ?>