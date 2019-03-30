<?php

class database_behaviour {

    private $conn;

  function __construct() {
        require_once 'database_conf.php';
        $db = new database_conf();
        $this->conn = $db->getConnection();
    }



    /*Save the user*/
    public function saveUser($name, $email, $password,$address,$mobile) {
        /*Generate a unique ID*/
        $exit = true;
        while ($exit){
          $random = rand(1, 100000);
          $stmt = $this->conn->prepare("SELECT * FROM Users WHERE UserID = ?");
          $stmt->bind_param("s", $random);
          $stmt->execute();
          $stmt->store_result();

          if ($stmt->num_rows == 0) {
              $exit = false;
        }
          $stmt->close();
        }
        $uniqueID = $random;
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];
        $stmt = $this->conn->prepare("INSERT INTO Users(UserID,Name,Email,Encrypted_password, Salt,Address,Mobile,Created) VALUES(?, ?, ?, ?, ?, ?, ?,NOW())");
        $stmt->bind_param("sssssss", $uniqueID, $name, $email, $encrypted_password, $salt,$address,$mobile);
        $result = $stmt->execute();

        $stmt->close();

        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return false;
        }
    }


    /*Find the user to log him inside */
    public function findUserWithPassword($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
        /*Execute Statement*/
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            /*Check the password with salt on server side*/
            $salt = $user['Salt'];
            $encrypted_password = $user['Encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            if ($encrypted_password == $hash) {
                return $user;
            }
        } else {
            return false;
        }
    }
    public function findUser($email) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $response = array("error" => FALSE);
        if ($stmt->execute()) {
        /*Execute Statement*/
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;

            }
         else {
            return false;
        }
    }

    public function storeMeeting($UID, $time,$date){
        $stmt = $this->conn->prepare ("INSERT INTO Meeting(Date,Time,UserID)VALUES (?,?,?) ");
        $stmt->bind_param("sss",$date,$time,$UID);
        if($stmt ->execute()){
          $stmt->close();
          return true;
        }
        else
          return false;
    }

    public function saveOrder($UID,$product_name,$quantity){
        $stmt = $this->conn->prepare ("INSERT INTO `Order`(`UserID`,`Product_Name`,`Quantity`,`Created`) VALUES (?,?,?,NOW())");
        $stmt->bind_param("sss",$UID,$product_name,$quantity);

        if($stmt ->execute()){
          $stmt->close();
          return true;
        }
        else
          return false;

    }


/*Find the user */
    public function UpdateUser($email, $name ,$mobile, $address, $cur_name, $cur_email) {
        $stmt = $this->conn->prepare("UPDATE  Users SET Email = ?, Name = ? , Mobile = ?, Address = ?  WHERE Email = ? AND Name = ? ");
        $stmt->bind_param("ssssss", $email,$name,$mobile,$address,$cur_email,$cur_name);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

/*Get the products by searching inside the database*/
  public function getProducts(){
    $stmt = $this->conn->prepare("SELECT * FROM Product ORDER BY Product_Name ASC");
    $product = array();

    if($stmt->execute()){

      $result = $stmt->get_result();
      $response = array("error" => FALSE);

      $i = 0;
      while ($row = $result->fetch_array()){
                $response["products".$i]["product_name"] = $row["Product_Name"];
                $response["products".$i]["product_price"] = $row["Price"];
                $response["products".$i]["product_category"] = $row["Product_Type"];
                $response["products".$i]["product_desc"] = $row["Product_Description"];
                $response["products".$i]["product_id"] = $row["Product_ID"];
                $response["products".$i]["product_image"] = $row["Product_Image"];

                $i++;
      }
      $stmt->close();
      echo json_encode($response);

    }
    else {
      $stmt->close();
      return false;
    }
}


/*Ready function for hashing and ssha*/

    public function hashSSHA($password) {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

/*Check the hash SHA */
    public function checkhashSSHA($salt, $password) {
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
        return $hash;
    }
}
?>
