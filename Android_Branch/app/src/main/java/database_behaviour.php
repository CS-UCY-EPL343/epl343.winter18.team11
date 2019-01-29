<?php

class database_behaviour {

    private $conn;

  function __construct() {
        require_once 'database_conf.php';
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /*Save the user*/
    public function saveUser($name, $email, $password) {
        /*Generate a unique ID*/
        $uniqueID = printf("uniqid(): %s\r\n", uniqid());
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];
        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name,email, encrypted_password, salt, created_at) VALUES(?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $uniqueID, $name, $email, $encrypted_password, $salt);

        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return "User not Found";
        }
    }
    /*Find the user*/
    public function findUserWithPassword($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
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
            return "User not found";
        }
    }

    public function findUser($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return "User not found";
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

