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
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
        /*Execute Statement*/
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            /*Check the password with salt on server side*/
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            if ($encrypted_password == $hash) {
                return $user;
            }
        } else {
            return false;
        }
    }

/*Find the user */
    public function findUser($email) {
        $stmt = $this->conn->prepare("SELECT email from Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return true;
        } else {
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
