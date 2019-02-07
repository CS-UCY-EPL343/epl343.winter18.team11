<?php

require_once 'database_behaviour.php';
$db = new database_behaviour();

// json response array
$response = array("error" => FALSE);


if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
  $response[" here"] = "dd";

    // receiving the post params
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
$response["g"] = "dd";

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
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            $response["user"]["address"] = $user["address"];
            $response["user"]["mobile"] = $user["mobile"];

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
