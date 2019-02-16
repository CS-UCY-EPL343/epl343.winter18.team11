<?php

require_once 'database_behaviour.php';
$db = new database_behaviour();

$response = array("error" => FALSE);

if(isset($_POST['products'])){
        $db->getProducts();


}else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Something went wrong";
    echo json_encode($response);
}

?>
