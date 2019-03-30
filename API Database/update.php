<?php

require_once 'database_behaviour.php';
$db = new database_behaviour();

$response = array("error" => FALSE);

if (isset($_POST['cur_email']) && isset($_POST['cur_name'])) {

    $address = $_POST['address'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];

    $user = $db->UpdateUser($email,$name,$mobile,$address,$_POST['cur_name'],$_POST['cur_email']);

    if ($user != false) {
        $response["error"] = FALSE;

        $response["UserID"] = "Successfully update user status!";
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Update procedure went wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or name is missing!";
    echo json_encode($response);
}
?>
