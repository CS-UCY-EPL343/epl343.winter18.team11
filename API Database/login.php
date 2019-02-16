
<?php
require_once 'database_behaviour.php';
$db = new database_behaviour();

$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $db->findUserWithPassword($email, $password);

    if ($user != false) {
        $response["error"] = FALSE;
        $response["UserID"] = $user["UserID"];
        $response["user"]["Name"] = $user["Name"];
        $response["user"]["Email"] = $user["Email"];
        $response["user"]["Created"] = $user["Created"];
        $response["user"]["Address"] = $user["Address"];
        $response["user"]["Mobile"] = $user["Mobile"];


        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>
