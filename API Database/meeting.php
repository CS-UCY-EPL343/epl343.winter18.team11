<?php
require_once 'database_behaviour.php';
$db = new database_behaviour();

$response = array("error" => FALSE);
if (isset($_POST['email']) && isset($_POST['time']) && isset($_POST['date'])) {
    $time = $_POST['time'];
    $date = $_POST['date'];
    $email = $_POST['email'];
    $user = $db->findUser($email);
    if ($user != false){
          //Find the user ID and store it with email and password
          $db->storeMeeting($user["UserID"],$time,$date);
          $response["error"] = FALSE;
          echo json_encode($response);
    }
    else
      echo "User was not found";

} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters date or time for meeting is missing!";
    echo json_encode($response);
}
?>
