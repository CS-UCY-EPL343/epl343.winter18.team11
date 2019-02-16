<?php

require_once 'database_behaviour.php';
$db = new database_behaviour();

// json response array
$response = array("error" => FALSE);


if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];

    // check if user is already existed with the same email
    if ($db->findUser($email)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $email;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->saveUser($name, $email, $password,$address,$mobile);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["UserID"];
            $response["user"]["name"] = $user["Name"];
            $response["user"]["email"] = $user["Email"];
            $response["user"]["created_at"] = $user["Created"];
            $response["user"]["address"] = $user["Address"];
            $response["user"]["mobile"] = $user["Mobile"];

            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email or password) is misssing!";
    echo json_encode($response);
}
?>
